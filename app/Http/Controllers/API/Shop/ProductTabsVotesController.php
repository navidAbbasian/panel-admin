<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreProductTabsVotesRequest;
use App\Http\Resources\Shop\ProductTabsVotesResource;
use App\Models\Shop\ProductTabsVotes;
use Exception;
use Illuminate\Http\Request;

class ProductTabsVotesController extends Controller
{
    public function index(Request $request)
    {
        $vote = ProductTabsVotes::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $vote = $vote->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $vote = $vote->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $vote = $vote->orderBy('id', 'ASC');
        }
        $vote = $vote->paginate(15);
        return response()->json($vote, 200);
    }
    public function store(StoreProductTabsVotesRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;

            $vote= ProductTabsVotes::create($input);
            $response = [
                'success'=>true,
                'data'=>new ProductTabsVotesResource($vote),
                'message'=>'vote store success',
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
        $vote = ProductTabsVotes::find($id);
        try {
            if (!$vote==null){
                $response = [
                    'success' => true,
                    'data'=>new ProductTabsVotesResource($vote),
                    'message' => 'show vote success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'vote is not exist',
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
    public function update(StoreProductTabsVotesRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $vote = ProductTabsVotes::where('id', $id)->update($input);
            $response = [
                'success' => true,
                'message' => 'update vote success',
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
