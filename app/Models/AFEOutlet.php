<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFEOutlet extends Model
{
    use HasFactory;

    protected $table = 'afe_outlet';

    protected $primaryKey = 'id_afe_outlet';

    protected $fillable = [
        'outlet_main_id',
        'afe_main_id',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function outletMain()
    {
        return $this->belongsTo(OutletMain::class, 'outlet_main_id', 'id_outlet_main');
    }

    public function afeMain()
    {
        return $this->hasOne(AFEMain::class, 'afe_main_id', 'id_afe_main');
    }
}
