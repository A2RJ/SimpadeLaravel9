<?php

namespace App\Http\Controllers;

use App\Models\JenisPajak;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class JenisPajakController extends Controller
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
            'data' => JenisPajak::all()
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
            'jenis_pajak' => 'required|string|max:255',
            'tarif' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            JenisPajak::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Jenis Pajak berhasil ditambahkan',
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisPajak  $jenisPajak
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => JenisPajak::findOrFail($id)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisPajak  $jenisPajak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis_pajak' => 'required|string|max:255',
            'tarif' => 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            JenisPajak::findOrFail($id)->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Jenis Pajak berhasil diubah'
            ], Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisPajak  $jenisPajak
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JenisPajak::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Jenis Pajak berhasil dihapus'
        ], Response::HTTP_OK);
    }
}
