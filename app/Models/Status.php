<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $primaryKey = 'id_status';

    protected $fillable = [
        'siap_install',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
