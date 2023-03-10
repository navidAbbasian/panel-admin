<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreFaqRequest;
use App\Http\Resources\Shop\FaqResource;
use App\Models\Shop\Faq;
use Exception;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faq = Faq::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $faq = $faq->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $faq = $faq->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $faq = $faq->orderBy('id', 'ASC');
        }
        $faq = $faq->paginate(15);
        return response()->json($faq, 200);
    }
    public function store(StoreFaqRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;

            $faq= Faq::create($input);
            $response = [
                'success'=>true,
                'data'=>new FaqResource($faq),
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
        $faq = Faq::find($id);
        try {
            if (!$faq==null){
                $response = [
                    'success' => true,
                    'data'=>new FaqResource($faq),
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
    public function update(StoreFaqRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $faq = Faq::where('id', $id)->update($input);
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
    public function like($id){
        $faq = Faq::find($id);
        Faq::find($faq->id)->increment('like');
    }
    public function dislike($id){
        $faq = Faq::find($id);
        Faq::find($faq->id)->increment('dislike');
    }
}
