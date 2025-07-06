<?php

class ResponseService {

    public function success_response($data) {
     
        return json_encode([
            "status" => 200,
            "data" => $data,
            "message" => "Request was successful"
        ]);
       
    }
    public function error_response($message){
        
        return json_encode([
            "status" => 500,
            "message" => $message
        ]);
    }
    //  public static function ServiceToArray($data) {
    //     $results = [];
    //     foreach($data as $c){
    //         $results[] = $c->toArray();
    //     }
    //     return $results;
    // }
}



