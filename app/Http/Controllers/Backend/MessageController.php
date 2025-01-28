<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\RequestReturn;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function showContactMessages (){

        $messages = ContactMessage::get();
    
        return view('backend.message.contact', compact('messages'));


    }

    public function deleteContactMessages ($id){
     
        $message = ContactMessage::find($id);
        $message->delete();

        toastr()->success('Delete Successfuly');
        return redirect()->back();

    }

    public function showReturnReqMessages (){

     $returnRequest = RequestReturn::get();

     return view('backend.message.return-request', compact('returnRequest') );

    }

    public function deleteReturnReqMessages ($id){

        $returnRequest = RequestReturn::find($id);

        $returnRequest->delete();

        
        toastr()->success('Delete Successfuly');
        return redirect()->back();


     

    }
}
