<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreProductOptionRequest;
use App\Http\Resources\Shop\ProductOptionResource;
use App\Models\Shop\ProductOption;
use Exception;
use Illuminate\Http\Request;

class ProductOptionController extends Controller
{
    public function index(Request $request)
    {
        $option = ProductOption::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $option = $option->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $option = $option->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $option = $option->orderBy('id', 'ASC');
        }
        $option = $option->paginate(15);
        return response()->json($option, 200);
    }
    public function store(StoreProductOptionRequest $request)
    {

        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $option= ProductOption::create($input);
            $response = [
                'success'=>true,
                'data'=>new ProductOptionResource($option),
                'message'=>'option store success',
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
        $option = ProductOption::find($id);
        try {
            if (!$option==null){
                $response = [
                    'success' => true,
                    'data'=>new ProductOptionResource($option),
                    'message' => 'show option success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'option is not exist',
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
    public function update(StoreProductOptionRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $option = ProductOption::where('id', $id)->update($input);
            $response = [
                'success' => true,
                'message' => 'update option success',
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
