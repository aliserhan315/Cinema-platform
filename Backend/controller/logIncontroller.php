<?php
require_once("../connection/connection.php");
require_once("../models/User.php");

$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !isset($data["email"], $data["password"])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing email or password"]);
    exit;
}

$user = User::findByEmail($mysqli, $data["email"]);
if (!$user) {
    http_response_code(401);
    echo json_encode(["error" => "Invalid credentials"]);
    return;
}

if (!password_verify($data["password"], $user->getPassword())) {
    http_response_code(401);
    echo json_encode(["error" => "Invalid credentials"]);
    return;
}

echo json_encode([
    "status" => 200,
    "message" => "Login successful",
    "user" => $user->toArray()
]);
?>
