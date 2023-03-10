<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreProvinceRequest;
use App\Http\Resources\Shop\ProvinceResource;
use App\Models\Shop\Province;
use Exception;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index(Request $request)
    {
        $province = Province::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $province = $province->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $province = $province->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $province = $province->orderBy('id', 'ASC');
        }
        $province = $province->paginate(15);
        return response()->json($province, 200);
    }
    public function store(StoreProvinceRequest $request)
    {
        $input = $request->all();
        try {
            $province= Province::create($input);
            $response = [
                'success'=>true,
                'data'=>new ProvinceResource($province),
                'message'=>'tag store success',
            ];
            return response()->json($response, 200);
        }catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }
    }
    public function show($id)
    {
        $province = Province::find($id);
        try {
            if (!$province==null){
                $response = [
                    'success' => true,
                    'data'=>new ProvinceResource($province),
                    'message' => 'show tag success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'tag is not exist',
                ];
                return response()->json($response, 401);
            }
        }catch (Exception $e){
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }
    }
    public function update(StoreProvinceRequest $request, $id)
    {
        try {
            $input = $request->all();
            $province = Province::where('id', $id)->update($input);
            $response = [
                'success' => true,
                'message' => 'update tag success',
            ];
            return response()->json($response, 200);
        }catch (Exception $e){
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }
    }
}
