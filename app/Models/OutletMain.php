<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutletMain extends Model
{
    use HasFactory;

    protected $table = 'outlet_main';

    protected $primaryKey = 'id_outlet_main';

    protected $fillable = [
        'outlet_id',
        'wp_main_id',
        'jenis_pajak_id',
        'status_outlet_id',
        'nama_wp',
        'nopd',
        'alamat_outlet',
        'kel_desa',
        'rt',
        'rw',
        'kode_pos',
        'lat',
        'lon',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function wpMain()
    {
        return $this->belongsTo(WpMain::class, 'wp_main_id', 'id_wp_main');
    }

    public function jenisPajak()
    {
        return $this->hasMany(JenisPajak::class, 'jenis_pajak_id', 'id_jenis_pajak');
    }

    public function statusOutlet()
    {
        return $this->hasOne(StatusOutlet::class, 'status_outlet_id', 'id_status_outlet');
    }

    public function afeOutlet()
    {
        return $this->hasMany(AFEOutlet::class, 'outlet_main_id', 'id_outlet_main');
    }
}
