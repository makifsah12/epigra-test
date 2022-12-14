<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\tbl01;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpacexApi extends Controller
{
    public function getAllData(){
        $data = tbl01::query()->get();
        return response()->json($data,200);
    }

    public function getDataByStatus(Request $request){
        $messages = array(
            'status.required' => 'Please enter the status'
        );

        $rules = array(
            'status' => 'required'
        );

        $validator = \Illuminate\Support\Facades\Validator::make($request->toArray(), $rules, $messages);

        if ($validator->passes()) {
            try {
                $byStatus = tbl01::query()->where('status', $request->status)->get();

                if ($byStatus->count() > 0) {
                    return response()->json($byStatus, 200);
                } else {
                    return response()->json(collect("Cant Find Capsule With Status That You Entered"));
                }
            } catch (\Exception $e) {
                return response()->json([
                    'result' => false,
                    'message' => "İşlem başarısız.Hata mesajı: " . $e->getMessage(),
                ]);
            }
        }
        return response()->json([
            'result' => false,
            'errors' => $validator->errors(),
            "message" => "İşlem başarısız, " . $validator->errors()->first(),
        ]);
    }

    public function getDataByCapsule(Request $request){
        $messages = array(
            'capsule.required' => 'Please enter the capsule name'
        );

        $rules = array(
            'capsule' => 'required'
        );

        $validator = \Illuminate\Support\Facades\Validator::make($request->toArray(), $rules, $messages);

        if ($validator->passes()) {
            try {
                $byStatus = tbl01::query()->where('capsule_serial',$request->capsule)->get();

                if ($byStatus->count() > 0) {
                    return response()->json($byStatus, 200);
                } else {
                    return response()->json(collect("Cant Find Capsule With Status That You Entered"));
                }
            } catch (\Exception $e) {
                return response()->json([
                    'result' => false,
                    'message' => "İşlem başarısız.Hata mesajı: " . $e->getMessage(),
                ]);
            }
        }return response()->json([
            'result' => false,
            'errors' => $validator->errors(),
            "message" => "İşlem başarısız, " . $validator->errors()->first(),
        ]);
    }
}
