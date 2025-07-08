<?php

class ResponseService {

    public function success_response($data,$statusCode = 200) {
        http_response_code($statusCode);
        header("Content-Type: application/json");
     
        return json_encode([
            "status" => $statusCode,
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



