<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Resources\MessageResource;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::all();
        return response(['messages' => MessageResource::collection($messages), 'status' => 'Retrieved Successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $created_by = $request->user()->name;
        $user_id = $request->user()->id;
        $subject = $request->input('subject');
        $content = $request->input('content');
        $start_date = $request->input('start_date');
        $expiration_date = $request->input('expiration_date');
        $viewed_by = "";
        $read_by_all = false;
        
        $newMessage = Message::create([
            'created_by' => $created_by,
            'subject' => $subject,
            'content' => $content,
            'start_date' => $start_date,
            'expiration_date' => $expiration_date,
            'viewed_by' => $viewed_by,
            'read_by_all' => $read_by_all,
            'user_id' => $user_id
        ]);

        return response(['message' => new MessageResource($newMessage), 'status' => 'Created'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return response(['message' => new MessageResource($message), 'status' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $data = [
            'created_by' => $request->user()->id,
            'subject' => $request->input('subject'),
            'content' => $request->input('content'),
            'start_date' => $request->input('start_date'),
            'expiration_date' => $request->input('expiration_date'),
            'viewed_by' => $request->input('viewed_by'),
            'read_by_all' => $request->has('read_by_all'),
            'user_id' => $request->user()->id
        ];

        $message->update($data);

        return response(['message' => new MessageResource($message), 'status' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
