<?php

namespace App\Http\Controllers;

use App\Models\StatusAFE;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class StatusAFEController extends Controller
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
            'data' => StatusAFE::all()
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
            'afe_status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }else{
            StatusAFE::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Status AFE berhasil ditambahkan',
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatusAFE  $StatusAFE
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => StatusAFE::findOrFail($id)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StatusAFE  $StatusAFE
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'afe_status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }else{
            StatusAFE::findOrFail($id)->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Status AFE berhasil diubah',
            ], Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusAFE  $StatusAFE
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StatusAFE::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Status AFE berhasil dihapus',
        ], Response::HTTP_OK);
    }
}
