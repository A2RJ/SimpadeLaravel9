<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Transaksi::all()
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wp_main_id' => 'require',
            'outlet_main_id' => 'require',
            'produk_afe_id' => 'require',
            'kategori_afe_id' => 'require',
            'jenis_amount_id' => 'require',
            'serial_number' => 'require',
            'tanggal_transaksi' => 'require',
            'nomor_faktur' => 'require',
            'amount' => 'require',
            'pajak_daerah' => 'require',
            'timestamp_app' => 'require',
            'timestamp_afe' => 'require',
            'inspection_code' => 'require',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            Transaksi::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi Berhasil Ditambahkan'
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => Transaksi::findOrFail($id)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'wp_main_id' => 'require',
            'outlet_main_id' => 'require',
            'produk_afe_id' => 'require',
            'kategori_afe_id' => 'require',
            'jenis_amount_id' => 'require',
            'serial_number' => 'require',
            'tanggal_transaksi' => 'require',
            'nomor_faktur' => 'require',
            'amount' => 'require',
            'pajak_daerah' => 'require',
            'timestamp_app' => 'require',
            'timestamp_afe' => 'require',
            'inspection_code' => 'require',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            Transaksi::findOrFail($id)->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Data transaksi berhasil diupdate'
            ], Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data transaksi berhasil dihapus'
        ], Response::HTTP_OK);
    }

    /**
     * sum semua transaksi
     */
    public function sumTransaksi()
    {
        $transaksi = Transaksi::sum('amount');
        return response()->json([
            'status' => 'success',
            'data' => $transaksi
        ], Response::HTTP_OK);
    }

    /**
     * sum semua transaksi join dengan wp dan outlet by kode_pemda_tk2
     */
    public function sumTransaksiJoinWPOutlet($kode_pemda_tk2)
    {
        $transaksi = Transaksi::join('wp_main', 'wp_main.id', '=', 'transaksi.wp_main_id')
            ->join('outlet_main', 'outlet_main.id', '=', 'transaksi.outlet_main_id')
            ->where('wp_main.kode_pemda_tk2', $kode_pemda_tk2)
            ->sum('transaksi.amount');
        return response()->json([
            'status' => 'success',
            'data' => $transaksi
        ], Response::HTTP_OK);
    }

   /**
    * sum semua transaksi join outlet join wp by wp_main_id
    */
    public function sumTransaksiJoinWP($wp_main_id)
    {
        $transaksi = Transaksi::join('wp_main', 'wp_main.id', '=', 'transaksi.wp_main_id')
            ->join('outlet_main', 'outlet_main.id', '=', 'transaksi.outlet_main_id')
            ->where('transaksi.wp_main_id', $wp_main_id)
            ->sum('transaksi.amount');
        return response()->json([
            'status' => 'success',
            'data' => $transaksi
        ], Response::HTTP_OK);
    }

    /**
     * sum semua transaksi join outlet by outlet_main_id
     */
    public function sumTransaksiJoinOutlet($outlet_main_id){
        $transaksi = Transaksi::join('wp_main', 'wp_main.id', '=', 'transaksi.wp_main_id')
            ->join('outlet_main', 'outlet_main.id', '=', 'transaksi.outlet_main_id')
            ->where('transaksi.outlet_main_id', $outlet_main_id)
            ->sum('transaksi.amount');
        return response()->json([
            'status' => 'success',
            'data' => $transaksi
        ], Response::HTTP_OK);
    }

    /**
     * sum semua transaksi berdasarkan kode pemda dan bagi 10%
     */
    public function sumTransaksiByKodePemda($kode_pemda_tk2){
        $transaksi = Transaksi::join('wp_main', 'wp_main.id', '=', 'transaksi.wp_main_id')
            ->join('outlet_main', 'outlet_main.id', '=', 'transaksi.outlet_main_id')
            ->where('wp_main.kode_pemda_tk2', $kode_pemda_tk2)
            ->sum('transaksi.amount');
        $pajak = $transaksi * 0.1;
        return response()->json([
            'status' => 'success',
            'data' => $pajak
        ], Response::HTTP_OK);
    }

    /**
     * sum semua transaksi berdasarkan wp dan bagi 10%
     */
    public function sumTransaksiByWP($wp_main_id){
        $transaksi = Transaksi::join('wp_main', 'wp_main.id', '=', 'transaksi.wp_main_id')
            ->join('outlet_main', 'outlet_main.id', '=', 'transaksi.outlet_main_id')
            ->where('transaksi.wp_main_id', $wp_main_id)
            ->sum('transaksi.amount');
        $pajak = $transaksi * 0.1;
        return response()->json([
            'status' => 'success',
            'data' => $pajak
        ], Response::HTTP_OK);
    }
}
