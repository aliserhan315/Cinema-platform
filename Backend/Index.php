<?php

$base_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($request, $base_dir) === 0) {
    $request = substr($request, strlen($base_dir));
}

if ($request == '') {
    $request = '/';
}

$method = $_SERVER['REQUEST_METHOD'];

$routes = [
    '/login' => [
        'POST' => ['controller' => 'UserController', 'method' => 'login'],
    ],

    '/register' => [
        'POST' => ['controller' => 'UserController', 'method' => 'createUser'],
    ],

    '/users' => [
        'GET'    => ['controller' => 'UserController', 'method' => 'getUser'],
        'PUT'    => ['controller' => 'UserController', 'method' => 'updateUser'],
        'DELETE' => ['controller' => 'UserController', 'method' => 'deleteUser'],
    ],

     '/films' => [
        'GET' => ['controller' => 'FilmController', 'method' => 'getAllFilms'],
        'POST'   => ['controller' => 'FilmController', 'method' => 'createFilm'],
        'DELETE' => ['controller' => 'FilmController', 'method' => 'deleteFilm'],
    ],

    '/seats' => [
        'GET'    => ['controller' => 'SeatController', 'method' => 'getSeatLayout'],
        'POST'   => ['controller' => 'SeatController', 'method' => 'reserveSeats'],
    ],

    '/admin' => [
        'GET'    => ['controller' => 'adminController', 'method' => 'getAllAdmins'],
        'POST'   => ['controller' => 'adminController', 'method' => 'loginAdmin'],
        'DELETE' => ['controller' => 'adminController', 'method' => 'deleteAdmin'],
    ],

];

if (isset($apis[$request])) {
    $controller_name = $apis[$request]['controller']; //if $request == /articles, then the $controller_name will be "ArticleController" 
    $method = $apis[$request]['method'];
    require_once "controller/{$controller_name}.php";

    $controller = new $controller_name();
    if (method_exists($controller, $method)) {
        $controller->$method();
    } else {
        echo "Error: Method {$method} not found in {$controller_name}.";
    }
} else {
    echo "404 Not Found";
}