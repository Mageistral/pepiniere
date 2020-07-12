<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FruitRequest;
use App\Models\Rootstock;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FruitCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FruitCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    private $langPath;
    
    public function setup()
    {
        $this->crud->setModel('App\Models\Fruit');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/fruit');
        $this->langPath = 'models.'.$this->crud->model->getTable().'.';
        $this->crud->setEntityNameStrings(__($this->langPath.'singular'), __($this->langPath.'plural'));
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name'  => 'name',
            'label' => __($this->langPath.'name'),
            'type'  => 'text'
        ]);
        $this->crud->addColumn(
        [
            // 1-n relationship
            'label' => __('models.rootstocks.plural'), // Table column heading
            'type' => 'select_multiple',
            'name' => 'rootstocks', // the method that defines the relationship in your Model
            'entity' => 'rootstocks', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Rootstock", // foreign key model
         ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(FruitRequest::class);

        $this->crud->addField([
            'name'  => 'name',
            'label' => __($this->langPath.'name'),
            'type'  => 'text'
        ]);
        $this->crud->addField([
            'label' => __($this->langPath.'rootstock_franc_id'),
            'type'  => 'select2',
            'name'  => 'rootstock_franc_id',
            'entity'    => 'franc', // the method that defines the relationship in your Model
            'attribute' => 'name',
            'model'     => "App\Models\Rootstock", // foreign key model
            // pas besoin d'utiliser $query, tant qu'on lui retourne le bon objet
            'options'   => (function ($query) {
                return $this->crud->entry->rootstocks;
            })
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
