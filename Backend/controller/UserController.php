<?php

require_once __DIR__ . '/../connection/connection.php';
require_once __DIR__ . "/../models/Film.php";
require_once __DIR__ .  "/../models/Genre.php";
require_once __DIR__ . "/BaseController.php";
require_once __DIR__ . "/../services/userService.php";
require_once __DIR__ . "/../models/User.php";

class UserController extends BaseController {
    
    public function login(){
        global $mysqli;
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            if (!$data || !isset($data["email"], $data["password"])) {
                throw new Exception("Invalid input.");
        }

            $user = User::findByEmail($mysqli, $data["email"]);
            if (!$user) {
                throw new Exception("Invalid credentials.");
                return;
        }

            if (!password_verify($data["password"], $user->getPassword())) {
                throw new Exception("Invalid credentials.");
                return;
        }   
            echo $this->success_response( $user->toArray()); 
        return;

    } catch (Exception $e) {
        echo $this->error_response( $e->getMessage());
    }
 
}

    function getUser() {
        global $mysqli;
        try{
        if (!isset($_GET["id"])) {
            $users = User::all($mysqli);
           

        foreach ($users as $u) {
            $u->loadGenres($mysqli);
            $response["users"][] = $u->toArray();
        }
        echo $this->success_response(UserService::UsersToArray($users));
        return;
    }

        $id = $_GET["id"];
        $user = User::find($mysqli, $id);
        if (!$user) {
                throw new Exception("User not found.");
            }
            $user->loadGenres($mysqli);
            echo $this->success_response($user->toArray());
            return;
        }catch (Exception $e) {
            echo $this->error_response($e->getMessage());
        }

    

    }
    function createUser() {
        global $mysqli;
        try{       
            $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !isset($data["name"], $data["email"], $data["password"])) {
            throw new Exception("Missing required fields.");

        }


    $fields = [
        "name" => $data["name"],
        "email" => $data["email"],
        "password" => password_hash($data["password"], PASSWORD_DEFAULT),
        "mobile" => $data["mobile"] ?? null,
        "date_of_birth" => $data["date_of_birth"] ?? null,
        "profile_image" => $data["profile_image"] ?? null,
    

        ];


        $user = User::create($mysqli, $fields);

    if ($user) {
        echo $this->success_response($user->toArray());
    }
    }catch (Exception $e) {
        echo $this->error_response($e->getMessage());
    }
    }
 
}
 
?>
