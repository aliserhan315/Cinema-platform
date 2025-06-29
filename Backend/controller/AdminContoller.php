<?php
require_once("../connection/connection.php");
require_once("../models/admin.php");


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $admins = Admin::all($mysqli);
    $result = [];
    foreach ($admins as $admin) {
        $result[] = $admin->toArray();
    }
    echo json_encode(["status" => 200, "admins" => $result]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

      $headers = getallheaders();
    if (!isset($headers["Authorization"]) || $headers["Authorization"] !== "Bearer YOUR_ADMIN_TOKEN") {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized"]);
        exit;
    }

    if (!isset($data["name"], $data["email"], $data["password"])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields"]);
    exit;
    }


    $name = $data["name"];
    $email = $data["email"] ;
    $password= $data["password"] ;
 

    $stmt = $mysqli->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);
 
    if ($stmt->execute()) {
        echo json_encode(["status" => 201, "message" => "admin created", "id" => $stmt->insert_id]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to create admin"]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $id = $_GET["id"] ?? null;
    if (!$id) {
        http_response_code(400);
        echo json_encode(["error" => "Missing admin id"]);
        exit;
    }

    $headers = getallheaders();
    if (!isset($headers["Authorization"]) || $headers["Authorization"] !== "Bearer YOUR_ADMIN_TOKEN") {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized"]);
        exit;
    }

    $stmt = $mysqli->prepare("DELETE FROM admins WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["status" => 200, "message" => "admin deleted"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to delete admin"]);
    }
    exit;
}
?>
