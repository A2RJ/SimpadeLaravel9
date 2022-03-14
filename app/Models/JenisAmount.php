<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAmount extends Model
{
    use HasFactory;

    protected $table = 'jenis_amount';

    protected $primaryKey = 'id_jenis_amount';

    protected $fillable = [
        'jenis_amount'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
