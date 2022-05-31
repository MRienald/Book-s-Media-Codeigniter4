<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    // Nama Table
    protected $table            = 'sale';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['sale_id', 'user_id', 'customer_id'];

    public function getLaporan($tgl_awal, $tgl_akhir)
    {
        return $this->db->table('sale_detail as sd')
        ->select('s.created_at as tgl_transaksi, s.sale_id, s.user_id, u.firstname, u.lastname, c.name as nama_customer, s.customer_id, SUM(sd.total_price) as total')
            ->join('sale s', 'sd.sale_id = s.sale_id')
            ->join('users u', 'u.id = s.user_id')
            ->join('customer c', 'c.customer_id = s.customer_id', 'left')
            ->where('date(s.created_at) >=', $tgl_awal)
            ->where('date(s.created_at) <=', $tgl_akhir)
            ->groupBy('s.sale_id')
            ->get()->getResultArray();
    }
}