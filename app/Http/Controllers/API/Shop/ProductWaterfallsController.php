<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreProductWaterfallsRequest;
use App\Http\Resources\Shop\ProductWaterfallsResource;
use App\Models\Shop\ProductWaterfalls;
use Exception;
use Illuminate\Http\Request;

class ProductWaterfallsController extends Controller
{
    public function index(Request $request)
    {
        $waterfall = ProductWaterfalls::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $waterfall = $waterfall->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $waterfall = $waterfall->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $waterfall = $waterfall->orderBy('id', 'ASC');
        }
        $waterfall = $waterfall->paginate(15);
        return response()->json($waterfall, 200);
    }
    public function store(StoreProductWaterfallsRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $waterfall= ProductWaterfalls::create($input);
            $response = [
                'success'=>true,
                'data'=>new ProductWaterfallsResource($waterfall),
                'message'=>'waterfall store success',
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
        $waterfall = ProductWaterfalls::find($id);
        try {
            if (!$waterfall==null){
                $response = [
                    'success' => true,
                    'data'=>new ProductWaterfallsResource($waterfall),
                    'message' => 'show waterfall success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'waterfall is not exist',
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
    public function update(StoreProductWaterfallsRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $waterfall = ProductWaterfalls::where('id', $id)->update($input);
            $response = [
                'success' => true,
                'message' => 'update waterfall success',
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
