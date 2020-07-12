<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LevelRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LevelCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LevelCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Level');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/level');
        $this->langPath = 'models.'.$this->crud->model->getTable().'.';
        $this->crud->setEntityNameStrings(__($this->langPath.'singular'), __($this->langPath.'plural'));
    }

    protected function setupShowOperation() {
        $this->setupListOperation();
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name'  => 'name',
            'label' => __($this->langPath.'name'),
            'type'  => 'text'
        ]);

        $this->crud->addColumn([
            'name'  => 'weight',
            'label' => __($this->langPath.'weight'),
            'type'  => 'number',
            'suffix' => ' %'
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(LevelRequest::class);

        $this->crud->addField([
            'name'  => 'name',
            'label' => __($this->langPath.'name'),
            'type'  => 'text'
        ]);

        $this->crud->addField([
            'name'  => 'weight',
            'label' => __($this->langPath.'weight'),
            'type' => 'select_from_array',
            'attributes' => ['step' => '10']
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
