<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RootstockSpecificityLevelRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RootstockSpecificityLevelCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RootstockSpecificityLevelCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\RootstockSpecificityLevel::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/rootstockSpecificityLevel');
        $this->langPath = 'models.'.$this->crud->model->getTable().'.';
        $this->crud->setEntityNameStrings(__($this->langPath.'singular'), __($this->langPath.'plural'));
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'label'  => __('models.rootstocks.singular'),
            'type'   => 'relationship',
            'name'   => 'rootstock',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('rootstock', function ($q) use ($column, $searchTerm) {
                    $q->where('name', 'like', '%'.$searchTerm.'%');
                });
            }
        ]);
        $this->crud->addColumn([
            'label'  => __('models.specificities.singular'),
            'type'   => 'relationship',
            'name'   => 'specificity',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('specificity', function ($q) use ($column, $searchTerm) {
                    $q->where('name', 'like', '%'.$searchTerm.'%');
                });
            }
        ]);
        $this->crud->addColumn([
            'label'  => __('models.levels.singular'),
            'type'   => 'relationship',
            'name'   => 'level'
        ]);
        $this->crud->addColumn([
            'label'  => __($this->langPath.'link_source'),
            'type'   => 'text',
            'name'   => 'link_source'
        ]);
        $this->crud->addColumn([
            'label'  => __($this->langPath.'link_comment'),
            'type'   => 'text',
            'name'   => 'link_comment'
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RootstockSpecificityLevelRequest::class);

        $this->crud->addField([
            'label' => __('models.rootstocks.singular'),
            'type' => 'select2',
            'name' => 'rootstock_id',
            'entity' => 'rootstock',
            'attribute' => 'name',
            'model' => 'App\Models\Rootstock'
        ]);
        $this->crud->addField([
            'label' => __('models.specificities.singular'),
            'type' => 'select2',
            'name' => 'specificity_id',
            'entity' => 'specificity',
            'attribute' => 'name',
            'model' => 'App\Models\Specificity'
        ]);
        $this->crud->addField([
            'label' => __('models.levels.singular'),
            'type' => 'select2',
            'name' => 'level_id',
            'entity' => 'level',
            'attribute' => 'name',
            'model' => 'App\Models\Level'
        ]);

        $this->crud->addField([
            'label' => __($this->langPath.'link_source'),
            'type' => 'url',
            'name' => 'link_source'
        ]);
        $this->crud->addField([
            'label' => __($this->langPath.'link_comment'),
            'type' => 'text',
            'name' => 'link_comment'
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
