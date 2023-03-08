<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreModeTransportationRequest;
use App\Http\Resources\Shop\ModeTransportationResource;
use App\Models\Shop\ModeTransportation;
use Exception;
use Illuminate\Http\Request;

class ModeTransportationController extends Controller
{
    public function index(Request $request)
    {
        $mode_transportation = ModeTransportation::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $mode_transportation	 = $mode_transportation	->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $mode_transportation = $mode_transportation	->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $mode_transportation = $mode_transportation	->orderBy('id', 'ASC');
        }
        $mode_transportation = $mode_transportation	->paginate(15);
        return response()->json($mode_transportation , 200);
    }
    public function store(StoreModeTransportationRequest $request)
    {
        $input = $request->all();
        try {

            $mode_transportation=ModeTransportation::create($input);
            $response = [
                'success'=>true,
                'data'=>new ModeTransportationResource($mode_transportation),
                'message'=>'transportation store success',
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
        $mode_transportation = ModeTransportation::find($id);
        try {
            if (!$mode_transportation==null){
                $response = [
                    'success' => true,
                    'data'=>new ModeTransportationResource($mode_transportation),
                    'message' => 'show transportation success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'transportation is not exist',
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
    public function update(StoreModeTransportationRequest $request, $id)
    {
        try {
            $input = $request->all();
            $mode_transportation = ModeTransportation::where('id', $id)->update($input);
            $response = [
                'success' => true,
                'message' => 'update transportation success',
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
