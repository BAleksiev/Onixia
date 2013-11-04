<?php

class User {

    public function getPoints($userId) {
        $pt = fetch(query('SELECT points FROM users WHERE id = '.$userId.''));
        return $pt['points'];
    }

    public function setPoints($userId, $points) {
        $pt = fetch(query('SELECT points FROM users WHERE id = '.$userId.''));
        $updated_pts = $pt['points'] + $points;
        query('UPDATE users SET points = '.$updated_pts.' WHERE id = '.$userId.'');
    }

}