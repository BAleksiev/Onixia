<?php

class Flights {

    public function newFlight($data) {

        $app = App::getInstance();

        if($data['act'] == 'fastspy' && isset($data['c1']) && isset($data['c2']) && isset($data['c3'])) {
            $data['c1'] = $c1;
            $data['c2'] = $c2;
            $data['c3'] = $c3;
            $data['flightType'] = 'spy';
            $data['speed'] = 100;
            $data[7] = 1;
        }

        $flightShips = serialize(orderShips($data['ships']));
        $planetShips = $_SESSION['planet']['ships'];
        $ships = orderShips($data['ships']);

        foreach($ships as $id => $num) {
            if($num > $planetShips[$id]) {
                $notEnoughShips = true;
                break;
            }
            $cargo += $_SESSION['ships'][$id]['cargo'] * $num;
            $consumation += $_SESSION['ships'][$id]['consumation'] * $num;
            if($_SESSION['ships'][$id]['speed'] < $slowest) {
                $slowest = $_SESSION['ships'][$id]['speed'];
            }
        }
        if($notEnoughShips == true) {
            $_SESSION['errorMsg'][] = "izbrali ste pove4e korabi otkolkoto razpolagate";
        } else {
            $newPlanetShips = $planetShips;
            foreach($ships as $id => $num) {
                $newPlanetShips[$id] -= $num;
            }
            $newPlanetShips = orderShips($newPlanetShips);

            $mission = $data['flightType'];
            $c1 = $data['c1'];
            $c2 = $data['c2'];
            $c3 = $data['c3'];
            $tc1 = $_SESSION['planet']['c1'];
            $tc2 = $_SESSION['planet']['c2'];
            $tc3 = $_SESSION['planet']['c3'];

            // TO FIX (3;1000;10) galaxy coordinates - move in config
            if($c1 <= 0 || $c2 <= 0 || $c3 <= 0 || $c1 > 3 || $c2 > 1000 || $c3 > 10) {
                $_SESSION['errorMsg'][] = "ne sa6testvuvat takiva koordinati";
            } else {
                $speedPercent = $data['speed'];
                $metal = $data['metal'];
                $crystal = $data['crystal'];
                $gas = $data['gas'];

                $toPlanet = fetch(query('SELECT id FROM planets WHERE c1='.$c1.' AND c2='.$c2.' AND c3='.$c3.''));

                if($toPlanet || $mission == 'astro' || $mission == 'colonise' || $mission == 'recycle') {

                    if($mission == "attack" && $toPlanet) {
                        if(($metal + $crystal + $gas) <= $cargo) {
                            $distance = flightDistance($c1, $c2, $c3, $tc1, $tc2, $tc3);
                            $flightTime = $slowest * $distance;
                            $consumation *= $distance;
//                    if($cGas>=$consumation || $cGas-$gas>=$consumation) {
                            $te = time() + $flightTime;
                            $rand = rand(1, 1000);
                            $id = $rand.'-'.time().'-'.$_SESSION['user']['id'].'-'.$toPlanet['id'];
                            query('INSERT INTO flights (id,owner,status,tc1,tc2,tc3,c1,c2,c3,time_start,time_end,type,ships,metal,crystal,gas) 
                            VALUES("'.$id.'",'.$_SESSION['user']['id'].',"go",'.$tc1.','.$tc2.','.$tc3.','.$c1.','.$c2.','.$c3.',
                                '.time().','.$te.',"'.$mission.'","'.$flightShips.'",'.$metal.','.$crystal.','.$gas.')');
                            $metal = $_SESSION['planet']['metal'] - $metal;
                            $crystal = $_SESSION['planet']['crystal'] - $crystal;
                            $gas = $_SESSION['planet']['gas'] - $consumation - $gas;
                            Resources::SetRes('metal', $metal);
                            Resources::SetRes('crystal', $crystal);
                            Resources::SetRes('gas', $gas);
                            query('UPDATE planets SET ships = "'.serialize($newPlanetShips).'" WHERE id='.$_SESSION['planet']['id'].'');
                            $_SESSION['planet']['ships'] = $newPlanetShips;
//                    } else {
//                        $_SESSION['errorMsg'][] = "nqma dostata4no gaz za poleta";
//                    }
                        } else {
                            $_SESSION['errorMsg'][] = translate('You don`t have enough cargo space.');
                        }
                    } else if($mission == "spy" && $toPlanet) {
                        $distance = flightDistance($c1, $c2, $c3, $tc1, $tc2, $tc3);
                        $flightTime = $slowest * $distance;
                        $consumation *= $distance;

                        for($i = 0; $i <= $data[7]; $i++) {
                            $te = time() + $flightTime;
                            $rand = rand(1, 1000);
                            $id = $rand.'-'.time().'-'.$_SESSION['user']['id'].'-'.$toPlanet['id'];
                            query('INSERT INTO flights (id,owner,status,tc1,tc2,tc3,c1,c2,c3,time_start,time_end,type,ships,metal,crystal,gas) 
                                VALUES("'.$id.'",'.$_SESSION['user']['id'].',"go",'.$tc1.','.$tc2.','.$tc3.','.$c1.','.$c2.','.$c3.','.time().','.$te.',"'.$mission.'","'.$flightShips.'",0,0,0)');
                            $gas = $_SESSION['planet']['gas'] - $consumation - $gas;
                            Resources::SetRes('gas', $gas);
                        }
                        query('UPDATE planets SET ships = "'.serialize($newPlanetShips).'" WHERE id = '.$_SESSION['planet']['id'].'');
                        $_SESSION['planet']['ships'] = $newPlanetShips;
                    } else if($mission == "transport") {

                        $toPlanet = fetch(query('SELECT p.id, u.race FROM planets as p INNER JOIN users as u 
                            WHERE p.c1='.$c1.' AND p.c2='.$c2.' AND p.c3='.$c3.' AND u.id = p.owner'));
                        $distance = flightDistance($c1, $c2, $c3, $tc1, $tc2, $tc3);
                        $flightTime = $slowest * $distance;
                        $consumation *= $distance;

                        $te = time() + $flightTime;
                        $rand = rand(1, 1000);
                        $id = $rand.'-'.time().'-'.$_SESSION['user']['id'].'-'.$toPlanet['id'];
                        query('INSERT INTO flights (id,owner,status,tc1,tc2,tc3,c1,c2,c3,time_start,time_end,type,ships,metal,crystal,gas) 
                        VALUES("'.$id.'",'.$_SESSION['user']['id'].',"go",'.$tc1.','.$tc2.','.$tc3.','.$c1.','.$c2.','.$c3.','.time().','.$te.',"'.$mission.'","'.$flightShips.'",'.$metal.','.$crystal.','.$gas.')');

                        $metalRq = $_SESSION['planet']['metal'] - $metal;
                        $crystalRq = $_SESSION['planet']['crystal'] - $crystal;
                        $gasRq = $_SESSION['planet']['gas'] - $consumation - $gas;

                        Resources::SetRes('metal', $metalRq);
                        Resources::SetRes('crystal', $crystalRq);
                        Resources::SetRes('gas', $gasRq);

                        query('UPDATE planets SET ships="'.serialize($newPlanetShips).'" WHERE id='.$_SESSION['planet']['id'].'');
                        $_SESSION['planet']['ships'] = $newPlanetShips;

                        header('Location: fleets.php');
                    } else if($mission == "astro") {

                        foreach($ships as $id => $num) {
                            if($id != 10) {
                                $other_sips = true;
                                break;
                            }
                        }
                        if($other_ships != true) {
                            $distance = flightDistance($c1, $c2, $c3, $tc1, $tc2, $tc3);
                            $flightTime = $slowest * $distance;
                            $consumation *= $distance;

                            $te = time() + $flightTime;
                            $rand = rand(1, 1000);
                            $id = $rand.'-'.time().'-'.$_SESSION['user']['id'].'-'.$to['id'];
                            query('INSERT INTO flights (id,owner,status,tc1,tc2,tc3,c1,c2,c3,time_start,time_end,type,ships,metal,crystal,gas) 
                        VALUES("'.$id.'",'.$_SESSION['user']['id'].',"go",'.$tc1.','.$tc2.','.$tc3.','.$c1.','.$c2.','.$c3.','.time().','.$te.',"'.$mission.'","'.$flightShips.'",'.$metal.','.$crystal.','.$gas.')');

                            $metalRq = $_SESSION['planet']['metal'] - $metal;
                            $crystalRq = $_SESSION['planet']['crystal'] - $crystal;
                            $gasRq = $_SESSION['planet']['gas'] - $consumation - $gas;

                            Resources::SetRes('metal', $metalRq);
                            Resources::SetRes('crystal', $crystalRq);
                            Resources::SetRes('gas', $gasRq);

                            query('UPDATE planets SET ships = "'.serialize($newPlanetShips).'" WHERE id='.$_SESSION['planet']['id'].'');
                            $_SESSION['planet']['ships'] = $newPlanetShips;
                        } else {
                            $_SESSION['errorMsg'][] = 'Ne moje da pra6tate drugi korabi osven reciklatori na astroploataciq';
                        }
                    } else if($mission == "colonise") {
                        
                    } else if($mission == "stationing") {
                        
                    } else if($mission == "recycle") {

                        foreach($ships as $id => $num) {
                            if($id != 10) {
                                $other_sips = true;
                                break;
                            }
                        }
                        if($other_ships != true) {
                            $distance = flightDistance($c1, $c2, $c3, $tc1, $tc2, $tc3);
                            $flightTime = $slowest * $distance;
                            $consumation *= $distance;

                            $te = time() + $flightTime;
                            $rand = rand(1, 1000);
                            $id = $rand.'-'.time().'-'.$_SESSION['user']['id'].'-'.$toPlanet['id'];
                            query('INSERT INTO flights (id,owner,status,tc1,tc2,tc3,c1,c2,c3,time_start,time_end,type,ships,metal,crystal,gas) 
                        VALUES("'.$id.'",'.$_SESSION['user']['id'].',"go",'.$tc1.','.$tc2.','.$tc3.','.$c1.','.$c2.','.$c3.','.time().','.$te.',"'.$mission.'","'.$flightShips.'",'.$metal.','.$crystal.','.$gas.')');

                            $metalRq = $_SESSION['planet']['metal'] - $metal;
                            $crystalRq = $_SESSION['planet']['crystal'] - $crystal;
                            $gasRq = $_SESSION['planet']['gas'] - $consumation - $gas;

                            Resources::SetRes('metal', $metalRq);
                            Resources::SetRes('crystal', $crystalRq);
                            Resources::SetRes('gas', $gasRq);

                            query('UPDATE planets SET ships = "'.serialize($newPlanetShips).'" WHERE id='.$_SESSION['planet']['id'].'');
                            $_SESSION['planet']['ships'] = $newPlanetShips;
                        } else {
                            $_SESSION['errorMsg'][] = 'Ne moje da pra6tate drugi korabi osven reciklatori na reciklirane';
                        }
                    }
                } else {
                    $_SESSION['errorMsg'][] = translate('Not found planet in this coordinates.');
                }
            }
        }
        header('Location: fleets.php');
    }

    public function refreshFlights($userId = null) {

        if($userId == null) {
            $userId = $_SESSION['user']['id'];
        }

        $rs = query('SELECT * FROM flights WHERE owner = '.$userId.'');
        while($flight = mysql_fetch_assoc($rs)) {
            if($flight) {
                if(!$flight['time_end'] <= time()) {

                    $flight['ships'] = unserialize($flight['ships']);

                    if($flight['status'] == "back") {
                        $planetId = fetch(query('SELECT id FROM planets WHERE c1 = '.$flight['tc1'].' AND c2 = '.$flight['tc2'].' AND c3='.$flight['tc3'].''));
                        $ships = $flight['ships'];
                        $newPlanetShips = $_SESSION['planet']['ships'];
                        foreach($ships as $id => $num) {
                            $newPlanetShips[$id] += $num;
                        }
                        $newPlanetShips = orderShips($newPlanetShips);

                        $metal = $_SESSION['planet']['metal'] + $flight['metal'];
                        $crystal = $_SESSION['planet']['crystal'] + $flight['crystal'];
                        $gas = $_SESSION['planet']['gas'] + $flight['gas'];

                        query('DELETE FROM flights WHERE id="'.$flight['id'].'"');
                        query('UPDATE planets SET metal='.$metal.', crystal='.$crystal.', gas='.$gas.', ships="'.serialize($newPlanetShips).'" WHERE id="'.$planetId['id'].'"');
                        $_SESSION['planet']['ships'] = $newPlanetShips;
                        $_SESSION['planet']['metal'] = $metal;
                        $_SESSION['planet']['crystal'] = $crystal;
                        $_SESSION['planet']['gas'] = $gas;

                        $msg = 'Флотата от <a href="galaxy.php?c1='.$flight['c1'].'&c2='.$flight['c2'].'&c3='.$flight['c3'].'">
                                    ['.$flight['c1'].':'.$flight['c2'].':'.$flight['c3'].']</a> пристигна на родната планета
                                        <a href="galaxy.php?c1='.$flight['tc1'].'&c2='.$flight['tc2'].'&c3='.$flight['tc3'].'">
                                    ['.$flight['tc1'].':'.$flight['tc2'].':'.$flight['tc3'].']</a>, носейки:<br/><br/>';
                        if($flight['type'] == 'attack' || $flight['type'] == 'transport' || $flight['type'] == 'astro' || $flight['type'] == 'recycle') {
                            $msg .= translate('Metal').': '.$flight['metal'].'<br/>'
                                    .translate('Crystal').': '.$flight['crystal'].'<br/>'
                                    .translate('Gas').': '.$flight['gas'].'<br/>';
                        }
                        if($flight['type'] != 'spy') {
                            Messages::sendMessage('flights', $flight['owner'], $msg);
                        }
                    } else {

                        $player1 = fetch(query('SELECT p.id as planet_id, p.buildings, p.c1, p.c2, p.c3, u.id as user_id, u.user, u.sciences, u.points, u.war_points, u.alliance 
                            FROM planets as p INNER JOIN users as u WHERE u.id = '.$flight['owner'].' AND p.owner = '.$flight['owner'].''));
                        $player1['buildings'] = unserialize($player1['buildings']);
                        $player1['ships'] = $flight['ships'];
                        $player1['sciences'] = unserialize($player1['sciences']);

                        if($flight['type'] == 'attack' || $flight['type'] == 'spy' || $flight['type'] == 'transport') {
                            $player2 = fetch(query('SELECT p.id as planet_id, p.owner, p.metal, p.crystal, p.gas, p.energy, p.buildings, p.ships, p.c1, p.c2, p.c3, u.id as user_id, u.user, u.sciences, u.points, u.war_points, u.alliance 
                                FROM planets as p INNER JOIN users as u WHERE p.c1 = '.$flight['c1'].' AND p.c2 = '.$flight['c2'].' AND p.c3 = '.$flight['c3'].' AND u.id = p.owner'));
                            $player2['buildings'] = unserialize($player2['buildings']);
                            $player2['ships'] = unserialize($player2['ships']);
                            $player2['sciences'] = unserialize($player2['sciences']);

                            Buildings::refreshBuildingConstruction($player2['planet_id']);
                            Sciences::refreshSciences($player2['user_id']);
                            Ships::refreshShipsConstruction($player2['planet_id']);
                            Flights::refreshFlights($player2['user_id']);
                            Resources::upRes($player2['planet_id']);
                        }

                        // ATTACK
                        if($flight['type'] == "attack") {

                            Flights::attack($player1, $player2, $flight);

                            // SPY
                        } else if($flight['type'] == "spy") {

                            $flyTime = $flight['time_end'] - $flight['time_start'];

                            query('DELETE FROM flights WHERE id = "'.$flight['id'].'"');

                            for($i = 1; $i <= $flight['ships'][7]; $i++) {
                                query('INSERT INTO spy (owner,defender,c1,c2,c3,tc1,tc2,tc3,fly_time) 
                                    VALUES('.$player1['user_id'].','.$player2['user_id'].','.$flight['c1'].','.$flight['c2'].','.$flight['c3'].',
                                        '.$flight['tc1'].','.$flight['tc2'].','.$flight['tc3'].','.$flyTime.')');
                                Flights::spy($player1, $player2);
                            }
                            // TRANSPORT
                        } else if($flight['type'] == "transport") {

                            $transPlMetal = $player2['metal'] + $flight['metal'];
                            $transPlCrystal = $player2['crystal'] + $flight['crystal'];
                            $transPlGas = $player2['gas'] + $flight['gas'];
                            $app->_resources->SetRes('metal', $transPlMetal, $player2['planet_id']);
                            $app->_resources->SetRes('crystal', $transPlCrystal, $player2['planet_id']);
                            $app->_resources->SetRes('gas', $transPlGas, $player2['planet_id']);

                            $te = time() + ($flight['time_end'] - $flight['time_start']);

                            query('UPDATE flights SET status = "back", time_start = '.time().', time_end = '.$te.', 
                                metal = 0, crystal = 0, gas = 0 WHERE id = "'.$flight['id'].'"');

                            $p1msg = 'Транспортните кораби изпълниха успешно своята мисия на 
                                <a href="galaxy.php?c1='.$flight['c1'].'&c2='.$flight['c2'].'">
                                    ['.$flight['c1'].':'.$flight['c2'].':'.$flight['c3'].']</a> и са на път към
                                    родната планета <a href="galaxy.php?c1='.$flight['tc1'].'&c2='.$flight['tc2'].'">
                                    ['.$flight['tc1'].':'.$flight['tc2'].':'.$flight['tc3'].']</a>.';

                            $p2msg = 'Транспортни кораби от <a href="galaxy.php?c1='.$flight['tc1'].'&c2='.$flight['tc2'].'">
                                    ['.$flight['tc1'].':'.$flight['tc2'].':'.$flight['tc3'].']</a> разтовариха: <br/><br/>
                                    Метал: '.$flight['metal'].'<br/>
                                    Кристали: '.$flight['crystal'].'<br/>
                                    Газ: '.$flight['gas'].'';

                            Messages::sendMessage('flights', $flight['owner'], $p1msg);
                            Messages::sendMessage('flights', $player2['user_id'], $p2msg);

                            // ASTROPLOATATION
                        } else if($flight['type'] == "astro") {

                            Common::refreshAsteroids($c1 = $flight['c1'], $c2 = $flight['c2']);

                            $ast = fetchAll(query('SELECT * FROM asteroids 
                                WHERE c1 = '.$flight['c1'].' AND c2 = '.$flight['c2'].' AND c3 = '.$flight['c3'].''));
                            if($ast) {
                                $recycles = explodeShips($flight['ships']);
                                $cargo = ($_SESSION['ships'][10]['cargo'] * $recycles[10]['num']) - ($flight['metal'] + $flight['crystal'] + $flight['gas']);
                                if(sizeof($ast) == 1)
                                    $ast = $ast[0];
                                else {
                                    foreach($ast as $a) {
                                        
                                    }
                                }
                                if($cargo >= $ast['gas']) {
                                    $gas = $ast['gas'];
                                    query('DELETE FROM asteroids WHERE id = '.$ast['id'].'');
                                } else {
                                    $gas = $cargo;
                                    $gas_left = $ast['gas'] - $cargo;
                                    query('UPDATE asteroids SET gas = '.$gas_left.' WHERE id = '.$ast['id'].'');
                                }
                                $msg = 'Астроплоатацията на <a href="galaxy.php?c1='.$flight['c1'].'&c2='.$flight['c2'].'">
                                        ['.$flight['c1'].':'.$flight['c2'].':'.$flight['c3'].']</a> завърши успешно.
                                            Рециклиращите кораби успяха да астроплоатират '.$gas.' газ.';
                            } else {
                                $gas = 0;
                                $msg = 'Астроплоатацията на <a href="galaxy.php?c1='.$flight['c1'].'&c2='.$flight['c2'].'">
                                        ['.$flight['c1'].':'.$flight['c2'].':'.$flight['c3'].']</a> завърши неуспешно. 
                                            Не беше открит астероид на зададените координати.';
                            }

                            $te = time() + ($flight['time_end'] - $flight['time_start']);
                            $gas += $flight['gas'];
                            query('UPDATE flights SET
                                status = "back", gas = '.$gas.', time_start = '.time().', time_end = '.$te.'
                                WHERE id = "'.$flight['id'].'"');

                            Messages::sendMessage('flights', $flight['owner'], $msg);

                            // COLONISE
                        } else if($flight['type'] == "colonise") {


                            // STATIONING
                        } else if($flight['type'] == "stationing") {


                            // RECYCLE
                        } else if($flight['type'] == "recycle") {

                            $rec = fetch(query('SELECT * FROM recycles 
                                WHERE c1 = '.$flight['c1'].' AND c2 = '.$flight['c2'].' AND c3 = '.$flight['c3'].''));
                            if($rec) {
                                $recycles = explodeShips($flight['ships']);
                                $cargo = ($_SESSION['ships'][10]['cargo'] * $recycles[10]['num']) - ($flight['metal'] + $flight['crystal'] + $flight['gas']);

                                $rec_total = $rec['metal'] + $rec['crystal'] + $rec['gas'];
                                $metal = $flight['metal'];
                                $crystal = $flight['crystal'];
                                $gas = $flight['gas'];

                                if($cargo >= $rec_total) {
                                    query('DELETE FROM recycles WHERE id = '.$rec['id'].'');

                                    $metal += $rec['metal'];
                                    $crystal += $rec['crystal'];
                                    $gas += $rec['gas'];
                                } else {
                                    $metal_left = $rec['metal'];
                                    $crystal_left = $rec['crystal'];
                                    $gas_left = $rec['gas'];

                                    if($cargo >= $rec['metal']) {
                                        $metal_left = 0;
                                        $metal += $rec['metal'];
                                        $cargo -= $metal;

                                        if($cargo >= $rec['crystal']) {
                                            $crystal_left = 0;
                                            $crystal += $rec['crystal'];
                                            $cargo -= $crystal;

                                            if($cargo >= $rec['gas']) {
                                                $gas_left = 0;
                                                $gas += $rec['gas'];
                                                $cargo -= $gas;
                                            } else {
                                                $gas_left -= $cargo;
                                                $gas += $cargo;
                                            }
                                        } else {
                                            $crystal_left -= $cargo;
                                            $crystal += $cargo;
                                        }
                                    } else {
                                        $metal_left -= $cargo;
                                        $metal += $cargo;
                                    }

                                    query('UPDATE recycles SET metal = '.$metal_left.', crystal = '.$crystal_left.', gas = "'.$gas_left.'" 
                                        WHERE id = '.$rec['id'].'');
                                }
                                $metal_msg = $metal - $flight['metal'];
                                $crystal_msg = $crystal - $flight['crystal'];
                                $gas_msg = $gas - $flight['gas'];
                                $msg = 'Рециклиращите кораби достигнаха успещно <a href="galaxy.php?c1='.$flight['c1'].'&c2='.$flight['c2'].'">
                                        ['.$flight['c1'].':'.$flight['c2'].':'.$flight['c3'].']</a> и успяха да съберат:</br>
                                            Метал: '.$metal_msg.'</br>
                                            Кристал: '.$crystal_msg.'</br>
                                            Газ: '.$gas_msg.'';
                            } else {
                                $msg = 'Рециклиращите кроаби достигнаха успешно <a href="galaxy.php?c1='.$flight['c1'].'&c2='.$flight['c2'].'">
                                        ['.$flight['c1'].':'.$flight['c2'].':'.$flight['c3'].']</a>, но не успяха да открият рециклаж на тези координати.';
                            }

                            $te = time() + ($flight['time_end'] - $flight['time_start']);

                            query('UPDATE flights SET
                                status = "back", metal = '.$metal.', crystal = '.$crystal.', gas = '.$gas.', time_start = '.time().', time_end = '.$te.'
                                WHERE id = "'.$flight['id'].'"');

                            Messages::sendMessage('flights', $flight['owner'], $msg);
                        }
                    }
                }
            }
        }
    }

    public function attack($player1, $player2, $flight) {

        $p1ships = $player1['ships'];
        $p2ships = $player2['ships'];

        $n = 0;
        do {
//            $n++;
//            echo '<br>ROUND '.$n.' !!!<br><br>';

            if(sizeof($p1ships) > 0 && sizeof($p2ships) > 0) {

//                echo 'Player 1<br>';
//                pr($p1ships);
//                echo 'Player 2<br>';
//                pr($p2ships);
                
                $p2alive = $p2ships;
                foreach($p1ships as $p1id => $p1s) {
                    $p1attack = $_SESSION['ships'][$p1id]['strength'] * $p1s;
                    foreach($p2alive as $p2id => $p2s) {
                        $p2def = $_SESSION['ships'][$p2id]['structure'] * $p2s;
                        break;
                    }

                    $p2def -= $p1attack;
                    $asd = $p2alive[$p2id];
                    
                    if($p2def <= $_SESSION['ships'][$p2id]['structure'] / 2) {
                        unset($p2alive[$p2id]);
                    } else {
                        $p2alive[$p2id] = round($p2def / $_SESSION['ships'][$p2id]['structure']);
                    }
//                    echo $player1['user'].' - '.$p1s.' '.$_SESSION['ships'][$p1id]['name'].'s ('.$p1attack.' dmg) VS '
//                        .$player2['user'].' - '.$p2s.' '.$_SESSION['ships'][$p2id]['name'].'s ('.($p2def + $p1attack).' defense) - '
//                        .($asd - $p2alive[$p2id]).' '.$_SESSION['ships'][$p2id]['name'].'s dead ('.$p2alive[$p2id].' remain)<br>';
                }
                echo '<br>';
                $p1alive = $p1ships;
                foreach($p2ships as $p2id => $p2s) {
                    $p2attack = $_SESSION['ships'][$p2id]['strength'] * $p2s;
                    foreach($p1alive as $p1id => $p1s) {
                        $p1def = $_SESSION['ships'][$p1id]['structure'] * $p1s;
                        break;
                    }
                    $p1def -= $p2attack;
                    $asd = $p1alive[$p1id];

                    if($p1def <= $_SESSION['ships'][$p1id]['structure'] / 2) {
                        unset($p1alive[$p1id]);
                    } else {
                        $p1alive[$p1id] = round($p1def / $_SESSION['ships'][$p1id]['structure']);
                    }

//                    echo $player2['user'].' - '.$p2s.' '.$_SESSION['ships'][$p2id]['name'].'s ('.$p2attack.' dmg) VS '
//                        .$player1['user'].' - '.$p1s.' '.$_SESSION['ships'][$p1id]['name'].'s ('.($p1def + $p2attack).' defense) - '
//                        .($asd - $p1alive[$p1id]).' '.$_SESSION['ships'][$p1id]['name'].'s dead ('.$p1alive[$p1id].' remain)<br>';
                }
                
                foreach($p1ships as $id => $num) {
                    if($p1alive[$id]) {
                        $p1ships[$id] = $p1alive[$id];
                    } else {
                        unset($p1ships[$id]);
                    }
                }
                foreach($p2ships as $id => $num) {
                    if($p2alive[$id]) {
                        $p2ships[$id] = $p2alive[$id];
                    } else {
                        unset($p2ships[$id]);
                    }
                }
//                echo 'Player 1<br>';
//                pr($p1ships);
//                echo 'Player 2<br>';
//                pr($p2ships);
                
            } else {
                $fightEnd = true;
            }
        } while($fightEnd != true);
        
        if(sizeof($p1ships) == 0) {
            $winner = $player2['user'];
        } else {
            $winner = $player1['user'];
        }

        $metal = $crystal = $gas = 0;
        foreach($player1['ships'] as $id => $num) {
            $shipsLost = $num - $p1ships[$id];
            $metal += ($_SESSION['ships'][$id]['metal'] * $shipsLost) / 2;
            $crystal += ($_SESSION['ships'][$id]['crystal'] * $shipsLost) / 2;
            $gas += ($_SESSION['ships'][$id]['gas'] * $shipsLost) / 2;
        }
        $pts = (($metal + $crystal + $gas) * 2) / -1000;
        User::setPoints($player1['user_id'], $pts);
        $pts = 0;
        foreach($player2['ships'] as $id => $num) {
            $shipsLost = $num - $p2ships[$id];
            $metal += ($_SESSION['ships'][$id]['metal'] * $shipsLost) / 2;
            $crystal += ($_SESSION['ships'][$id]['crystal'] * $shipsLost) / 2;
            $gas += ($_SESSION['ships'][$id]['gas'] * $shipsLost) / 2;
            $pts += ($_SESSION['ships'][$id]['metal'] + $_SESSION['ships'][$id]['crystal'] + $_SESSION['ships'][$id]['gas']) * $shipsLost;
        }
        $pts /= -1000;
        User::setPoints($player2['user_id'], $pts);

        if($winner == $player2['user']) {
            $metal += $flight['metal'] / 2;
            $crystal += $flight['crystal'] / 2;
            $gas += $flight['gas'] / 2;
        }
        $rec = fetch(query('SELECT * FROM recycles WHERE c1='.$flight['c1'].' AND c2='.$flight['c2'].' AND c3='.$flight['c3'].''));
        if($rec) {
            $metal += $rec['metal'];
            $crystal += $rec['crystal'];
            $gas += $rec['gas'];
            query('UPDATE recycles SET metal='.$metal.', crystal='.$crystal.', gas='.$gas.' 
                WHERE c1='.$flight['c1'].' AND c2='.$flight['c2'].' AND c3='.$flight['c3'].'');
        } else {
            query('INSERT INTO recycles (c1,c2,c3,metal,crystal,gas) 
                VALUES('.$flight['c1'].','.$flight['c2'].','.$flight['c3'].','.$metal.','.$crystal.','.$gas.')');
        }
        if($winner == $player1['user']) {
            foreach($p1ships as $id => $num) {
                $cargo += $_SESSION['ships'][$id]['cargo'] * $num;
            }
            $a = $cargo;
            $filledCargo = $flight['metal'] + $flight['crystal'] + $flight['crystal'];
            $cargo -= $filledCargo;
            
            $cMetal = $flight['metal'];
            $cCrystal = $flight['crystal'];
            $cGas = $flight['gas'];
            if($cargo > 0) {
                if($cargo >= $player2['metal'] / 2) {
                    $cMetal += $player2['metal'] / 2;
                    $cargo -= $player2['metal'] / 2;
                    $player2['metal'] /= 2;
                } else {
                    $cMetal += $cargo;
                    $cargo = 0;
                    $player2['metal'] -= $cargo;
                }
            }
            if($cargo > 0) {
                if($cargo >= $player2['crystal'] / 2) {
                    $cCrystal += $player2['crystal'] / 2;
                    $cargo -= $player2['crystal'] / 2;
                    $player2['crystal'] /= 2;
                } else {
                    $cCrystal += $cargo;
                    $cargo = 0;
                    $player2['crystal'] -= $cargo;
                }
            }
            if($cargo > 0) {
                if($cargo >= $player2['gas'] / 2) {
                    $cGas += $player2['gas'] / 2;
                    $cargo -= $player2['gas'] / 2;
                    $player2['gas'] /= 2;
                } else {
                    $cGas += $cargo;
                    $cargo = 0;
                    $player2['gas'] -= $cargo;
                }
            }
            
            query('UPDATE flights SET status = "back", ships = "'.serialize($p1ships).'", metal = '.$cMetal.', crystal = '.$cCrystal.', gas = '.$cGas.' 
                WHERE id = "'.$flight['id'].'"');
            query('UPDATE planets SET ships = "'.serialize($p2ships).'", metal = '.$player2['metal'].', crystal = '.$player2['crystal'].', gas = '.$player2['gas'].' 
                WHERE id = '.$player2['planet_id'].'');
        }
        if($winner == $player2['user']) {
            query('DELETE FROM flights WHERE id = "'.$flight['id'].'"');
            query('UPDATE planets SET ships = "'.serialize($p2ships).'" WHERE id = '.$player2['planet_id'].'');
        }
        
        $fname = $flight['id'].'.html';
        list($usec, $sec) = explode(" ", microtime());
        $name = ((float)$usec + (float)$sec);
        $fname = md5($name).'-'.date('Y-m-d-H-i', time()).'.html';
        $file = 'battles/'.$fname;
        $battle = fopen($file, 'w+');
        include 'battlereport.php';
        fwrite($battle, $battlereport);
        fclose($battle);
        
        $attackerMsg = 'Вашата флота от <a href="galaxy.php?c1='.$flight['tc1'].'&c2='.$flight['tc2'].'">
            ['.$flight['tc1'].':'.$flight['tc2'].':'.$flight['tc3'].']</a> 
            проведе битка на <a href="galaxy.php?c1='.$flight['c1'].'&c2='.$flight['c2'].'">
            ['.$flight['c1'].':'.$flight['c2'].':'.$flight['c3'].']</a>.  
            <a href="battles/'.$fname.'">Доклад.</a>';
        $defenderMsg = 'Флота от <a href="galaxy.php?c1='.$flight['tc1'].'&c2='.$flight['tc2'].'">
            ['.$flight['tc1'].':'.$flight['tc2'].':'.$flight['tc3'].']</a> 
            нападна вашата планета <a href="galaxy.php?c1='.$flight['c1'].'&c2='.$flight['c2'].'">
            ['.$flight['c1'].':'.$flight['c2'].':'.$flight['c3'].']</a> ! 
            <a href="battles/'.$fname.'">Доклад.</a>';

        Messages::sendMessage('millitary', $player1['user_id'], $attackerMsg);
        Messages::sendMessage('millitary', $player2['user_id'], $defenderMsg);
    }

    public function spySuccess($diff) {
        $successChanse = rand(1, 100);

        $fleetChanse = 50 + ($diff * 10);
        if($diff >= 2 || $diff <= -2)
            $buildsChanse = 50 + (($diff - 2) * 25);
        if($diff >= 4 || $diff <= -4)
            $shipyardChanse = 50 + (($diff - 4) * 25);

        $fleetSuccess = false;
        $buildsSuccess = false;
        $shipyardSuccess = false;

        if($successChanse <= $fleetChanse)
            $fleetSuccess = true;
        if($successChanse <= $buildsChanse)
            $buildsSuccess = true;
        if($successChanse <= $shipyardChanse)
            $shipyardSuccess = true;

        $result['fleet'] = $fleetSuccess;
        $result['builds'] = $buildsSuccess;
        $result['shipyard'] = $shipyardSuccess;

        return $result;
    }

    public function spy($player1, $player2, $id) {

        $fleetSuccess = false;
        $buildsSuccess = false;
        $shipyardSuccess = false;

        $diff = $player1['sciences'][1] - $player2['sciences'][1];
        $success = Flights::spySuccess($diff);
        if($success['fleet'] == false && $success['builds'] == false && $success['shipyard'] == false) {

            if($id)
                query('DELETE FROM spy WHERE id = '.$id.'');

            User::setPoints($player1['user_id'], -1);

            $attMsg = '
        <div class="spy-fail">
            Вашата шпионска сонда на <a href="galaxy.php?c1='.$player2['c1'].'&c2='.$player2['c2'].'">
                ['.$player2['c1'].':'.$player2['c2'].':'.$player2['c3'].']</a> беше разкрита и унищожена !
        </div>';

            $defMsg = 'На <a href="galaxy.php?c1='.$player2['c1'].'&c2='.$player2['c2'].'">
                ['.$player2['c1'].':'.$player2['c2'].':'.$player2['c3'].']</a> беше разкрита и унищожена 
                    вражеска шпионска сонда от <a href="galaxy.php?c1='.$player1['tc1'].'&c2='.$player1['tc2'].'">
            ['.$player1['tc1'].':'.$player1['tc2'].':'.$player1['tc3'].']</a>!';
        } else {

            $shipyard = fetch(query('SELECT * FROM ships_in_construction WHERE planet_id = '.$player2['planet_id'].''));

            if($shipyard)
                $player2['shipyard'] = unserialize($shipyard);

            $attMsg = '
            <div class="spy-report-title">
                <span>'.translate("Spy report from").' <a href="galaxy.php?c1='.$player2['c1'].'&c2='.$player2['c2'].'">
                ['.$player2['c1'].':'.$player2['c2'].':'.$player2['c3'].']</a></span>
            </div>
            <div class="spy-resources">
                <span>'.translate(Metal).': '.number_format($player2['metal'], 0, '.', ' ').'</span>
                <span>'.translate(Crystal).': '.number_format($player2['crystal'], 0, '.', ' ').'</span>
                <span>'.translate(Gas).': '.number_format($player2['gas'], 0, '.', ' ').'</span>
                <span>'.translate(Energy).': '.Resources::GetEnergy($player2['user_id']).'</span>
            </div>';
            if($success['builds'] == true) {
                $attMsg .= '
            <table class="spy-table">
                <thead>
                    <tr><td colspan="2">'.translate('Buildings').':</td></tr>
                </thead>
                <tbody>';
                foreach($player2['buildings'] as $id => $level)
                    $attMsg .= '<tr>
                                <td>'.$_SESSION['buildings'][$id]['name'].':</td>
                                <td>'.$level.'</td>
                            </tr>';
                $attMsg .= '
                </tbody>
            </table>';
            }

            if($success['fleet'] == true && sizeof($player2['ships']) > 0) {
                    if($success['builds'] == true)
                        $style = 'float: right; margin-right: 30px;';
                    $attMsg .= '
                <table style="'.$style.'" class="spy-table">
                    <thead>
                        <tr><td colspan="2">'.translate('Fleet').':</td></tr>
                    </thead>
                    <tbody>';
                    foreach($player2['ships'] as $id => $num) {
                        $attMsg .= '<tr>
                                    <td>'.$_SESSION['ships'][$id]['name'].':</td>
                                    <td>'.$num.'</td>
                                </tr>';
                    }
                    $attMsg .= '
                    </tbody>
                </table>';
            }

            if($success['shipyard'] == true && isset($player2['shipyard'])) {
                $attMsg .= '
                <table style="float: none; width: 480px;" class="spy-table">
                    <thead>
                        <tr><td colspan="2">'.translate("Ships in construction").':</td></tr>
                    </thead>
                    <tbody>';
                    foreach($player2['shipyard'] as $id => $num)
                        $attMsg .= '<tr>
                                        <td>'.$_SESSION['ships'][$id]['name'].':</td>
                                        <td>'.$num.'</td>
                                    </tr>';
                $attMsg .= '
                    </tbody>
                </table>';
            }

            $defMsg = 'Флота от <a href="galaxy.php?c1='.$player1['tc1'].'&c2='.$player1['tc2'].'">
            ['.$player1['tc1'].':'.$player1['tc2'].':'.$player1['tc3'].']</a> беше забелязана в близост до 
            <a href="galaxy.php?c1='.$player2['c1'].'&c2='.$player2['c2'].'">
            ['.$player2['c1'].':'.$player2['c2'].':'.$player2['c3'].']</a>, вероятно шпионира за информация.';
        }
        Messages::sendMessage('spy', $player1['user_id'], $attMsg);
        Messages::sendMessage('spy', $defender['user_id'], $defMsg);
    }

    public function refreshEnemyFlights() {
        $enemyFlights = fetchAll(query('SELECT * FROM flights WHERE c1='.$_SESSION['planet']['c1'].'
                                AND c2='.$_SESSION['planet']['c2'].' AND c3='.$_SESSION['planet']['c3'].''));
        return $enemyFlights;
    }

}