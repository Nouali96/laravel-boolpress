<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lead;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request){

        $data = $request->all();

        // -----------------------------------------------------

        $attributes = [
            "name" => "Nome",
            "email" => "Email",
            "message" => "Messaggio"
        ];

        $validator = Validator::make($data,[
            "name" => "required | min:3",
            "email" => "required | email",
            "message" => "required | min:8 | max:500"
        ], [], $attributes);

        // -----------------------------------------------------

      
        if($validator->fails()){

            return response()->json([
                "success" => false,
                "errors" => $validator->errors()
            ]);

        }else{

            $lead = new Lead();
            $lead->fill($data);
            $lead->save();

            Mail::to("info@boolpress.it")->send(new NewContact($lead));

            return response()->json([
                "success" => true
            ]);

        }

    }

}
