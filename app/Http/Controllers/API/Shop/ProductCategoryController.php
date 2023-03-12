<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreProductCategoryRequest;
use App\Http\Resources\Shop\ProductCategoryResource;
use App\Models\Shop\ProductCategory;
use Exception;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
    $category = ProductCategory::query();
        if ($request->only('search')&&$request->only('col')) {
            $search = explode(' ' , $request->get('search'));
            $col = $request->get('col');
            $category = $category->where(function($q) use ($col , $search){
               foreach ($search as $val){
                   $q->orWhere($col , 'like' , '%' . $val . '%');
               }
            });
        }
        if ($request->only('sort')){
            $category = $category->orderBy($request->get('sort'), $request->get('dir'));
        }else{
            $category = $category->orderBy('id', 'ASC');
        }
        $category = $category->paginate(15);
        return response()->json($category, 200);
    }
    public function store(StoreProductCategoryRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $input['editedBy'] = $request->user()->id;
            $category= ProductCategory::create($input);
            $response = [
              'success'=>true,
              'data'=>new ProductCategoryResource($category),
              'message'=>'category store success',
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
        $category = ProductCategory::find($id);
        try {
            if (!$category==null){
                $response = [
                  'success' => true,
                  'data'=>new ProductCategoryResource($category),
                  'message' => 'show category success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'category is not exist',
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
    public function update(StoreProductCategoryRequest $request, $id)
    {
        try {
            $input = $request->all();
            $category = ProductCategory::where('id', $id)->update($input);
            $response = [
                'success' => true,
                'message' => 'update category success',
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
    public function destroy(ProductCategory $category)
    {
        $category->delete();
        try {
            $response = [
                'success' => true,
                'data' => new ProductCategoryResource($category),
                'message' => 'delete success',
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
