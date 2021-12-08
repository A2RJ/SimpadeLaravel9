<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukAFE extends Model
{
    use HasFactory;

    protected $table = 'produk_afe';
    
    protected $primaryKey = 'id_produk_afe';

    protected $fillable = [
        'jenis_afe',
        'produk_afe'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
