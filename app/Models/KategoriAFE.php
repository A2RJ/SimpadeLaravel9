<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAFE extends Model
{
    use HasFactory;

    protected $table = 'kategori_afe';

    protected $primaryKey = 'id_kategori_afe';

    protected $fillable = [
        'kategori_afe'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
