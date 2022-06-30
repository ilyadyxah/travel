<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Models\Comment;
use App\Services\SaveToDbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->getAuthIdentifier();
        $created = app(SaveToDbService::class)->saveToDb(new (Comment::class), $data);
        if ($created) {
            return back()->with([
                'success' => __('messages.account.comments.created.success'),
            ]);
        }
        return back()->with([
            'error' => __('messages.account.comments.created.error'),
        ])->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        try {
            $validator = Validator::make($request->all(), [
                'message' => ['min:50', 'required', 'string', 'max:500'],
                'target_table_id' => ['nullable', 'integer'],
                'target_id' => ['nullable', 'integer'],
            ]);

            $messages = $validator->messages();


            if (count($messages) === 0) {
                $comment = $comment->fill($request->all());
                   $comment->save();
                return response()->json([ 'status' =>'true', 'instance' => $comment]);
            } else return response()->json(['status' =>'false', 'instance' => $comment, 'messages' => $messages]);

        }catch(\Exception $e){
            return response()->json(['status' =>'error'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
