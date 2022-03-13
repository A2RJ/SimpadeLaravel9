<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriWP extends Model
{
    use HasFactory;

    protected $table = 'kategori_wp';

    protected $primaryKey = 'id_kategori_wp';

    protected $fillable = [
        'kategori_wp'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
