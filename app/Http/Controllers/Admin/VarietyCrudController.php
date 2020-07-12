<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VarietyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class VarietyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class VarietyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    private $langPath;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Variety::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/variety');
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
            'name'  => 'name',
            'label' => __($this->langPath.'name'),
            'type'  => 'text'
        ]);

        $this->crud->addColumn([
            'label' => __('models.varieties.singular'),    // Table column heading
            'type' => 'relationship',
            'name' => 'fruit'  // the column that contains the ID of that connected entity;
        ]);

    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->addField([
            'name'  => 'name',
            'label' => __($this->langPath.'name'),
            'type'  => 'text'
        ]);

        $this->crud->addField([  // Select
            'label' => __('models.fruits.singular'),
            'type' => 'select2',
            'name' => 'fruit_id',   // the db column for the foreign key
            'entity' => 'fruit', // the method that defines the relationship in your Model
            'attribute' => 'name',  // foreign key attribute that is shown to user
            'model' => "App\Models\Fruit" // foreign key model
        ]);
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
