<?php
require_once("../connection/connection.php");
require_once("../models/admin.php");


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $admins = Admin::all($mysqli);
    $result = array_map(fn($admin) => $admin->toArray(), $admins);
  
    echo json_encode(["status" => 200, "admins" => $result]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

   

    if (!isset($data["email"], $data["password"])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields"]);
    exit;
    }

    $admin = Admin::findByEmail($mysqli, $data["email"]);

 if (!$admin || $data["password"] !== $admin->getPassword()) {
        http_response_code(401);
        echo json_encode(["error" => "Invalid credentials"]);
        exit;
 }
   echo json_encode([
        "status" => 200,
        "message" => "Login successful",
        "admin" => $admin->toArray()
    ]);
  
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $id = $_GET["id"] ?? null;
    if (!$id) {
        http_response_code(400);
        echo json_encode(["error" => "Missing admin id"]);
        exit;
    }
    $admin = Admin::find($mysqli, $id);

    if ($admin) {

        echo json_encode(["status" => 200, "message" => "admin deleted"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to delete admin"]);
    }
    exit;
}
?>
