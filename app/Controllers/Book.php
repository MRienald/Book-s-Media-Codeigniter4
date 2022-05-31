<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\BookCategoryModel;

define('TITLE', 'Catalog');

class Book extends BaseController
{

    private $_book_model, $_book_category_model;
    private $_defaultImg;

    public function __construct(){
        $this->_book_model = new BookModel();
        $this->_book_category_model = new BookCategoryModel();
        $this->_defaultImg = "tumbnail.png";
    }

    public function index()
    {
        $data_book = $this->_book_model->getBook();
        $data = [
            'title'=> TITLE,
            'data_book' => $data_book
        ];
        // dd($data_book);
        return view('book/index', $data);
    }

    public function detail($slug){
        $data_book = $this->_book_model->getBook($slug);
        $data = [
            'title'=> TITLE,
            'data_book' => $data_book
        ];
        // dd($data_book);
        return view('book/detail', $data);
    }

    public function create(){
        $data = [
            'title'=> TITLE, 
            'book_catagory'=> $this->_book_category_model->orderby('name_catagory')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('book/create', $data);
    }

    public function save(){
        if(!$this->validate([
            'title'             => [
                'rules'     => 'required|is_unique[buku.title]',
                'label'     => 'Title',
                'errors'    => [
                    'required' => '{field} is required!',
                    'is_unique' => 'Cant enter the same {field}!'
                ]
            ],
            'release_year'      => [
                'rules'     => 'required|numeric',
                'label'     => 'Data',
                'errors'    => [
                    'required' => '{field} is required!',
                    'numeric'  => '{field} entered must contain only numbers.'
                ]
            ],
            'author'            => 'required',
            'publisher'         => 'required',
            'price'             => [
                'rules'     => 'required|numeric',
                'label'     => 'Data',
                'errors'    => [
                    'required' => '{field} is required!',
                    'numeric'  => '{field} entered must contain only numbers.'
                ]
            ],
            'discount'            => 'numeric',
            'stock'             => [
                'rules'     => 'required|numeric',
                'label'     => 'Data',
                'errors'    => [
                    'required' => '{field} is required!',
                    'numeric'  => '{field} entered must contain only numbers.'
                ]
            ],
            'cover'             => [
                'rules'     => 'max_size[cover,10240]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'label'     => 'File',
                'errors'    => [
                    'max_size' => '{field} cannot be more than 10MB.',
                    'is_image' => 'The selected {field} is not an image!',
                    'mime_in'  => 'The selected {field} is not an image!'
                ]
            ],
            'book_catagory_id'  => 'required',
        ])){
            return redirect()->to('/book-create')->withInput();
        }

        $file_cover = $this->request->getFile('cover');
        if($file_cover->getError() === 4){
            $nama_file =  $this->_defaultImg;
        }else{
            $nama_file = $file_cover->getRandomName();
            $file_cover->move('img', $nama_file);
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        if($this->_book_model->save([
            'title'             => $this->request->getVar('title'),
            'slug'              => $slug,
            'release_year'      => $this->request->getVar('release_year'),
            'author'            => $this->request->getVar('author'),
            'publisher'         => $this->request->getVar('publisher'),
            'price'             => $this->request->getVar('price'),
            'discount'          => $this->request->getVar('discount'),
            'stock'             => $this->request->getVar('stock'),
            'book_catagory_id'  => $this->request->getVar('book_catagory_id'),
            'cover'             => $nama_file
        ])){
            session()->setFlashdata('success', 'Data saved successfully!');
        }else{
            session()->setFlashdata('error', 'Data failed to be save!');
        }
        return redirect()->to('/book');
    }

    public function edit($slug){
        $data = [
            "title"     =>  TITLE,
            "result"    =>  $this->_book_model->getBook($slug),
            'book_catagory'=> $this->_book_category_model->orderby('name_catagory')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('book/edit', $data);
    }

    public function update($id){

        $slug_old = $this->request->getVar('slug_old');
        $dataBookOld = $this->_book_model->getBook($slug_old);

        if($dataBookOld['title'] === $this->request->getVar('title')){
            $rule_title = 'required';
        } else {
            $rule_title = 'required|is_unique[buku.title]';
        }

        if(!$this->validate([
            'title'             => [
                'rules'     => $rule_title,
                'label'     => 'Title',
                'errors'    => [
                    'required' => '{field} is required!',
                    'is_unique' => 'Cant enter the same {field}!'
                ]
            ],
            'release_year'      => [
                'rules'     => 'required|numeric',
                'label'     => 'Data',
                'errors'    => [
                    'required' => '{field} is required!',
                    'numeric'  => '{field} entered must contain only numbers.'
                ]
            ],
            'author'            => 'required',
            'publisher'         => 'required',
            'price'             => [
                'rules'     => 'required|numeric',
                'label'     => 'Data',
                'errors'    => [
                    'required' => '{field} is required!',
                    'numeric'  => '{field} entered must contain only numbers.'
                ]
            ],
            'discount'            => 'numeric',
            'stock'             => [
                'rules'     => 'required|numeric',
                'label'     => 'Data',
                'errors'    => [
                    'required' => '{field} is required!',
                    'numeric'  => '{field} entered must contain only numbers.'
                ]
            ],
            'cover'             => [
                'rules'     => 'max_size[cover,10240]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'label'     => 'File',
                'errors'    => [
                    'max_size' => '{field} cannot be more than 10MB.',
                    'is_image' => 'The selected {field} is not an image!',
                    'mime_in'  => 'The selected {field} is not an image!'
                ]
            ],
            'book_catagory_id'  => 'required',
            
        ])){
            return redirect()->to('/book-edit/'.$slug_old)->withInput();
        }

        $file_cover = $this->request->getFile('cover');
        if($file_cover->getError() === 4){
            $nama_file =  $this->_defaultImg;
        }else{
            $nama_file = $file_cover->getRandomName();
            $file_cover->move('img', $nama_file);
            $file_cover_old = $dataBookOld['cover'];

            if ($file_cover_old != $this->_defaultImg){
                unlink('img/' . $file_cover_old);
            }
            
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        if($this->_book_model->save([
            'book_id'           => $id,
            'title'             => $this->request->getVar('title'),
            'slug'              => $slug,
            'release_year'      => $this->request->getVar('release_year'),
            'author'            => $this->request->getVar('author'),
            'publisher'         => $this->request->getVar('publisher'),
            'price'             => $this->request->getVar('price'),
            'discount'          => $this->request->getVar('discount'),
            'stock'             => $this->request->getVar('stock'),
            'book_catagory_id'  => $this->request->getVar('book_catagory_id'),
            'cover'             => $nama_file
        ])){
            session()->setFlashdata('success', 'Data updated successfully!');
        }else{
            session()->setFlashdata('error', 'Data failed to update!');
        }
        // dd($this->request->getVar());
        return redirect()->to('/book');
    }

    public function delete($id){
        $dataBookOld = $this->_book_model->where(['book_id' => $id])->first();
        $file_cover_old = $dataBookOld['cover'];
        $this->_book_model->delete($id);
        session()->setFlashdata('success', 'Data has been Delete!');

        if ($file_cover_old != $this->_defaultImg){
            unlink('img/' . $file_cover_old);
        }

        return redirect()->to('/book');
    }

}
