<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'buku';
    protected $primarykey = 'book_id';
    protected $useTimestamps = true;
    protected $allowedFields = ['title', 'slug', 'author', 'release_year', 'price', 'stock', 'discount', 'book_catagory_id'];

    public function getBook($slug = null){
        
        if($slug===null){
            $this->join('book_catagory', 'buku.book_catagory_id = book_catagory.book_catagory_id');   
            return $this->get()->getResultArray(); 
        }else{
            $this->table('buku')
            ->join('book_catagory', 'buku.book_catagory_id = book_catagory.book_catagory_id');     
            $this->where(['slug' => $slug]);
            return $this->first();
        }
    }

}