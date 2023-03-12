<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreProductColorWholesaleRequest;
use App\Http\Resources\Shop\ProductColorWholesaleResource;
use App\Models\Shop\ProductColorWholesale;
use Exception;
use Illuminate\Http\Request;

class ProductColorWholesaleController extends Controller
{
    public function index(Request $request)
    {
        $Wholesale = ProductColorWholesale::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $Wholesale = $Wholesale->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $Wholesale = $Wholesale->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $Wholesale = $Wholesale->orderBy('id', 'ASC');
        }
        $Wholesale = $Wholesale->paginate(15);
        return response()->json($Wholesale, 200);
    }
    public function store(StoreProductColorWholesaleRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;

            $Wholesale= ProductColorWholesale::create($input);
            $response = [
                'success'=>true,
                'data'=>new ProductColorWholesaleResource($Wholesale),
                'message'=>'$Wholesale store success',
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
        $Wholesale = ProductColorWholesale::find($id);
        try {
            if (!$Wholesale==null){
                $response = [
                    'success' => true,
                    'data'=>new ProductColorWholesaleResource($Wholesale),
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
    public function update(StoreProductColorWholesaleRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $Wholesale = ProductColorWholesale::where('id', $id)->update($input);
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
