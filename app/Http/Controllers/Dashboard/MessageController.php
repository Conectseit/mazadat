<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $data['messages'] = Message::paginate(200);
        return view('Dashboard.Messages.index', $data);
    }


    public function create()
    {
         return view('Dashboard.Messages.create');
    }

    public function store(MessageRequest $request)
    {
       Message::create($request->all());
        return redirect()->route('messages.index')->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));
    }


    public function edit($id)
    {
        $data['message'] = Message::find($id);
        return view('Dashboard.Messages.edit', $data);
    }

    public function update(MessageRequest $request, $id)
    {
        Message::findOrFail($id)->update($request->all());
        return redirect()->route('messages.index')->with('success',trans('messages.messages.updated_successfully'));
    }
    public function destroy(Request $request)
    {
        $message = Message::find($request->id);
        if (!$message) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, Country is not exists !!']);
        try {
            $message->delete();
            return response()->json(['deleteStatus' => true, 'message' =>  trans('messages.messages.deleted_successfully')]);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }

}
