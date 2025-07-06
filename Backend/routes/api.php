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
        'GET'    => ['controller' => 'FilmController', 'method' => 'fetchFilms'],
        'POST'   => ['controller' => 'FilmController', 'method' => 'createFilm'],
        'DELETE' => ['controller' => 'FilmController', 'method' => 'deleteFilm'],
    ],

    '/seats' => [
        'GET'    => ['controller' => 'SeatController', 'method' => 'getSeatLayout'],
        'POST'   => ['controller' => 'SeatController', 'method' => 'reserveSeats'],
    ],

    '/bookings' => [
        'GET'    => ['controller' => 'BookingController', 'method' => 'getBookings'],
        'POST'   => ['controller' => 'BookingController', 'method' => 'createBooking'],
        'DELETE' => ['controller' => 'BookingController', 'method' => 'deleteBooking'],
    ],

    '/showtimes' => [
        'GET'    => ['controller' => 'ShowtimeController', 'method' => 'getShowtimes'],
        'POST'   => ['controller' => 'ShowtimeController', 'method' => 'createShowtime'],
        'DELETE' => ['controller' => 'ShowtimeController', 'method' => 'deleteShowtime'],
    ],
];

if (isset($routes[$request]) && isset($routes[$request][$method])) {
    $controller_name = $routes[$request][$method]['controller'];
    $method_name     = $routes[$request][$method]['method'];

    require_once __DIR__ . "/controllers/{$controller_name}.php";
    $controller = new $controller_name();

    if (method_exists($controller, $method_name)) {
        $controller->$method_name();
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Method {$method_name} not found in {$controller_name}."]);
    }
} else {
    http_response_code(404);
    echo json_encode(["error" => "Route not found: {$request} ({$method})"]);
}
