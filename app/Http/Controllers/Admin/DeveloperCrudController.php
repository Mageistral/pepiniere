<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DeveloperRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DeveloperCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DeveloperCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    private $langPath;

    public function setup()
    {
        $this->crud->setModel('App\Models\Developer');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/developer');
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
        $this->crud->addColumn([
            'label' => __('models.regions.singular'),    // Table column heading
            'type' => 'select',
            'name' => 'region_id',  // the column that contains the ID of that connected entity;
            'entity' => 'region',   // the method that defines the relationship in your Model
            'attribute' => 'name',  // foreign key attribute that is shown to user
            'model' => "App\Models\Region", // foreign key model
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(DeveloperRequest::class);

        $this->crud->addField([
            'name'  => 'name',
            'label' => __($this->langPath.'name'),
            'type'  => 'text'
        ]);
        $this->crud->addField([
            'label' => __('models.regions.singular'),
            'type' => 'select',
            'name' => 'region_id',  // the db column for the foreign key
            'entity' => 'region',   // the method that defines the relationship in your Model
            'attribute' => 'name',  // foreign key attribute that is shown to user
         
            // optional
            'model' => "App\Models\Region",
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
