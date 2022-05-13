<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class EnviarController extends Controller
{
    public function enviarSms( Request $request ){

        $data = 
            ["code"=>0,
            "mailingId"=>7009521437,
            "result"=>"Applied",
            "scheduledAt"=>null,
            "hint"=>null,
            "message"=>null];

        return response()->json(
            $data
        , 200);

    }

    public function enviosMasivos( Request $request ){

        $messages = [
            'apiKey.required' => 'El apiKey del reporte es obligatorio',
            'country.required' => 'El country del reporte es obligatorio',
            'message.required' => 'El message del reporte es obligatorio',
            'msisdns.required' => 'El msisdns del reporte es obligatorio',
            'tag.required' => 'El tag del reporte es obligatorio',
        ];

        $validator = Validator::make($request->all(), [
            "apiKey" => "required",
            // "carrier" =>"",
            "country" =>"required",
            // "dial" => "",
            "message" =>"required",
            "msisdns" => "required",
            "tag" =>"required",
            // "mask" =>"",
            // "msgClass" => "",
            // "schedule" =>"",
            // "dlr" => "",
            // "optionals" =>"",

        ], $messages);
        
        if ($validator->fails()) {
            
            return response()->json(
                [
                    'success' => false,
                    'message' => $validator->errors()
                ],
                400
            );
        }

        if( !str_contains($request->message,'[ERROR]')){
            $data = 
                [
                    "code"=>0,
                    "mailingId"=> random_int(100, 999999999999),
                    "result"=>"Applied"
                ];
    
            return response()->json(
                $data
            , 200);

        }else{
            $data = 
            [
                "code"=>-17,
                "hint"=> "The country abreviation or the carrier does not exist",
                "message"=>"Validation error"
            ];

        return response()->json(
            $data
        , 400);
        }

// 183623
    }

    public function mensajeDlr( Request $request ){

        if($request->error){

            $data = 
            [
            "messageId"=>random_int(100000000, 999999999999),
            "statusDelivery"=> "REJECTED",
            "sendDate"=>1588694204000,
            "doneDate"=>1588694204000,
            ];


            
        }else {

            $data = 
            [
            "messageId"=>random_int(100000000, 999999999999),
            "statusDelivery"=> "DELIVERED",
            "sendDate"=>1588694204000,
            "doneDate"=>1588694204000,
            ];
        }


        $result = Http::withHeaders([
            'Authorization' => 'Basic YWRtaW4xQGdtYWlsLmNvbToxMjM0NTY=',
            'Content-Type' => 'application/json'
        ])->post("http://localhost:8000/api/received_sms",$data );

        // $result = Http::withHeaders([
        //     'Authorization' => 'Bearer ',
        //     'Content-Type' => 'application/json'
        // ])->post("https://api.powerbi.rateToken", [
        //     "messageId"=>random_int(100000000, 999999999999),
        //     "statusDelivery"=> "DELIVERED",
        //     "sendDate"=>1588694204000,
        //     "doneDate"=>1588694204000,
        // ]);
        $result2 = $result->json();


        return response()->json(
            [
            "msg"=>"se mando post",
            "data" => $result2
            ]
        , 200);

    }

    public function mensajeDlrError( Request $request ){

        $data = 
            [
            "messageId"=>random_int(100000000, 999999999999),
            "statusDelivery"=> "REJECTED",
            "sendDate"=>1588694204000,
            "doneDate"=>1588694204000,
        ];

        return response()->json(
            $data
        , 200);

    }

    public function mensajeDlrUnKnow( Request $request ){

        $data = 
            [
            "messageId"=>random_int(100000000, 999999999999),
            "statusDelivery"=> "UNKNOWN",
            "sendDate"=>1588694204000,
            "doneDate"=>1588694204000,
        ];

        return response()->json(
            $data
        , 200);

    }
}
