<?php

class adminService {
    public static function AdminToArray($admins_db) {
        $results = [];
        foreach($admins_db as $c){
            $results[] = $c->toArray();
        }
        return $results;
    }
}
