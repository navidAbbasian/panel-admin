<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreCarouselRequest;
use App\Http\Resources\Shop\CarouselResource;
use App\Models\Shop\Carousel;
use Exception;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index(Request $request)
    {
        $caousel = Carousel::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $caousel = $caousel->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $caousel = $caousel->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $caousel = $caousel->orderBy('id', 'ASC');
        }
        $caousel = $caousel->paginate(15);
        return response()->json($caousel, 200);
    }
    public function store(StoreCarouselRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;

            $carousel= Carousel::create($input);
            $response = [
                'success'=>true,
                'data'=>new CarouselResource($carousel),
                'message'=>'carousel store success',
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
        $carousel = Carousel::find($id);
        try {
            if (!$carousel==null){
                $response = [
                    'success' => true,
                    'data'=>new CarouselResource($carousel),
                    'message' => 'show carousel success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'carousel is not exist',
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
    public function update(StoreCarouselRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $carousel = Carousel::where('id', $id)->update($input);
            $response = [
                'success' => true,
                'message' => 'update carousel success',
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
