<?php
require("../connection/connection.php");
require("../models/User.php");
require("../models/Genre.php");

$response = [];
$response["status"] = 200;

if (!isset($_GET["id"])) {
    $users = User::all($mysqli);
    $response["users"] = [];

    foreach ($users as $u) {
        $u->loadGenres($mysqli); 
        $response["users"][] = $u->toArray(); 
    }

    echo json_encode($response);
    return;
}


$id = $_GET["id"];
$user = User::find($mysqli, $id);

if ($user) {
    $user->loadGenres($mysqli); 
    $response["user"] = $user->toArray();
} else {
    $response["user"] = null;
}

echo json_encode($response);
return;
