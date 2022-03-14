<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAFE extends Model
{
    use HasFactory;

    protected $table = 'afe_status';

    protected $primaryKey = 'id_afe_status';

    protected $fillable = [
        'afe_status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
