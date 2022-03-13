<?php

namespace App\Http\Controllers;

use App\Models\AFEOutlet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AFEOutletController extends Controller
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
            'data' => AFEOutlet::join('outlet_main', 'afe_outlet.outlet_main_id', 'outlet_main.id_outlet_main')
                ->join('afe_main', 'afe_outlet.afe_main_id', 'afe_main.id_afe_main')
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
            'outlet_main_id' => 'required',
            'afe_main_id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $outlet = AFEOutlet::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'AFE Outlet berhasil ditambahkan',
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AFEOutlet  $aFEOutlet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => AFEOutlet::findOrFail($id)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AFEOutlet  $aFEOutlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'outlet_main_id' => 'required',
            'afe_main_id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            AFEOutlet::findOrFail($id)->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'AFE Outlet berhasil diubah',
            ], Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AFEOutlet  $aFEOutlet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AFEOutlet::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'AFE Outlet berhasil dihapus',
        ], Response::HTTP_OK);
    }

    /**
     * get outlet main by afe outlet id
     */
    public function getOutletMainByAFEOutletId($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => AFEOutlet::findOrFail($id)->outletMain
        ], Response::HTTP_OK);
    }
}