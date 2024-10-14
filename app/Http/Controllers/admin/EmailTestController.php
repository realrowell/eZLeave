<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\Admin\EmailTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailTestController extends Controller
{
    public function email_test(Request $request){
        $data = $request->validate([
            'send_to' => 'required|max:50',
            'body_msg' => 'sometimes|max:300',
        ]);
        Mail::to($data['send_to'])->send(new EmailTest($data));
        return redirect()->back()->with('success','Test Email has been successfully send!');
    }
}
