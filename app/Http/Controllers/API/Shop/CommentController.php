<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreCommentRequest;
use App\Http\Resources\Shop\CommentResource;
use App\Models\Shop\Comment;
use Exception;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comment = Comment::query();
        if ($request->only('search') && $request->only('col')) {
            $search = explode(' ', $request->get('search'));
            $col = $request->get('col');
            $comment = $comment->where(function ($q) use ($col, $search) {
                foreach ($search as $val) {
                    $q->orWhere($col, 'like', '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $comment = $comment->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $comment = $comment->orderBy('id', 'ASC');
        }
        $comment = $comment->paginate(15);
        return response()->json($comment, 200);
    }
    public function store(StoreCommentRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;

            $comments= Comment::create($input);
            $response = [
                'success'=>true,
                'data'=>new CommentResource($comments),
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
        $comments = Comment::find($id);
        try {
            if (!$comments==null){
                $response = [
                    'success' => true,
                    'data'=>new CommentResource($comments),
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
    public function update(StoreCommentRequest $request, $id)
    {
        try {
            $input = $request->all();
            $input['editedBy'] = $request->user()->id;
            $comment = Comment::where('id', $id)->update($input);
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
        $comment = Comment::find($id);
        Comment::find($comment->id)->increment('like');
    }

    public function dislike($id){
        $comment = Comment::find($id);
        Comment::find($comment->id)->increment('dislike');
    }
}
