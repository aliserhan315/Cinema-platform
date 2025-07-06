<?php

class UserService {
    public static function UsersToArray($users_db) {
        $results = [];
        foreach($users_db as $c){
            $results[] = $c->toArray();
        }
        return $results;
    }
}
