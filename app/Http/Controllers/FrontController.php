<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use App\Models\Level;
use App\Models\Rootstock;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FrontController extends Controller
{
    public function main(Request $request) {
        return view('layouts.fruit-choice', [
            'fruits' => Fruit::all()->sortBy('name')
        ]);
    }

    public function mainFruit(Request $request, $fruit_name, $fruit_id) {
        $fruit = Fruit::findOrFail($fruit_id);
        // pas super utile mais on vérifie tout
        if ($fruit->name != $fruit_name) {
            return redirect('error')->with('message', 'Mauvais nom de fruit');
        }

        // filtre sur les specs si jamais il y en a
        // récupération de sspecificités dans un tableau [[spec_id => spec_weight]]
        $matches = null;
        $specs = [];
        foreach ($request->all() as $param => $value) {
            if (preg_match('/specificity-([0-9]+)/', $param, $matches)) {
                $specs[$matches[1]] = $value;
            }
        }

        // récup des porte-greffes liés au fruit
        $rootstocks = $fruit->rootstocks;
        $rootstocks = $fruit->rootstocks->where('display', 1);

        // récupération des specs par rapport à la totalité des porte-greffes du fruit, pas après tri
        $specs = $this->getAllSpecificities($rootstocks);
        // récupération de toutes les catégories des spécificités
        $cats = $this->getAllCategories($specs);
        
        // pré-tri sur les vigueurs
        if (! empty($request->input('vigour'))) {
            // on prend les null, qu'il faudra classer d'une certaine manière
            $rootStockNullVigour = $rootstocks->where('computed_vigour', null);
            if (! empty($fruit->franc)) {
                // calcul des min-max
                $minMax = preg_split('/,/', $request->input('vigour'));
                $rootstocks = $rootstocks->whereBetween('computed_vigour', [
                    intval($minMax[0]*$fruit->franc->height_mean/100),
                    intval($minMax[1]*$fruit->franc->height_mean/100)
                ]);
                // mélange des null et de ceux à la bonne taille
                $rootstocks = $rootstocks->merge($rootStockNullVigour);
            }
        }

        $filteredRootstocks = collect();
        foreach ($rootstocks as $rootstock) {
            if ($rootstock->has('specificities')) {
                $rootstock->load('specificities');
                // parmi les specs du porte-greffe, si une est mentionnée dans les paramètres et possède un 'weight' plus élevé
                // le porte-greffe n'est pas mis de côté
                $allGood = true;
                foreach ($rootstock->specificities as $specAndLevelId) {
                    if (
                        // la relation existe mais le poids de la spec n'est pas assez fort
                    (! empty($specs[$specAndLevelId->id]))
                        && (! Level::where('weight', '>=', $specs[$specAndLevelId->id])->get()->pluck('id')->contains($specAndLevelId->pivot->level_id))
                    ) {
                        $allGood = false;
                        break;
                    }
                }
                // tous les paramètres sont absents ou correspondent
                if ($allGood)
                    $filteredRootstocks->push($rootstock);
            }
        }
        $filteredRootstocks = $filteredRootstocks->sortBy('computed_vigour');

        return view('layouts.fruit', [
            'specificities' => $specs,
            'categories' => $cats,
            'levels' => Level::all(),
            'fruits' => Fruit::all()->sortBy('name'),
            'current_fruit' => $fruit,
            'rootstocks' => $filteredRootstocks,
            'inputs' => $request->all(),
            'franc' => $fruit->franc
        ]);
    }

    public function error(Request $request) {
        return view('layouts.error', [
            'fruits' => Fruit::all()
        ]);
    }

    /**
     * Returns a Collection with all the specificities listed in the Rootstock Collection
     *
     * @param Collection $rootstocks
     * @return Collection specificities 
     */
    public function getAllSpecificities($rootstocks) {
        $specs = collect();
        foreach ($rootstocks as $rootstock) {
            $specs = $specs->merge($rootstock->specificities);
        }
        return $specs->unique(function ($item) {
            return $item->id;
        });
    }

    /**
     * Returns a Collection with all the categories linked to the specificities
     *
     * @param Collection $specificities
     * @return Collection categories 
     */
    public function getAllCategories($specificities) {
        $categories = collect();
        foreach ($specificities as $specificity) {
            $categories = $categories->push($specificity->category);
        }
        return $categories->unique(function ($item) {
            return $item->id;
        });

    }
}
