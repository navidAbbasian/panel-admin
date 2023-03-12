<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreProductTabReviewRequest;
use App\Http\Resources\Shop\ProductTabReviewResource;
use App\Models\Shop\ProductTabReview;
use Exception;
use Illuminate\Http\Request;

class ProductTabReviewController extends Controller
{
    public function index(Request $request)
    {
        $review = ProductTabReview::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $review = $review->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $review = $review->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $review = $review->orderBy('id', 'ASC');
        }
        $review = $review->paginate(15);
        return response()->json($review, 200);
    }
    public function store(StoreProductTabReviewRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;

            $review= ProductTabReview::create($input);
            $response = [
                'success'=>true,
                'data'=>new ProductTabReviewResource($review),
                'message'=>'review store success',
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
        $review = ProductTabReview::find($id);
        try {
            if (!$review==null){
                $response = [
                    'success' => true,
                    'data'=>new ProductTabReviewResource($review),
                    'message' => 'show review success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'review is not exist',
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
    public function update(StoreProductTabReviewRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $review = ProductTabReview::where('id', $id)->update($input);
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
