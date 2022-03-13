<?php

namespace App\Http\Controllers;

use App\Models\AFEMain;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AFEMainController extends Controller
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
            'data' => AFEMain::join('produk_afe', 'afe_main.produk_afe_id', 'produk_afe.id_produk_afe')
                ->join('kategori_afe', 'afe_main.kategori_afe_id', 'kategori_afe.id_kategori_afe')
                ->join('afe_status', 'afe_main.afe_status_id', 'afe_status.id_afe_status')
                ->select('afe_main.*', 'kategori_afe.kategori_afe', 'produk_afe.produk_afe', 'afe_status.afe_status')
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
            'afe_id' => 'required',
            'produk_afe_id' => 'required',
            'kategori_afe_id' => 'required',
            'status_id' => 'required',
            'afe_status_id' => 'required',
            'tanggal_install' => 'required',
            'tanggal_aktif' => 'required',
            'wp_view' => 'required',
            'serial_number' => 'required|unique:afe_main',
            'tanggal_produksi' => 'required',
            'tanggal_deliver' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        AFEMain::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'AFE Main Berhasil Ditambahkan',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AFEMain  $afemain
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => AFEMain::join('produk_afe', 'afe_main.produk_afe_id', 'produk_afe.id_produk_afe')
                ->join('kategori_afe', 'afe_main.kategori_afe_id', 'kategori_afe.id_kategori_afe')
                ->join('afe_status', 'afe_main.afe_status_id', 'afe_status.id_afe_status')
                ->select('afe_main.*', 'kategori_afe.kategori_afe', 'produk_afe.produk_afe', 'afe_status.afe_status')
                ->findOrFail($id)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AFEMain  $afemain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'afe_id' => 'required',
            'kategori_afe_id' => 'required',
            'status_id' => 'required',
            'afe_status_id' => 'required',
            'tanggal_install' => 'required',
            'tanggal_aktif' => 'required',
            'wp_view' => 'required',
            'serial_number' => 'required',
            'tanggal_produksi' => 'required',
            'tanggal_deliver' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            AFEMain::findOrFail($id)->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'AFE Main Berhasil Diubah',
            ], Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AFEMain  $afemain
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AFEMain::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'AFE Main Berhasil Dihapus',
        ], Response::HTTP_OK);
    }
}
