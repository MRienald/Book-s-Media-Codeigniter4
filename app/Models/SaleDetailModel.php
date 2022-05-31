<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleDetailModel extends Model
{
    // Nama Table
    protected $table            = 'sale_detail';
    protected $allowedFields    = ['sale_id', 'book_id', 'amount', 'price', 'discount', 'total_price'];

    public function getDetail($sale_id)
    {
        return $this->select('sale_detail.*, b.*, bc.name_catagory')
            ->join('buku b', 'book_id')
            ->join('book_catagory bc', 'book_catagory_id')
            ->where('sale_id', $sale_id)
            ->findAll();
    }
}