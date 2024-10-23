<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PenjualanDetailModel extends Model

{
    
    protected $table = 't_penjualan_detail';        
    protected $primaryKey = 'penjualan_id'; 

    protected $fillable = ['penjualan_id','penjualan_kode','barang_id', 'harga', 'jumlah'];


    public function penjualan()
    {
        return $this->belongsTo(PenjualanModel::class, 'penjualan_id');
    }

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id');
    }

}

