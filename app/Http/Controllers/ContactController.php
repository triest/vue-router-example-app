<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMessageToUserRequest;
use App\Http\Resources\DialogContactsResource;
use App\Models\User;
use App\Service\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request,ContactService $contactService)
    {
        $contact_id=$request->get('contact',null);

        if($contact_id){
            $user=User::select()->where(['id'=>$contact_id])->first();
        }else{
            $user=null;
        }

        $contacts=$contactService->getContacts();

        return response()->json(DialogContactsResource::collection($contacts));

    }

    //
    public function get(ContactService $contactService)
    {
        $contacts=$contactService->getContacts();

        return response()->json($contacts);
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
