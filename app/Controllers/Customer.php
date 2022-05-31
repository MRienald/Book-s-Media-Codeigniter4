<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\GroceryCrud;
use App\Models\CustomerModel;

define('TITLE', 'Customer');

class Customer extends BaseController
{

    public function index()
    {

        $_customer_model = new CustomerModel();

        $crud = new GroceryCrud();
        $crud->setLanguage('English');
        $crud->setTable('customer');
        // $crud->columns(['name', 'gender']);
        $crud->unsetColumns(['created_at', 'updated_at', 'deleted_at']);
        $crud->displayAs([
            'name'  => 'Fullname',
            'no_customer' => 'Customer Number',
        ]);
        $crud->setTheme('datatables');

        $crud->unsetAddFields(['created_at', 'updated_at', 'deleted_at']);
        $crud->unsetEditFields(['created_at', 'updated_at', 'deleted_at']);

        $crud->callbackInsert(function ($stateParameters) use ($_customer_model) {
            $_customer_model->save($stateParameters->data);
            return $stateParameters;
        });

        $crud->callbackDelete(function ($stateParameters) use ($_customer_model) {
            $_customer_model->delete($stateParameters->primaryKeyValue);
            return $stateParameters;
        });

	    $output = $crud->render();

        $data = [
            'title'     => TITLE,
            'result'    => $output,
        ];

		return view('customer/index', $data);
    }
}
