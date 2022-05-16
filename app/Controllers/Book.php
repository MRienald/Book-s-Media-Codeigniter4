<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\BookCategoryModel;

define('TITLE', 'Catalog');

class Book extends BaseController
{

    private $_book_model, $_book_category_model;

    public function __construct(){
        $this->_book_model = new BookModel();
        $this->_book_category_model = new BookCategoryModel();
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
            'book_catagory'=> $this->_book_category_model->orderby('name_catagory')->findAll()
        ];
        return view('book/create', $data);
    }

    public function save(){
        // dd($this->request->getVar());
        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->_book_model->save([
            'title'             => $this->request->getVar('title'),
            'slug'              => $slug,
            'release_year'      => $this->request->getVar('release_year'),
            'author'            => $this->request->getVar('author'),
            'publisher'         => $this->request->getVar('publisher'),
            'price'             => $this->request->getVar('price'),
            'discount'          => $this->request->getVar('discount'),
            'stock'             => $this->request->getVar('stock'),
            'book_catagory_id'  => $this->request->getVar('book_catagory_id')
        ]);
        return redirect()->to('/book');
    }
}
