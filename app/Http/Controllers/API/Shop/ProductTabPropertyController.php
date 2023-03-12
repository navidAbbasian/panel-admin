<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreProductTabPropertyRequest;
use App\Http\Resources\Shop\ProductTabPropertyResource;
use App\Models\Shop\ProductTabProperty;
use Exception;
use Illuminate\Http\Request;

class ProductTabPropertyController extends Controller
{
    public function index(Request $request)
    {
        $tab_props = ProductTabProperty::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $tab_props = $tab_props->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $tab_props = $tab_props->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $tab_props = $tab_props->orderBy('id', 'ASC');
        }
        $tab_props = $tab_props->paginate(15);
        return response()->json($tab_props, 200);
    }
    public function store(StoreProductTabPropertyRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $tab_props= ProductTabProperty::create($input);
            $response = [
                'success'=>true,
                'data'=>new ProductTabPropertyResource($tab_props),
                'message'=>'Tab Property store success',
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
        $tab_props = ProductTabProperty::find($id);
        try {
            if (!$tab_props==null){
                $response = [
                    'success' => true,
                    'data'=>new ProductTabPropertyResource($tab_props),
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
    public function update(StoreProductTabPropertyRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $tab_props = ProductTabProperty::where('id', $id)->update($input);
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
