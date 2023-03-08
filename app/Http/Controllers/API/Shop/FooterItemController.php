<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreFooterItemRequest;
use App\Http\Resources\Shop\FooterItemResource;
use App\Models\Shop\FooterItem;
use Exception;
use Illuminate\Http\Request;

class FooterItemController extends Controller
{
    public function index(Request $request)
    {
        $footer_items = FooterItem::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $footer_items = $footer_items->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $footer_items = $footer_items->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $footer_items = $footer_items->orderBy('id', 'ASC');
        }
        $footer_items = $footer_items->paginate(15);
        return response()->json($footer_items, 200);
    }
    public function store(StoreFooterItemRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;

            $footer_items= FooterItem::create($input);
            $response = [
                'success'=>true,
                'data'=>new FooterItemResource($footer_items),
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
        $footer_itens = FooterItem::find($id);
        try {
            if (!$footer_itens==null){
                $response = [
                    'success' => true,
                    'data'=>new FooterItemResource($footer_itens),
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
    public function update(StoreFooterItemRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $footer_items = FooterItem::where('id', $id)->update($input);
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
