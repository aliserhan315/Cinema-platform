<?php

class ResponseService {

    public function success_response($data) {
        header("Content-Type: application/json");
     
        return json_encode([
            "status" => 200,
            "data" => $data,
           
        ]);
       
    }
    public function error_response($message){
        header("Content-Type: application/json");
        
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



