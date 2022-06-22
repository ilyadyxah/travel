<?php

namespace App\Http\Controllers\Account;

use App\Events\CreateMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\CreateRequest;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    public function store(CreateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $created = Message::create($data);

        if($created){
            event(new CreateMessageEvent(Message::find($created->id)));

            return redirect()->route('account.profile')->with('success', __('messages.messages.created.success'));
        }

        return back()->with('error', __('messages.messages.created.error'))->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
