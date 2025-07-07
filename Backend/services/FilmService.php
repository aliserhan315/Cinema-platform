<?php
class FilmService {
    public static function FilmToArray($film_db) {
        $results = [];
        foreach($film_db as $c){
            $results[] = $c->toArray();
        }
        return $results;
    }
}