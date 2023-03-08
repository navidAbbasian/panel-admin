<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreOtherPageRequest;
use App\Http\Resources\Shop\OtherPageResource;
use App\Models\Shop\OtherPages;
use Exception;
use Illuminate\Http\Request;

class OtherPageController extends Controller
{
    public function index(Request $request)
    {
        $other_pages = OtherPages::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $other_pages = $other_pages->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $other_pages = $other_pages->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $other_pages = $other_pages->orderBy('id', 'ASC');
        }
        $other_pages = $other_pages->paginate(15);
        return response()->json($other_pages, 200);
    }
    public function store(StoreOtherPageRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;

            $other_page= OtherPages::create($input);
            $response = [
                'success'=>true,
                'data'=>new OtherPageResource($other_page),
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
        $other_pages = OtherPages::find($id);
        try {
            if (!$other_pages==null){
                $response = [
                    'success' => true,
                    'data'=>new OtherPageResource($other_pages),
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
    public function update(StoreOtherPageRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $other_pages = OtherPages::where('id', $id)->update($input);
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
