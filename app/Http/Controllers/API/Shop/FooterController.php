<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreFooterRequest;
use App\Http\Resources\Shop\FooterResource;
use App\Models\Shop\Footer;
use Exception;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index(Request $request)
    {
        $footer = Footer::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $footer = $footer->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $footer = $footer->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $footer = $footer->orderBy('id', 'ASC');
        }
        $footer = $footer->paginate(15);
        return response()->json($footer, 200);
    }
    public function store(StoreFooterRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;

            $footer= Footer::create($input);
            $response = [
                'success'=>true,
                'data'=>new FooterResource($footer),
                'message'=>'footer store success',
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
        $footer = Footer::find($id);
        try {
            if (!$footer==null){
                $response = [
                    'success' => true,
                    'data'=>new FooterResource($footer),
                    'message' => 'show footer success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'footer is not exist',
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
    public function update(StoreFooterRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $footer = Footer::where('id', $id)->update($input);
            $response = [
                'success' => true,
                'message' => 'update footer success',
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
