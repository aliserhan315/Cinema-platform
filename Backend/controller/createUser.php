<?php
require_once("../connection/connection.php");
require_once("../models/User.php");

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data["name"], $data["email"], $data["password"])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields"]);
    exit;
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
    echo json_encode([
        "status" => 201,
        "message" => "User created",
        "user" => $user->toArray()
    ]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Failed to create user"]);
}
?>
