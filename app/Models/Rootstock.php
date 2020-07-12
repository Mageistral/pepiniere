<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Rootstock extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'rootstocks';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['name', 'name_alternate', 'latin_name', 'height_mean', 'lifetime', 'rootstock1_id', 'rootstock2_id', 'developer_id', 'obtaining_year', 'first_fruits_years', 'display'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function isHybrid() {
        return (!empty($this->rootstock1_id) && !empty($this->rootstock2_id));
    }

    public function computeVigour() {
        // récupération de toutes les vigueurs dont le PG est en source
        $rtsTarget = $this->rootstocks_vigours_target;
        $height = null;
        // calcul de la moyenne des hauteurs que ça donne
        foreach ($rtsTarget as $rtTarget) {
            // si la hauteur du PG de référence n'existe pas, on regarde si la calculée existe
            $heightTarget = $rtTarget->height_mean ?? $rtTarget->computed_vigour;
            // pas de calcul s'il n'y en a pas
            if (! empty($heightTarget)) {
                if (empty($height)) {
                    $height = intval($heightTarget * $rtTarget->pivot->ratio / 100);
                }
                else {
                    $height = intval($height + ($heightTarget * $rtTarget->pivot->ratio / 100) / 2);
                }
            }
        }
        // si calcul il y a eu, on prend
        if (! empty($height)) {
            $this->computed_vigour = $height;
        }
    }



    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function fruits() {
        return $this->belongsToMany('App\Models\Fruit', 'rootstocks_fruits');
    }

    public function regions() {
        return $this->belongsToMany('App\Models\Region', 'rootstocks_regions');
    }

    public function rootstock1() {
        return $this->belongsTo('App\Models\Rootstock', 'rootstock1_id');
    }
    public function rootstock2() {
        return $this->belongsTo('App\Models\Rootstock', 'rootstock2_id');
    }
    public function developer() {
        return $this->belongsTo('App\Models\Developer');
    }
    public function specificities() {
        return $this->belongsToMany('App\Models\Specificity', 'rootstocks_specificities_levels')->withPivot(['level_id', 'link_source', 'link_comment']);
    }
    public function rootstocks_vigours_target() {
        return $this->belongsToMany('App\Models\Rootstock', 'rootstocks_vigours', 'rootstock_id', 'rootstock_relativeto_id')->withPivot(['ratio', 'link_source', 'link_comment']);
    }
    public function rootstocks_vigours_source() {
        return $this->belongsToMany('App\Models\Rootstock', 'rootstocks_vigours', 'rootstock_relativeto_id', 'rootstock_id')->withPivot(['ratio', 'link_source', 'link_comment']);
    }
    public function incompatible_varieties() {
        return $this->belongsToMany('App\Models\Variety', 'incompatible_varieties');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
