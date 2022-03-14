<?php

namespace App\Http\Controllers;

use App\Models\WPMain;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class WPMainController extends Controller
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
            'data' => WPMain::join('kategori_wp', 'wp_main.kategori_wp_id', 'kategori_wp.id_kategori_wp')
                ->select('wp_main.*', 'kategori_wp.kategori_wp')
                ->paginate(10)
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
            'wp_id' => 'required',
            'kategori_wp_id' => 'required',
            'nama_wp' => 'required',
            'email' => 'required|string|email|max:255|unique:wp_main',
            'password' => 'required|string|min:8',
            'npwpd' => 'required',
            'alamat_wp' => 'required',
            'kode_pemda_tk2' => 'required',
            'kode_desa_lurah' => 'required',
            'kode_pos' => 'required',
            'tanggal_aktif_wp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            WPMain::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan'
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WPMain  $wPMain
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => WPMain::join('kategori_wp', 'wp_main.kategori_wp_id', 'kategori_wp.id_kategori_wp')
                ->select('wp_main.*', 'kategori_wp.kategori_wp')
                ->findOrFail($id)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WPMain  $wPMain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->has('email') && WPMain::where('email', $request->email)->where('id_wp_main', '!=', $id)->count() !== 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email sudah digunakan'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $validator = Validator::make($request->all(), [
            'wp_id' => 'required',
            'kategori_wp_id' => 'required',
            'nama_wp' => 'required',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'npwpd' => 'required',
            'alamat_wp' => 'required',
            'kode_pemda_tk2' => 'required',
            'kode_desa_lurah' => 'required',
            'kode_pos' => 'required',
            'tanggal_aktif_wp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            WPMain::findOrFail($id)->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diupdate'
            ], Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WPMain  $wPMain
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WPMain::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ], Response::HTTP_OK);
    }

    /**
     * get data wp by kategori
     */
    public function getWpByKategori($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => WPMain::join('kategori_wp', 'wp_main.kategori_wp_id', 'kategori_wp.id_kategori_wp')
                ->where('kategori_wp.id_kategori_wp', $id)
                ->select('wp_main.*')
                ->paginate(10)
        ], Response::HTTP_OK);
    }

    /**
     * get data wp join outlet by id_outlet
     */
    public function getWpByOutlet($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => WPMain::join('outlet_main', 'wp_main.id_wp_main', 'outlet_main.wp_main_id')
                ->where('outlet_main.id_outlet_main', $id)
                ->select('wp_main.*')
                ->first()
        ], Response::HTTP_OK);
    }

    /**
     * get data wp join outlet join afe outlet by id_afe
     */
    public function getWpByAfe($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => WPMain::join('outlet_main', 'wp_main.id_wp_main', 'outlet_main.wp_main_id')
                ->join('afe_outlet', 'outlet_main.id_outlet_main', 'afe_outlet.outlet_main_id')
                ->where('afe_outlet.id_afe_outlet', $id)
                ->select('wp_main.*')
                ->first()
        ], Response::HTTP_OK);
    }

    /**
     * get data outlet by kode pemda
     */
    public function getWpByKodePemda($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => WPMain::join('kategori_wp', 'wp_main.kategori_wp_id', 'kategori_wp.id_kategori_wp')
                ->where('wp_main.kode_pemda_tk2', $id)
                ->select('wp_main.*')
                ->paginat(10)
        ], Response::HTTP_OK);
    }

    /**
     * Hitung jumlah wajib pajak
     *
     * @return \Illuminate\Http\Response
     */
    public function count()
    {
        return response()->json([
            'status' => 'success',
            'data' => WPMain::count()
        ], Response::HTTP_OK);
    }

    /**
     * Hitung jumlah wp by daerah
     *
     * @return \Illuminate\Http\Response
     */
    public function countByDaerah()
    {
        $daerah = WPMain::select('kode_pemda_tk2')->groupBy('kode_pemda_tk2')->get();
        $data = [];
        foreach ($daerah as $key => $value) {
            $data[$value->kode_pemda_tk2] = WPMain::where('kode_pemda_tk2', $value->kode_pemda_tk2)->count();
        }
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], Response::HTTP_OK);
    }

    /**
     * Hitung jumlah wajib pajak di satu daerah
     *
     * @return \Illuminate\Http\Response
     */
    public function countWpByDaerahId($id)
    {
        return response()->json([
            'status' => 'success',
            'data' =>  WPMain::join('kategori_wp', 'wp_main.kategori_wp_id', 'kategori_wp.id_kategori_wp')
                ->where('wp_main.kode_pemda_tk2', $id)
                ->count()
        ], Response::HTTP_OK);
    }

    /**
     * get data semua wp dan semua outlet
     */
    public function getAllWpOutlet()
    {
        return response()->json([
            'status' => 'success',
            'data' => WPMain::join('kategori_wp', 'wp_main.kategori_wp_id', 'kategori_wp.id_kategori_wp')
                ->with('outlet')
                ->paginate(10)
        ], Response::HTTP_OK);
    }

    /**
     * get data wp dan semua outlet by id_wp_main
     */
    public function getWpOutletByIdWp($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => WPMain::join('kategori_wp', 'wp_main.kategori_wp_id', 'kategori_wp.id_kategori_wp')
                ->with('outlet')
                ->find($id)
        ], Response::HTTP_OK);
    }

    /**
     * get data wp dan outlet by kategori wp
     */
    public function getWpOutletByKategori($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => WPMain::join('kategori_wp', 'wp_main.kategori_wp_id', 'kategori_wp.id_kategori_wp')
                ->with('outlet')
                ->where('wp_main.kategori_wp_id', $id)
                ->paginat(10)
        ], Response::HTTP_OK);
    }

    /**
     * get data wp join outlet join afe by afe outlet
     */
    public function getWpOutletByAfe($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => WPMain::join('kategori_wp', 'wp_main.kategori_wp_id', 'kategori_wp.id_kategori_wp')
                ->join('outlet_main', 'wp_main.id_wp_main', 'outlet_main.wp_main_id')
                ->join('afe_outlet', 'outlet_main.id_outlet_main', 'afe_outlet.outlet_main_id')
                ->select('wp_main.*', 'kategori_wp.kategori_wp')
                ->where('afe_outlet.id_afe_outlet', $id)
                ->first()
        ], Response::HTTP_OK);
    }

    /**
     * get data wp join outlet join afe by kode pemda
     */
    public function getWpOutletByKodePemda($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => WPMain::join('kategori_wp', 'wp_main.kategori_wp_id', 'kategori_wp.id_kategori_wp')
                ->join('outlet_main', 'wp_main.id_wp_main', 'outlet_main.wp_main_id')
                ->join('afe_outlet', 'outlet_main.id_outlet_main', 'afe_outlet.outlet_main_id')
                ->where('wp_main.kode_pemda_tk2', $id)
                ->paginat(10)
        ], Response::HTTP_OK);
    }
}
