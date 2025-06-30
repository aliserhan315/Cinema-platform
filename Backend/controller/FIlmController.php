<?php
require_once("../connection/connection.php");
require_once("../models/Film.php");


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $films = Film::all($mysqli);
    $result = array_map(fn($film)=> $film->toArray(), $films);
    echo json_encode(["status" => 200, "films" => $result]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["title"])) {
        http_response_code(400);
        echo json_encode(["error" => "Title required"]);
        exit;
    }

       $fields = [
        "title" => $data["title"],
        "description" => $data["description"] ?? null,
        "release_date" => $data["release_date"] ?? null,
        "poster_image" => $data["poster_image"] ?? null,
        "rating" => $data["rating"] ?? null,
        "duration" => $data["duration"] ?? null,
        "trailer_url" => $data["trailer_url"] ?? null,
        "age_restriction" => $data["age_restriction"] ?? null,
    ];

    $film = Film::create($mysqli, $fields);
    if ($film) {
        echo json_encode(["status" => 201, "message" => "Film created", "id" => $stmt->insert_id]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to create film"]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

      $name = $_GET["name"] ?? null;

    if (!$name) {
        http_response_code(400);
        echo json_encode(["error" => "Missing film name"]);
        exit;
    }

    $films = Film::find($mysqli, $id);
    if (!$films) {
        http_response_code(404);
        echo json_encode(["error" => "Film not found"]);
        exit;
    }
    $film = Film::findByName($mysqli, $name);

    if ($films->delete($mysqli)) {
        echo json_encode(["status" => 200, "message" => "Film deleted"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to delete film"]);
    }
    exit;
}
?>
