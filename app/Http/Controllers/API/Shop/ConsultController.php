<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreConsultRequest;
use App\Http\Resources\Shop\ConsultResource;
use App\Models\Shop\Consult;
use Exception;
use Illuminate\Http\Request;

class ConsultController extends Controller
{
    public function index(Request $request)
    {
        $consult =Consult::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $consult = $consult->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $consult = $consult->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $consult = $consult->orderBy('id', 'ASC');
        }
        $consult = $consult->paginate(15);
        return response()->json($consult, 200);
    }
    public function store(StoreConsultRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $consult= Consult::create($input);
            $response = [
                'success'=>true,
                'data'=>new ConsultResource($consult),
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
        $consult = Consult::find($id);
        try {
            if (!$consult==null){
                $response = [
                    'success' => true,
                    'data'=>new ConsultResource($consult),
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
    public function update(StoreConsultRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $consult = Consult::where('id', $id)->update($input);
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
