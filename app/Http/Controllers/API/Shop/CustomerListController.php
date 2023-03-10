<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreCustomerListRequest;
use App\Http\Resources\Shop\CustomerListResource;
use App\Models\CustomersList;
use Exception;
use Illuminate\Http\Request;

class CustomerListController extends Controller
{
    public function index(Request $request)
    {
        $customer_list = CustomersList::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $customer_list = $customer_list->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $customer_list = $customer_list->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $customer_list = $customer_list->orderBy('id', 'ASC');
        }
        $customer_list = $customer_list->paginate(15);
        return response()->json($customer_list, 200);
    }
    public function store(StoreCustomerListRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $customer_list= CustomersList::create($input);
            $response = [
                'success'=>true,
                'data'=>new CustomerListResource($customer_list),
                'message'=>'tag store success',
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
        $customer_list = CustomersList::find($id);
        try {
            if (!$customer_list==null){
                $response = [
                    'success' => true,
                    'data'=>new CustomerListResource($customer_list),
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
    public function update(StoreCustomerListRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $customer_list = CustomersList::where('id', $id)->update($input);
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
