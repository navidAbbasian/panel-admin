<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreProductColorRequest;
use App\Http\Resources\Shop\ProductColorResource;
use App\Models\Shop\ProductColor;
use Exception;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    public function index(Request $request)
    {
        $color = ProductColor::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $color = $color->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $color = $color->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $color = $color->orderBy('id', 'ASC');
        }
        $color = $color->paginate(15);
        return response()->json($color, 200);
    }
    public function store(StoreProductColorRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;

            $color= ProductColor::create($input);
            $response = [
                'success'=>true,
                'data'=>new ProductColorResource($color),
                'message'=>'color store success',
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
        $color = ProductColor::find($id);
        try {
            if (!$color==null){
                $response = [
                    'success' => true,
                    'data'=>new ProductColorResource($color),
                    'message' => 'show color success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'color is not exist',
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
    public function update(StoreProductColorRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $color = ProductColor::where('id', $id)->update($input);
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
