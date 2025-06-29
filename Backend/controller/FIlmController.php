<?php
require_once("../connection/connection.php");
require_once("../models/Film.php");


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $films = Film::all($mysqli);
    $result = [];
    foreach ($films as $film) {
        $result[] = $film->toArray();
    }
    echo json_encode(["status" => 200, "films" => $result]);
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

    if (!isset($data["title"])) {
        http_response_code(400);
        echo json_encode(["error" => "Title required"]);
        exit;
    }

    $title = $data["title"];
    $description = $data["description"] ?? null;
    $release_date = $data["release_date"] ?? null;
    $poster_image = $data["poster_image"] ?? null;

    $stmt = $mysqli->prepare("INSERT INTO films (title, description, release_date, poster_image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $release_date, $poster_image);
    if ($stmt->execute()) {
        echo json_encode(["status" => 201, "message" => "Film created", "id" => $stmt->insert_id]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to create film"]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $id = $_GET["id"] ?? null;
    if (!$id) {
        http_response_code(400);
        echo json_encode(["error" => "Missing film id"]);
        exit;
    }

    $headers = getallheaders();
    if (!isset($headers["Authorization"]) || $headers["Authorization"] !== "Bearer YOUR_ADMIN_TOKEN") {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized"]);
        exit;
    }

    $stmt = $mysqli->prepare("DELETE FROM films WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["status" => 200, "message" => "Film deleted"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to delete film"]);
    }
    exit;
}
?>
