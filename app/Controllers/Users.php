<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

define('TITLE', 'Users');

class Users extends BaseController
{

    private $_user_model;

    public function __construct()
    {
        $this->_user_model = new UsersModel();
    }

    public function index()
    {
        $data_user  = $this->_user_model->getUsers();  
        // dd($data_user);
        $data       = [
            "title"     =>  TITLE,
            "result"    =>  $data_user
        ];

        return view('user/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => TITLE
        ];
        return view('user/create', $data);
    }

    public function save()
    {
        $user_myth = new UserModel();
        $user_myth->withGroup($this->request->getVar('role'))->save([
            'firstname'         => $this->request->getVar('firstname'),
            'lastname'          => $this->request->getVar('lastname'),
            'username'          => $this->request->getVar('username'),
            'email'             => $this->request->getVar('email'),
            'password_hash'     => Password::hash("123456"),
            'active'            => 1
        ]);

        session()->setFlashdata('success', 'Data added successfully.');
        return redirect()->to('/users');

    }

    public function delete($id)
    {
        $this->_user_model->delete($id);
        session()->setFlashdata("success", "Data has been Delete!");

        return redirect()->to('/users');
    }

}
