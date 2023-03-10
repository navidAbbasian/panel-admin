<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreNewsletterRequest;
use App\Http\Resources\Shop\NewsletterResource;
use App\Models\Shop\Newsletter;
use Exception;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $newsletter = Newsletter::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $newsletter = $newsletter->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $newsletter = $newsletter->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $newsletter = $newsletter->orderBy('id', 'ASC');
        }
        $newsletter = $newsletter->paginate(15);
        return response()->json($newsletter, 200);
    }
    public function store(StoreNewsletterRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;

            $newsletter= Newsletter::create($input);
            $response = [
                'success'=>true,
                'data'=>new NewsletterResource($newsletter),
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
        $newsletter = Newsletter::find($id);
        try {
            if (!$newsletter==null){
                $response = [
                    'success' => true,
                    'data'=>new NewsletterResource($newsletter),
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
    public function update(StoreNewsletterRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $newsletter = Newsletter::where('id', $id)->update($input);
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
