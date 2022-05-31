<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\CustomerModel;
use App\Models\SaleModel;
use App\Models\SaleDetailModel;

define('TITLE', 'Transaction');

class Penjualan extends BaseController
{

    private $_book_model, $_cart, $_customer_model;
    private $_sale_model, $_sale_detail_model;

    public function __construct()
    {
        $this->_book_model  = new BookModel();
        $this->_customer_model = new CustomerModel();
        $this->_sale_model = new SaleModel();
        $this->_sale_detail_model = new SaleDetailModel();
        $this->_cart        = \Config\Services::cart();
    }

    public function index()
    {
        // dd($this->_cart->contents());
        $this->_cart->destroy();
        $data_book = $this->_book_model->getBook();
        $data_customer = $this->_customer_model->findAll();
        $data = [
            'title'         => TITLE,
            'data_buku'     => $data_book,
            'data_customer' => $data_customer
        ];

        return view('penjualan/index', $data);
    }

    public function add_cart()
    {
        $this->_cart->insert(array(
            'id'      => $this->request->getVar('id_buku'),
            'qty'     => 1,
            'price'   => $this->request->getVar('harga_buku'),
            'name'    => $this->request->getVar('judul_buku'),
            'options' => array(
                'discount'  =>  $this->request->getVar('diskon')
                )
         ));
         echo $this->show_cart();
    }

    public function show_cart()
    {
        $output = "";
        $no=1;
        foreach($this->_cart->contents() as $item){
            $diskon = ($item['options']['discount'] / 100) * $item['subtotal'];
            $output .= '
            <tr>
                <td><center>'. $no++ .'</center></td>
                <td><center>'. $item['name'] .'</center></td>
                <td><center>'. $item['qty'] .'</center></td>
                <td><center>'. number_to_currency($item['price'], 'IDR', 'id_ID', 2) .'</center></td>
                <td><center>'. $item['options']['discount'] .'</center></td>
                <td><center>'. number_to_currency(($item['subtotal'] - $diskon), 'IDR', 'id_ID', 2) .'</center></td>
                <td><center>
                    <button class="edit_cart btn btn-warning" id="'. $item['rowid'] .'" qty="'. $item['qty'] .'" >Ubah</button>
                    <button id="'. $item['rowid'] .'" class="hapus_cart btn btn-danger">Hapus</button>
                    </center>
                </td>
            </tr>
            '; 
        }
        return $output;
    }

    public function delete_cart($rowid)
    {
        $this->_cart->remove($rowid);

        return $this->show_cart();
    }

    public function update_cart($rowid)
    {
        $this->_cart->update(array(
            'rowid'   => $rowid,
            'qty'     => $this->request->getVar('jumlah'),
         ));
    }

    public function getTotal()
    {
        $total =0;
        foreach($this->_cart->contents() as $item){
            $diskon = ($item['options']['discount'] / 100) * $item['subtotal'];
            $total += $item['subtotal'] - $diskon;
        }

        echo number_to_currency($total, 'IDR', 'id_ID', 2);
    }

    public function pembayaran()
    {
        if(!$this->_cart->contents()){
            $response = [
                'status'    => false,
                'msg'       => 'Tidak ada transaksi'
            ];
            echo json_encode($response);
        } else {
            $total =0;
            foreach($this->_cart->contents() as $item){
                $diskon = ($item['options']['discount'] / 100) * $item['subtotal'];
                $total += $item['subtotal'] - $diskon;
            }

            $nominal = $this->request->getVar('nominal');

            if($nominal < $total){
                $response = [
                    'status'    => false,
                    'msg'       => 'Nominal tidak cukup'
                ];
                echo json_encode($response);
            } else {
                $sale_id = "JTK". time();
                $this->_sale_model->save([
                    'sale_id'       => $sale_id,
                    'customer_id'   => $this->request->getVar('customer'),
                    'user_id'       => user_id() 
                ]);

                foreach($this->_cart->contents() as $item){
                    $diskon = ($item['options']['discount'] / 100) * $item['subtotal'];
                    $this->_sale_detail_model->save([
                        'sale_id'       => $sale_id,
                        'book_id'       => $item['id'],
                        'amount'        => $item['qty'],
                        'price'         => $item['price'],
                        'discount'      => $diskon,
                        'total_price'   => $item['subtotal'] - $diskon
                    ]);

                    //update stock
                    $data_buku = $this->_book_model->where(['book_id'=>$item['id']])->first();
                    $this->_book_model->save([
                        'book_id'   => $item['id'],
                        'stock'     => $data_buku['stock'] - $item['qty']
                    ]); 
                }

                // kembalian 
                $kembalian = $nominal - $total;
                $this->_cart->destroy();
                $response = [
                    'status'    => true,
                    'msg'       => 'pembayaran berhasil',
                    'kembalian' => number_to_currency(($kembalian), 'IDR', 'id_ID', 2) 
                ];
                echo json_encode($response);
            }
        }
    }

    public function laporan($tgl_awal = null , $tgl_akhir = null)
    {
        $tgl1 = $tgl_awal == null ? date('Y-m-01'):$tgl_awal;
        $tgl2 = $tgl_akhir == null ? date('Y-m-t'):$tgl_akhir;

        $laporan = $this->_sale_model->getLaporan($tgl1, $tgl2);
        // dd($laporan);
        $data = [
            'title'     => TITLE,
            'result'    => $laporan,
            'tanggal'   => [
                'tgl_awal'  => $tgl1,
                'tgl_akhir' => $tgl2
            ]
        ];
        return view ('penjualan/laporan', $data);
    }

    public function filter()
    {
        $tgl_awal = $this->request->getVar('tgl_awal');
        $tgl_akhir = $this->request->getVar('tgl_akhir');

        return $this->laporan($tgl_awal, $tgl_akhir);
    }

    public function detail($sale_id)
    {
        $data = [
            'title'     => TITLE,
            'result'    => $this->_sale_detail_model->getDetail($sale_id)
        ];

        return view('penjualan/detail', $data);
    }
}
