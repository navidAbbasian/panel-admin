<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreProductTabRequest;
use App\Http\Resources\Shop\ProductTabResource;
use App\Models\Shop\ProductTab;
use Exception;
use Illuminate\Http\Request;

class ProductTabController extends Controller
{
    public function index(Request $request)
    {
        $product_tab = ProductTab::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $product_tab = $product_tab->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $product_tab = $product_tab->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $product_tab = $product_tab->orderBy('id', 'ASC');
        }
        $product_tab = $product_tab->paginate(15);
        return response()->json($product_tab, 200);
    }
    public function store(StoreProductTabRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;

            $product_tab= ProductTab::create($input);
            $response = [
                'success'=>true,
                'data'=>new ProductTabResource($product_tab),
                'message'=>'product_tab store success',
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
        $product_tab = ProductTab::find($id);
        try {
            if (!$product_tab==null){
                $response = [
                    'success' => true,
                    'data'=>new ProductTabResource($product_tab),
                    'message' => 'show product_tab success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'product_tab is not exist',
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
    public function update(StoreProductTabRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $product_tab = ProductTab::where('id', $id)->update($input);
            $response = [
                'success' => true,
                'message' => 'update product_tab success',
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
