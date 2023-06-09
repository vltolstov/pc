<?php

namespace App\Http\Controllers;

use App\Mail\RequestShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ClientFormSendController extends Controller
{

    public function sending(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'prohibited',
            'title' => 'present',
            'imfa' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'comment' => 'present',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        Mail::to('sumkiplus@sumkiplus.ru')
            ->send(new RequestShipped(
                $request->imfa,
                $request->email,
                $request->phone,
                $request->comment,
                $request->title
            ));

        return response() -> json(['success' => 'ok']);
    }
}
