<?php

namespace App\Http\Controllers;

use App\Models\ProdukAFE;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProdukAFEController extends Controller
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
            'data' => ProdukAFE::all()
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
            'jenis_afe' => 'required',
            'produk_afe' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            ProdukAFE::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Produk AFE berhasil ditambahkan',
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProdukAFE  $produkAFE
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => ProdukAFE::findOrFail($id)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProdukAFE  $produkAFE
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis_afe' => 'required',
            'produk_afe' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            ProdukAFE::findOrFail($id)->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Produk AFE berhasil diubah',
            ], Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProdukAFE  $produkAFE
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProdukAFE::find($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Produk AFE berhasil dihapus',
        ], Response::HTTP_OK);
    }
}
