<?php
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
$sql = "INSERT INTO users (name, email, password, mobile, date_of_birth, profile_image) 
VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param(
    "ssssss",
    $name,
    $email,
    $password, 
    $mobile,
    $date_of_birth,
    $profile_image
);
if ($stmt->execute()) {
    $user_id = $stmt->insert_id;

    if (isset($data["genres"]) && is_array($data["genres"])) {
        foreach ($data["genres"] as $genre_id) {
            $insertGenre = $mysqli->prepare("INSERT INTO user_genres (user_id, genre_id) VALUES (?, ?)");
            $insertGenre->bind_param("ii", $user_id, $genre_id);
            $insertGenre->execute();
        }
    }

    echo json_encode(["status" => 201, "message" => "User created", "user_id" => $user_id]);
} else {
    echo json_encode(["status" => 500, "error" => "Failed to create user"]);
}