<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Temperature;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    function getTemperature () {
        $data = Temperature::all();
        return response()->json([
            "message" => "Data didapatkan",
            "data" => $data
        ], 200);
    }
    function insertTemperature(Request $request){
        // 1. Menambil data request
        $value = $request->value;
        // 2. Menyimpan data request ke database
        $temperature = Temperature::create([
            'value' => $value
        ]);
        // 3. Mengambalikan response json
        // dengan status code 200/ 201
        return response()->json([
            "message"   => "Data temeperature berhasil ditambahkan",
            "data"      => $temperature
        ], 201);
    }
    function updateTemperature(Request $request, $id)
    {
        $temperature = Temperature::find($id);
        if (!$temperature) {
            return response()->json([
                "message" => "Data temperature tidak ditemukan"
            ], 404);
        }
        $temperature->update($request->all());
        return response()->json([
            "message" => "Data temperature berhasil diupdate",
            "data" => $temperature
        ], 200);
    }
    function deleteTemperature($id)
    {
        $temperature = Temperature::find($id);
        if (!$temperature) {
            return response()->json([
                "message" => "Data temperature tidak ditemukan"
            ], 404);
        }
        $temperature->delete();
        return response()->json([
            "message" => "Data temperature berhasil dihapus",
            "data" => $temperature
        ], 200);
    }
}
