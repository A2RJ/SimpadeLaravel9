<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WPMain extends Model
{
    use HasFactory;

    protected $table = 'wp_main';

    protected $primaryKey = 'id_wp_main';

    protected $fillable = [
        'wp_id',
        'kategori_wp_id',
        'nama_wp',
        'email',
        'password',
        'npwpd',
        'alamat_wp',
        'kode_pemda_tk2',
        'kode_desa_lurah',
        'kode_pos',
        'tanggal_aktif_wp',
        'role'
    ];

    protected $hidden = [
        'password',
        // 'roledb',
        'created_at',
        'updated_at',
    ];

    /** 
     * WPMain::find($id)->kategoriWp
     * Fungsinya untuk mengambil data kategori wp berdasarkan id wp
     * 
     * WPMain::find($id)->kategoriWp->nama_kategori_wp
     * Fungsinya untuk mengambil data nama kategori wp berdasarkan id wp
     * 
     * WPMain::join()->find($id)
     * Fungsinya untuk mengambil data wp berdasarkan id wp join tabel lain
    */

    /**
     * Get the kategoriWp for the blog post.
     */
    public function kategoriWp()
    {
        return $this->hasOne(KategoriWp::class, 'id_kategori_wp', 'kategori_wp_id');
    }

    /**
     * get the outlet for the wp main
     */
    public function outlet(){
        return $this->hasMany(OutletMain::class, 'wp_main_id', 'id_wp_main');
    }
}
