<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFEMain extends Model
{
    use HasFactory;

    protected $table = 'afe_main';

    protected $primaryKey = 'id_afe_main';

    protected $fillable = [
        'afe_id',
        'produk_afe_id',
        'kategori_afe_id',
        'status_id',
        'afe_status_id',
        'tanggal_install',
        'tanggal_aktif',
        'wp_view',
        'serial_number',
        'tanggal_produksi',
        'tanggal_deliver',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the afe that owns the afe main.
     */
    public function kategoriAfeId()
    {
        return $this->hasOne(KategoriAFE::class, 'kategori_afe_id', 'id_kategori_afe');
    }

    public function statusId()
    {
        return $this->hasOne(Status::class, 'status_id', 'id_status');
    }

    public function StatusAFEId()
    {
        return $this->hasOne(StatusAFE::class, 'afe_status_id', 'id_afe_status');
    }
}
