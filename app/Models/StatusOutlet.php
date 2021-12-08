<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOutlet extends Model
{
    use HasFactory;

    protected $table = 'status_outlet';

    protected $primaryKey = 'id_status_outlet';

    protected $fillable = [
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
