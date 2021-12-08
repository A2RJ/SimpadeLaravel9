<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'wp_main_id',
        'outlet_main_id',
        'produk_afe_id',
        'kategori_afe_id',
        'jenis_amount_id',
        'serial_number',
        'tanggal_transaksi',
        'nomor_faktur',
        'amount',
        'pajak_daerah',
        'timestamp_app',
        'timestamp_afe',
        'inspection_code',
    ];


}
