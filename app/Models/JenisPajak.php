<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPajak extends Model
{
    use HasFactory; 

    protected $table = 'jenis_pajak';

    protected $primaryKey = 'id_jenis_pajak';

    protected $fillable = [
        'jenis_pajak',
        'tarif'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
