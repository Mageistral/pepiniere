<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SpecificityRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SpecificityCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SpecificityCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    private $langPath;

    public function setup()
    {
        $this->crud->setModel('App\Models\Specificity');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/specificity');
        $this->langPath = 'models.'.$this->crud->model->getTable().'.';
        $this->crud->setEntityNameStrings(__($this->langPath.'singular'), __($this->langPath.'plural'));
    }

    protected function setupShowOperation() {
        $this->crud->set('show.setFromDb', false);
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
            'name'  => 'description',
            'label' => __($this->langPath.'description'),
            'type'  => 'text'
        ]);
        
        $this->crud->addColumn([
            'label' => __('models.specificities_categories.singular'),
            'name'  => 'category',
            'type'  => 'relationship',
            'attribute' => 'name'
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(SpecificityRequest::class);

        $this->crud->addField([
            'name'  => 'name',
            'label' => __($this->langPath.'name'),
            'type'  => 'text'
        ]);

        $this->crud->addField([
            'name'  => 'description',
            'label' => __($this->langPath.'description'),
            'type'  => 'textarea'
        ]);
        
        $this->crud->addField([
            'label' => __('models.specificities_categories.singular'),
            'name'  => 'category_id',
            'type'  => 'select',
            'attribute' => 'name',
            'entity' => 'category',
            'model' => 'App\Models\SpecificityCategory'
        ]);
        
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
