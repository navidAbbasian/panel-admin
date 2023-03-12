<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreProductRequest;
use App\Http\Resources\Shop\ProductResource;
use App\Models\Shop\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::query();
        if ($request->only('search') && $request->only('col')) {
            $search  = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $product = $product->where(function ($q) use ($col, $search){
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' .$val . '%');
                }
            });
        }
            if ($request->only('sort')) {
                $product = $product->orderBy($request->get('sort'), $request->get('dir'));
            } else {
                $product= $product->orderBy('id', 'ASC');
            }
            $product = $product->paginate('15');
            return response()->json($product, 200);
    }
    public function store(StoreProductRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $product= Product::create($input);
            $response = [
                'success'=>true,
                'data'=>new ProductResource($product),
                'message'=>'product store success',
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
        $product = Product::find($id);
        try {
            if (!$product==null){
                $response = [
                    'success' => true,
                    'data'=>new ProductResource($product),
                    'message' => 'show product success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'product is not exist',
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
    public function update(StoreProductRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $product = Product::where('id', $id)->update($input);
            $response = [
                'success' => true,
                'message' => 'update product success',
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
