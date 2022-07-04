<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Models\Comment;
use App\Models\Status;
use App\Services\CommentValidationService;
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
            $validation = app(CommentValidationService::class)->validate($request);

            //todo вынести в отдельное исключение
            if(Auth::user()->getAuthIdentifier() !== $comment->user_id){
                throw new \Exception('Кажется, это не Ваш комментарий');
            }

            $data = $validation['fields'];

            if ($validation['status'] === 'validated') {

                //меняю статус в зависимости от текущего статуса
                if(isset($data['status_id'])){
                    $comment->status->title === 'active' ?
                        $data['status_id'] = Status::where('title', '=', 'deleted')->first()->id :
                        $data['status_id'] = Status::where('title', '=', 'active')->first()->id;
                }
                $comment = $comment->fill($data);
                $comment->save();
                return response()->json([ 'status' => array_keys($data), 'instance' => $comment]);
            } else return response()->json(['status' =>'invalid', 'instance' => $comment, 'messages' => $data]);

        }catch(\Exception $e){
            return response()->json(['status' =>'error', 'instance' => $comment, 'messages' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
//
    }
}
