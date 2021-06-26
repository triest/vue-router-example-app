<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMessageToUserRequest;
use App\Models\User;
use App\Service\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function get(ContactService $contactService)
    {
        return response()->json($contactService->getContacts());
    }

    public function send(SendMessageToUserRequest $request)
    {

        $user = User::select(['id'])->where(['unique_id'=>$request->contact_id])->first();
        if ($user == null) {
            return null;
        }
        $message = $user->sendMessage($request->text);
        return response()->json($message);
    }
}
