<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RootstocksVigoursRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class Rootstocks_vigoursCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RootstocksVigoursCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    private $langPath;

    public function setup()
    {
        $this->crud->setModel('App\Models\RootstocksVigours');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/rootstocksVigours');
        $this->langPath = 'models.'.$this->crud->model->getTable().'.';
        $this->crud->setEntityNameStrings(__($this->langPath.'singular'), __($this->langPath.'plural'));
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            // 1-n relationship
            'label'  => __('models.rootstocks.singular'), // Table column heading
            'type'   => 'select',
            'name'   => 'rootstock_id', // the column that contains the ID of that connected entity;
            'entity' => 'rootstock', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'  => "App\Models\Rootstock", // foreign key model
        ]);
        $this->crud->addColumn([
            'name'  => 'ratio',
            'label' => __($this->langPath.'ratio'),
            'type'  => 'number',
            'suffix' => ' %'
        ]);
        $this->crud->addColumn([
            // 1-n relationship
            'label'  => __($this->langPath.'rootstock_relativeto_id'), // Table column heading
            'type'   => 'select',
            'name'   => 'rootstock_relativeto_id', // the column that contains the ID of that connected entity;
            'entity' => 'rootstock_relativeto', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'  => "App\Models\Rootstock", // foreign key model
        ]);
    }

    public function setupShowOperation() {
        $this->setupListOperation();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(RootstocksVigoursRequest::class);

        $this->crud->addField([  // Select
            'label' => __('models.rootstocks.singular'),
            'type' => 'select2',
            'name' => 'rootstock_id',   // the db column for the foreign key
            'entity' => 'rootstock', // the method that defines the relationship in your Model
            'attribute' => 'name',  // foreign key attribute that is shown to user
            'model' => "App\Models\Rootstock" // foreign key model
        ]);
        $this->crud->addField([
            'name'  => 'ratio',
            'label' => __($this->langPath.'ratio'),
            'type'  => 'number',
            'attributes' => ['step' => '5'],
            'suffix' => ' %'
        ]);
        $this->crud->addField([  // Select
            'label' => __($this->langPath.'rootstock_relativeto_id'),
            'type' => 'select2',
            'name' => 'rootstock_relativeto_id',   // the db column for the foreign key
            'entity' => 'rootstock_relativeto', // the method that defines the relationship in your Model
            'attribute' => 'name',  // foreign key attribute that is shown to user
            'model' => "App\Models\Rootstock" // foreign key model
        ]);
        $this->crud->addField([  // Select
            'name' => 'link_source',
            'label' => __($this->langPath.'link_source'),
            'type' => 'url'
        ]);
        $this->crud->addField([  // Select
            'name' => 'link_comment',
            'label' => __($this->langPath.'link_comment'),
            'type' => 'textarea'
        ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
