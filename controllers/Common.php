<?php

class Common {
    
    function refreshAsteroids($c1 = null, $c2 = null) {

        $prv_ss = $c2 - 1;
        $ast = fetchAll(query('SELECT * FROM asteroids WHERE (c1 = '.$c1.' AND c2 = '.$c2.') OR (c1 = '.$c1.' AND c2 = '.$prv_ss.')'));

        $universe = $_SESSION['universe'];
        foreach($ast as $a) {
            $oou = null;

            $time_now = time();
            $speed = $a['speed'];
            $last_moved = $a['moved'];
            $time_diff = $time_now - $last_moved;
            $planets_move = floor($time_diff / $speed);

            if($planets_move > 0) {
                $c1 = $a['c1'];
                $c2 = $a['c2'];
                $c3 = $a['c3'] + $planets_move;

                if($c3 > $universe['c3_num']) {
                    $c2 += floor($c3 / $universe['c3_num']);
                    $c3 %= $universe['c3_num'];
                    if($c2 > $universe['c2_num']) {
                        $c1 += floor($c2 / $universe['c2_num']);
                        $c2 -= $universe['c2_num'];
                        if($c1 > $universe['c1_num'])
                            $oou = true; //oou - out of universe
                    }
                }
                $a['c1'] = $c1;
                $a['c2'] = $c2;
                $a['c3'] = $c3;
                $a['moved'] += $planets_move * $speed;

                if($oou != true)
                    $ast_refreshed[] = $a;
                else
                    $ast_dell[] = $a['id'];
            }
        }
        if($ast_refreshed)
            foreach($ast_refreshed as $a_ref)
                query('UPDATE asteroids SET
                                c1 = '.$a_ref['c1'].', c2 = '.$a_ref['c2'].', c3 = '.$a_ref['c3'].', moved = '.$a_ref['moved'].'
                                WHERE id = '.$a_ref['id'].'');
        if($ast_dell)
            foreach($ast_dell as $id)
                query('DELETE FROM asteroids WHERE id = '.$id.'');
    }
}