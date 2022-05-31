<?php

namespace App\Controllers;

use App\Models\UsersModel;
use Myth\Auth\Password;

define('TITLE', 'Profile');

class Profile extends BaseController
{

    private $_user_model;
    public function __construct()
    {
        $this->_user_model = new UsersModel();
    }

    public function index()
    {

        $data_user = $this->_user_model->getUsers(user_id());
        // dd($data_user);
        $data = [
            'title' => TITLE,
            'result'=>$data_user
        ];
        return view('profile/edit', $data);
    }

    public function updateProfile($id)
    {
        $this->_user_model->save([
            'id'                => $id,
            'firstname'         => $this->request->getVar('firstname'),
            'lastname'          => $this->request->getVar('lastname'),
            'username'          => $this->request->getVar('username'),
            'email'             => $this->request->getVar('email')
        ]);

        session()->setFlashdata('success', 'Data update successfully.');
        return redirect()->to('/profile');
    }

    public function ubahPassword()
    {
        $data = [
            'title'         => TITLE,
            'validation'    => \Config\Services::validation()
        ];

        return view('profile/ubah-password', $data);
    }

    public function updatePassword($id)
    {
        // validasi
        if(!$this->validate([
            'password_lama'             => 'required',
            'password_baru'             => 'required|strong_password',
            'konfirm_password_baru'     => 'required|matches[password_baru]' 
        ])){
            return redirect()->to('/password')->withInput();
        } else{
            $this->_user_model->save([
                'id'                => $id,
                'password_hash'         => Password::hash($this->request->getVar('password_baru'))
            ]);
    
            session()->setFlashdata('success', 'Password update successfully.');
            return redirect()->to('/password');
        }
    }

}
