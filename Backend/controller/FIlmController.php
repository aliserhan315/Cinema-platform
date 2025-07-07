<?php
require_once __DIR__ . '/../connection/connection.php';
require_once __DIR__ . "/../models/Film.php";
require_once __DIR__ .  "/../services/ResponseService.php";
require_once __DIR__ . "/BaseController.php";
require_once __DIR__ . "/../services/FilmService.php";

class FIlmController extends BaseController {
    function getAllFilms(){
        global $mysqli;
        try { 
            if (!isset($_GET["id"])) {
            
            $films = Film::all($mysqli);
               echo $this->success_response(FilmService::FilmToArray($films));
        }
            else {
                $id = $_GET["id"];
                $film = Film::find($mysqli, $id);
                if ($film) {
                    echo $this->success_response($film->toArray());
                } else {
                    echo $this->error_response("Film not found");
                }
            }

        }catch (Exception $e) {
            echo $this->error_response($e->getMessage());
        }


    }
    public function createFilm() {
        global $mysqli;
        try {
            $data = json_decode(file_get_contents("php://input"), true);

            if (!isset($data["title"])) {
                throw new Exception("Title required");
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

            $filmId = Film::create($mysqli, $fields);

            if ($filmId) {
                echo $this->success_response($filmId->toArray());
            } else {
                throw new Exception("Failed to create film");
            }
        } catch (Exception $e) {
            echo $this->error_response($e->getMessage());
        }
    }

    public function deleteFilm() {
        global $mysqli;
        try {
            $name = $_GET["name"] ?? null;

            if (!$name) {
                throw new Exception("Missing film name");
            }

            $film = Film::findByName($mysqli, $name);
            if (!$film) {
                throw new Exception("Film not found");
            }

            $deleted = Film::delete($mysqli, $film->getId());

            if ($deleted) {
                echo $this->success_response("Film deleted");
            } else {
                throw new Exception("Failed to delete film");
            }
        } catch (Exception $e) {
            echo $this->error_response($e->getMessage());
        }
    }

}

?>
