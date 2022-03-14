<?php

namespace App\Http\Controllers;

use App\Models\OutletMain;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class OutletMainController extends Controller
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
            'data' => OutletMain::join('wp_main', 'outlet_main.wp_main_id', 'wp_main.id_wp_main')
                ->join('jenis_pajak', 'outlet_main.jenis_pajak_id', 'jenis_pajak.id_jenis_pajak')
                ->join('status_outlet', 'outlet_main.status_outlet_id', 'status_outlet.id_status_outlet')
                ->select('outlet_main.*', 'wp_main.id_wp_main', 'wp_main.nama_wp', 'jenis_pajak.jenis_pajak', 'status_outlet.status')
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
            'outlet_id' => 'required',
            'wp_main_id' => 'required',
            'jenis_pajak_id' => 'required',
            'status_outlet_id' => 'required',
            'nama_wp' => 'required',
            'nopd' => 'required',
            'alamat_outlet' => 'required',
            'kel_desa' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kode_pos' => 'required',
            'lat' => 'required',
            'lon' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            OutletMain::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Outlet berhasil ditambahkan',
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutletMain  $outletMain
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => OutletMain::join('wp_main', 'outlet_main.wp_main_id', 'wp_main.id_wp_main')
                ->join('jenis_pajak', 'outlet_main.jenis_pajak_id', 'jenis_pajak.id_jenis_pajak')
                ->join('status_outlet', 'outlet_main.status_outlet_id', 'status_outlet.id_status_outlet')
                ->select('outlet_main.*', 'wp_main.id_wp_main', 'wp_main.nama_wp', 'jenis_pajak.jenis_pajak', 'status_outlet.status')
                ->findOrFail($id)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OutletMain  $outletMain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'outlet_id' => 'required',
            'wp_main_id' => 'required',
            'jenis_pajak_id' => 'required',
            'status_outlet_id' => 'required',
            'nama_wp' => 'required',
            'nopd' => 'required',
            'alamat_outlet' => 'required',
            'kel_desa' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kode_pos' => 'required',
            'lat' => 'required',
            'lon' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            OutletMain::findOrFail($id)->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Outlet berhasil diubah',
            ], Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutletMain  $outletMain
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OutletMain::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Outlet berhasil dihapus',
        ], Response::HTTP_OK);
    }

    public function count()
    {
        return response()->json([
            'status' => 'success',
            'data' => OutletMain::count()
        ], Response::HTTP_OK);
    }

    /**
     * count afe dari masing-masing outlet
     */
    public function countAfe()
    {
        return response()->json([
            'status' => 'success',
            'data' => OutletMain::join('wp_main', 'outlet_main.wp_main_id', 'wp_main.id_wp_main')
                ->join('jenis_pajak', 'outlet_main.jenis_pajak_id', 'jenis_pajak.id_jenis_pajak')
                ->join('status_outlet', 'outlet_main.status_outlet_id', 'status_outlet.id_status_outlet')
                ->select('outlet_main.*', 'wp_main.id_wp_main', 'wp_main.nama_wp', 'jenis_pajak.jenis_pajak', 'status_outlet.status')
                ->get()
                ->groupBy('nama_wp')
                ->map(function ($item) {
                    return $item->count();
                })
        ], Response::HTTP_OK);
    }

    /**
     * get data lang dan lot outlet
     */
    public function getLangLotOutlet()
    {
        return response()->json([
            'status' => 'success',
            'data' => OutletMain::select('lat', 'lon', 'nama_wp')
                ->paginate(10)
        ], Response::HTTP_OK);
    }

    /**
     * get data lang dan lot outlet by outlet id
     */
    public function getLangLotOutletById($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => OutletMain::select('lat', 'lon', 'nama_wp')
                ->find($id)
        ], Response::HTTP_OK);
    }

    /**
     * get data outlet by wp_main_id
     */
    public function getOutletByWpMain($id)
    {
        return response()->json([
            'status' => 'success',
            'data' =>  OutletMain::join('wp_main', 'outlet_main.wp_main_id', 'wp_main.id_wp_main')
                ->join('jenis_pajak', 'outlet_main.jenis_pajak_id', 'jenis_pajak.id_jenis_pajak')
                ->join('status_outlet', 'outlet_main.status_outlet_id', 'status_outlet.id_status_outlet')
                ->select('outlet_main.*', 'wp_main.id_wp_main', 'wp_main.nama_wp', 'jenis_pajak.jenis_pajak', 'status_outlet.status')
                ->where('outlet_main.wp_main_id', $id)
                ->paginate(10)
        ], Response::HTTP_OK);
    }

    /**
     * count outlet join wp by wp
     */
    public function countOutletByWp($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => OutletMain::where('wp_main_id', $id)
                ->count()
        ], Response::HTTP_OK);
    }

    /**
     * Belum cek 
     */

    /**
     * get data outlet join wp by kode pemda
     */
    public function getOutletByKodePemda($id)
    {
        $outlet = OutletMain::join('wp_main', 'outlet_main.wp_main_id', 'wp_main.id_wp_main')
            ->join('jenis_pajak', 'outlet_main.jenis_pajak_id', 'jenis_pajak.id_jenis_pajak')
            ->join('status_outlet', 'outlet_main.status_outlet_id', 'status_outlet.id_status_outlet')
            ->select('outlet_main.*', 'wp_main.id_wp_main', 'wp_main.nama_wp', 'jenis_pajak.jenis_pajak', 'status_outlet.status')
            ->where('wp_main.kode_pemda', $id)
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => $outlet
        ], Response::HTTP_OK);
    }

    /**
     * count outlet join wp by kode pemda
     */
    public function countOutletByKodePemda($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => OutletMain::join('wp_main', 'outlet_main.wp_main_id', 'wp_main.id_wp_main')
                ->join('jenis_pajak', 'outlet_main.jenis_pajak_id', 'jenis_pajak.id_jenis_pajak')
                ->join('status_outlet', 'outlet_main.status_outlet_id', 'status_outlet.id_status_outlet')
                ->select('outlet_main.*', 'wp_main.id_wp_main', 'wp_main.nama_wp', 'jenis_pajak.jenis_pajak', 'status_outlet.status')
                ->where('wp_main.kode_pemda', $id)
                ->count()
        ], Response::HTTP_OK);
    }
    
    /**
     * get data outlet by jenis_pajak_id
     */
    public function getOutletByJenisPajak($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => OutletMain::join('wp_main', 'outlet_main.wp_main_id', 'wp_main.id_wp_main')
                ->join('jenis_pajak', 'outlet_main.jenis_pajak_id', 'jenis_pajak.id_jenis_pajak')
                ->join('status_outlet', 'outlet_main.status_outlet_id', 'status_outlet.id_status_outlet')
                ->select('outlet_main.*', 'wp_main.id_wp_main', 'wp_main.nama_wp', 'jenis_pajak.jenis_pajak', 'status_outlet.status')
                ->where('outlet_main.jenis_pajak_id', $id)
                ->paginate(10)
        ], Response::HTTP_OK);
    }

    /**
     * count outlet by jenis pajak
     */
    public function countOutletByJenisPajak($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => OutletMain::where('jenis_pajak_id', $id)->count()
        ], Response::HTTP_OK);
    }

    /**
     * get data outlet by status_outlet_id
     */
    public function getOutletByStatus($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => OutletMain::join('wp_main', 'outlet_main.wp_main_id', 'wp_main.id_wp_main')
                ->join('jenis_pajak', 'outlet_main.jenis_pajak_id', 'jenis_pajak.id_jenis_pajak')
                ->join('status_outlet', 'outlet_main.status_outlet_id', 'status_outlet.id_status_outlet')
                ->select('outlet_main.*', 'wp_main.id_wp_main', 'wp_main.nama_wp', 'jenis_pajak.jenis_pajak', 'status_outlet.status')
                ->where('outlet_main.status_outlet_id', $id)
                ->paginat(10)
        ], Response::HTTP_OK);
    }

    /**
     * count outlet by status
     */
    public function countOutletByStatus($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => OutletMain::where('status_outlet_id', $id)->count()
        ], Response::HTTP_OK);
    }
}
