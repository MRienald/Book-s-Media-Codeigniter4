<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    // Nama Table
    protected $table            = 'customer';
    protected $primaryKey       = 'customer_id';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['name', 'no_customer', 'address', 'gender', 'email', 'phone'];
    protected $useSoftDeletes = true;
}