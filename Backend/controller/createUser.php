<?php

header("Content-Type: application/json"); 

require_once("../connection/connection.php");
require_once("../models/User.php");
$data = json_decode(file_get_contents("php://input"), true);
$response = [];

if (!$data || !isset($data["name"], $data["email"], $data["password"])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields"]);
    return;
}
$fields = [
    "name" => $data["name"],
    "email" => $data["email"],
    "password" => password_hash($data["password"], PASSWORD_DEFAULT),
    "mobile" => $data["mobile"] ?? null,
    "date_of_birth" => $data["date_of_birth"] ?? null,
    "profile_image" => $data["profile_image"] ?? null,
];
$user = user::create($mysqli, $fields);
if ($user) {
    $user_id = $user->getId();

    if (isset($data["genres"]) && is_array($data["genres"])) {
        foreach ($data["genres"] as $genre_id) {
            $insertGenre = $mysqli->prepare("INSERT INTO user_genres (user_id, genre_id) VALUES (?, ?)");
            $insertGenre->bind_param("ii", $user_id, $genre_id);
            $insertGenre->execute();
        }
    }

    echo json_encode([
        "status" => 201,
        "message" => "User created",
        "user" => $user->toArray()
    ]);
} else {
    echo json_encode(["status" => 500, "error" => "Failed to create user"]);
}