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
            'subject' => 'required|string|max:60|min:1',
            'content' => 'required|string|max:150|min:1',
            'start_date' => 'required|string',
            'expiration_date' => 'required|string',
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

        DB::table('messages')->where('id', $id)->update([
            'created_by' => $message->created_by,
            'subject' => $request->input('subject'),
            'content' => $request->input('content'),
            'start_date' => $request->input('start_date'),
            'expiration_date' => $request->input('expiration_date')
        ]);

        return response(['status' => 'Updated successfully'], 200);
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
        $user_id = $request->input('user_id');
        $message_id = $request->input('message_id');

        $result = DB::table('viewed_by')->insert([
            'user_id' => $user_id,
            'message_id' => $message_id
        ]);

        return response(['message' => 'Updated viewed_by table successfully'], 200);
    }

    public function getUsersWhoReadTheMessage(Request $request)
    {
        $user_id = $request->input('user_id');
        $result = DB::table('users')->join('viewed_by', 'viewed_by.user_id', '=', 'users.id')
            ->select('name')->distinct()->get();
        return response(['viewed_by' => $result], 200);
    }

    public function getMessagesByUserId ($id) {
        $messages = Message::where('user_id', $id)->get();
        return response(['messages' => $messages], 200);
    }
}
