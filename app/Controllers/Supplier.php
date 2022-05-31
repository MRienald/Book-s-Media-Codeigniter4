<?php

namespace App\Controllers;

use App\Entities\SupplierEntity;
use App\Models\SupplierModel;

define('TITLE', 'Supplier');

class Supplier extends BaseController{

    private $_supplier_model;

    public function __construct()
    {
        $this->_supplier_model = new SupplierModel();
    }

    public function index()
    {
        $data_supplier = $this->_supplier_model->where(['deleted_at' => null])->findAll();
        $data = [
            'title' => TITLE,
            'result' => $data_supplier
        ];

        return view('supplier/index', $data); 
    }

    public function create()
    {
        $data = [
            'title' => TITLE
        ];
        return view('supplier/create', $data);
    }

    public function save()
    {
        $supplier = new SupplierEntity();
        $data = [
            "name"      => $this->request->getVar('name'),
            "address"      => $this->request->getVar('address'),
            "email"      => $this->request->getVar('email'),
            "phone"      => $this->request->getVar('phone'),
        ];
        $supplier->fill($data);
        $this->_supplier_model->save($supplier);

        session()->setFlashdata("success", "Data saved successfully!");

        return redirect()->to('/supplier');
    }

    public function edit($id)
    {
        
        $data_supplier = $this->_supplier_model->where(['supplier_id' => $id])->first();

        if (empty($data_supplier)){
            throw new \CodeIgniter\Exceptions\PageNotFoundException("supplier dengan ID: $id ");
        }

        $data = [
            'title'  => TITLE,
            'result' => $data_supplier 
        ];

        return view('supplier/edit', $data);
    }

    public function update($id)
    {
        $supplier = new SupplierEntity();
        $supplier->supplier_id = $id;
        $data = [
            "name"      => $this->request->getVar('name'),
            "address"      => $this->request->getVar('address'),
            "email"      => $this->request->getVar('email'),
            "phone"      => $this->request->getVar('phone'),
        ];
        $supplier->fill($data);
        $this->_supplier_model->save($supplier);

        session()->setFlashdata("success", "Data updated successfully!");

        return redirect()->to('/supplier');
    }

    public function delete($id)
    {
        $this->_supplier_model->delete($id);
        session()->setFlashdata("success", "Data has been Delete!");

        return redirect()->to('/supplier');
    }

}