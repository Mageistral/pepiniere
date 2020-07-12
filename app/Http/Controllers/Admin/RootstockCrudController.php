<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RootstockRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use ReflectionClass;

/**
 * Class RootstockCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RootstockCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    private $langPath;

    public function setup()
    {
        $this->crud->setModel('App\Models\Rootstock');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/rootstock');
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
            'name'  => 'name_alternate',
            'label' => __($this->langPath.'name_alternate'),
            'type'  => 'text'
        ]);
        $this->crud->addColumn([
            'name'  => 'latin_name',
            'label' => __($this->langPath.'latin_name'),
            'type'  => 'text'
        ]);
        $this->crud->addColumn([
            'name'  => 'height_mean',
            'label' => __($this->langPath.'height_mean'),
            'type'  => 'number',
            'suffix' => ' cm',
            'dec_point' => '.',
            'thousands_sep' => ' '
        ]);

        $this->crud->addColumn([
            'name'  => 'lifetime',
            'label' => __($this->langPath.'lifetime'),
            'type'  => 'number',
            'suffix' => ' années'
        ]);

        $this->crud->addColumn([
            // 1-n relationship
            'label'  => __('models.rootstocks.singular').' ('.__($this->langPath.'hybrid').' 1)', // Table column heading
            'type'   => 'select',
            'name'   => 'rootstock1_id', // the column that contains the ID of that connected entity;
            'entity' => 'rootstock1', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'  => "App\Models\Rootstock", // foreign key model
        ]);
        $this->crud->addColumn([
            // 1-n relationship
            'label'  => __('models.rootstocks.singular').' ('.__($this->langPath.'hybrid').' 2)', // Table column heading
            'type'   => 'select',
            'name'   => 'rootstock2_id', // the column that contains the ID of that connected entity;
            'entity' => 'rootstock2', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'  => "App\Models\Rootstock", // foreign key model
        ]);
        $this->crud->addColumn([
            // 1-n relationship
            'label'  => __('models.developers.singular'), // Table column heading
            'type'   => 'select',
            'name'   => 'developer_id', // the column that contains the ID of that connected entity;
            'entity' => 'developer', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'  => "App\Models\Developer", // foreign key model
        ]);
        $this->crud->addColumn([
            'name'  => 'obtaining_year',
            'label' => __($this->langPath.'obtaining_year'),
            'type'  => 'number',
            'thousands_sep' => ' '
        ]);
        $this->crud->addColumn([
            'name'  => 'first_fruits_years',
            'label' => __($this->langPath.'first_fruits_years'),
            'type'  => 'number',
            'suffix' => ' années',
            'thousands_sep' => ' '
        ]);
        $this->crud->addColumn([
            'name'  => 'display',
            'label' => __($this->langPath.'display'),
            'type'  => 'boolean'
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(RootstockRequest::class);

        $this->crud->addField([
            'name'  => 'name',
            'label' => __($this->langPath.'name'),
            'type'  => 'text'
        ]);
        $this->crud->addField([
            'name'  => 'name_alternate',
            'label' => __($this->langPath.'name_alternate'),
            'type'  => 'text'
        ]);
        $this->crud->addField([
            'name'  => 'latin_name',
            'label' => __($this->langPath.'latin_name'),
            'type'  => 'text'
        ]);
        $this->crud->addField([
            'name'  => 'height_mean',
            'label' => __($this->langPath.'height_mean'),
            'type'  => 'number',
            'attributes' => ['step' => '10'],
            'suffix' => ' cm',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);
        $this->crud->addField([
            'name'  => 'lifetime',
            'label' => __($this->langPath.'lifetime'),
            'type'  => 'number',
            'attributes' => ['step' => '5'],
            'suffix' => ' années',
            'wrapper' => [
                'class' => 'form-group offset-md-2 col-md-5'
            ]
        ]);

        $this->crud->addField([
            'label'     => __('models.fruits.plural'),
            'type'      => 'select2_multiple',
            'name'      => 'fruits', // the method that defines the relationship in your Model
            'entity'    => 'fruits', // the method that defines the relationship in your Model
            'attribute' => 'name',   // foreign key attribute that is shown to user
       
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?
       
            // optional
            'model'     => "App\Models\Fruit", // foreign key model
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
        $this->crud->addField([
            'label'     => __('models.incompatible_varieties.plural'),
            'type'      => 'select2_multiple',
            'name'      => 'incompatible_varieties', // the method that defines the relationship in your Model
            'entity'    => 'incompatible_varieties', // the method that defines the relationship in your Model
            'attribute' => 'name',   // foreign key attribute that is shown to user
       
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?
       
            // optional
            'model'     => "App\Models\Variety", // foreign key model
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
        $this->crud->addField([
            'name'  => 'first_fruits_years',
            'label' => __($this->langPath.'first_fruits_years'),
            'type'  => 'number',
            'attributes' => ['step' => '1'],
            'suffix' => ' années',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);


        $this->crud->addField([   // CustomHTML
        'name' => 'card_open',
        'type' => 'custom_html',
        'value' => '<div id="hybrid-card" class="card">
                        <div class="card-header">
                            <label for="isHybrid">Est-ce un hybride ?</label>
                            <input type="checkbox" name="isHybrid" value="1" />
                        </div>
                        <div class="card-body row collapse">
                        </div>
                    </div>'
        ]);

        $this->crud->addField([  // Select
            'label' => __('models.rootstocks.singular').' 1',
            'type' => 'select2',
            'name' => 'rootstock1_id',   // the db column for the foreign key
            'entity' => 'rootstock1', // the method that defines the relationship in your Model
            'attribute' => 'name',  // foreign key attribute that is shown to user
            'model' => "App\Models\Rootstock", // foreign key model
            'attributes' => [
                'class' => 'form-control hybrid-field'
            ]
        ]);
        $this->crud->addField([  // Select
            'label' => __('models.rootstocks.singular').' 2',
            'type' => 'select2',
            'name' => 'rootstock2_id',   // the db column for the foreign key
            'entity' => 'rootstock2', // the method that defines the relationship in your Model
            'attribute' => 'name',  // foreign key attribute that is shown to user
            'model' => "App\Models\Rootstock", // foreign key model
            'attributes' => [
                'class' => 'form-control hybrid-field'
            ]
        ]);
        $this->crud->addField([  // Select
            'label' => __('models.developers.singular'),
            'type' => 'select2',
            'name' => 'developer_id',   // the db column for the foreign key
            'entity' => 'developer', // the method that defines the relationship in your Model
            'attribute' => 'name',  // foreign key attribute that is shown to user
            'model' => "App\Models\Developer", // foreign key model
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);
        $this->crud->addField([
            'label' => __('models.regions.plural'),
            'type'  => 'relationship',
            'name'  => 'regions',
            'attribute' => 'name'
        ]);
        $this->crud->addField([
            'name'  => 'obtaining_year',
            'label' => __($this->langPath.'obtaining_year'),
            'type'  => 'number',
            'attributes' => ['step' => '1'],
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);
        $this->crud->addField([
            'name'  => 'display',
            'label' => __($this->langPath.'display'),
            'type'  => 'checkbox'
        ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
    }
}
