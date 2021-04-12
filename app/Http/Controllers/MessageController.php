<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Resources\MessageResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:50|min:1',
            'content' => 'required|string|max:100',
            'start_date' => 'required|string|max:10',
            'expiration_date' => 'required|string|max:10',
        ]);
        
        if ($validator->fails())
        {
            return response(['errors' => $validator->errors()->all()], 401);
        }
    
        //$created_by = $request->user()->name;
        $created_by = Auth::guard('api')->user()->name;
        //$user_id = $request->user()->id;
        $user_id = Auth::guard('api')->user()->id;
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:50|min:1',
            'content' => 'required|string|max:100',
            'start_date' => 'required|string|max:10',
            'expiration_date' => 'required|string|max:10',
        ]);
        
        if ($validator->fails())
        {
            return response(['errors' => $validator->errors()->all()], 401);
        }

        $message = Message::find($id);
        
        $data = [
            'created_by' => $request->input('name'),
            'subject' => $request->input('subject'),
            'content' => $request->input('content'),
            'start_date' => $request->input('start_date'),
            'expiration_date' => $request->input('expiration_date')
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
    //public function destroy(Message $message)
    public function destroy($id)
    {
        Message::find($id)->delete();

        return response(['status' => "Deleted Successfully!"], 200);
    }

    public function getMessageById($id) {
        $message = DB::table('messages')->where('id', '=', $id)->get();
        
        return response(['message' => $message]);    
    }
    
    public function userRead(Request $request) {
        $id = $request->input('id');
        $message = Message::find($id);
        $content = $message->viewed_by . $request->input('name') . ',';

        DB::update('UPDATE messages SET viewed_by =  ? WHERE id = ?', [$content, $id]);
        return response(['status' => 'Updated Succesfully'], 200);
    }

    public function getMessagesByUserId ($id) {
        $messages = Message::where('user_id', $id)->get();
        return response(['messages' => $messages], 200);
    }
}
