<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreTaxClassesRequest;
use App\Http\Resources\Shop\TaxClassResource;
use App\Models\TaxClass;
use Exception;
use Illuminate\Http\Request;

class TaxClassesController extends Controller
{
    public function index(Request $request)
    {
        $tax = TaxClass::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $tax = $tax->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $tax = $tax->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $tax = $tax->orderBy('id', 'ASC');
        }
        $tax = $tax->paginate(15);
        return response()->json($tax, 200);
    }
    public function store(StoreTaxClassesRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;

            $tax= TaxClass::create($input);
            $response = [
                'success'=>true,
                'data'=>new TaxClassResource($tax),
                'message'=>'tax store success',
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
        $tax = TaxClass::find($id);
        try {
            if (!$tax==null){
                $response = [
                    'success' => true,
                    'data'=>new TaxClassResource($tax),
                    'message' => 'show tax success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'tax is not exist',
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
    public function update(StoreTaxClassesRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $tax = TaxClass::where('id', $id)->update($input);
            $response = [
                'success' => true,
                'message' => 'update tax success',
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
    public function destroy($id)
    {
            $tax = TaxClass::find($id);
            $tax->delete();
        try {
            $response = [
                'success' => true,
                'data' => new TaxClassResource($tax),
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
