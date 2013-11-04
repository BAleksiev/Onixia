<?php
include 'head.php';

if(isset($_GET['id']) && isset($_GET['act'])) {
    $id = (int)$_GET['id'];
    $act = (string)$_GET['act'];

    $spy = fetch(query('SELECT * FROM spy WHERE id = '.$id.''));
    $p2 = fetch(query('SELECT id as planet_id, owner as user_id FROM planets WHERE c1 = '.$spy['c1'].' AND c2 = '.$spy['c2'].' AND c3 = '.$spy['c3'].''));
    
    Buildings::refreshBuildingConstruction($p2['planet_id']);
    Sciences::refreshSciences($p2['user_id']);
    Ships::refreshShipsConstruction($p2['planet_id']);
    Flights::refreshFlights($p2['user_id']);
    Resources::upRes($p2['planet_id']);
    
    $player1 = fetch(query('SELECT p.id as planet_id, p.metal, p.crystal, p.gas, p.energy, p.buildings, p.c1, p.c2, p.c3, u.id as user_id, u.user, u.sciences, u.points, u.war_points, u.alliance 
        FROM planets as p INNER JOIN users as u WHERE u.id = '.$spy['owner'].' AND p.owner = '.$spy['owner'].''));
    $player1['buildings'] = unserialize($player1['buildings']);
    $player1['ships'][7] = 1;
    $player1['sciences'] = unserialize($player1['sciences']);

    $player2 = fetch(query('SELECT p.id as planet_id, p.owner, p.metal, p.crystal, p.gas, p.energy, p.buildings, p.ships, p.c1, p.c2, p.c3, u.id as user_id, u.user, u.sciences, u.points, u.war_points, u.alliance 
        FROM planets as p INNER JOIN users as u WHERE p.c1 = '.$spy['c1'].' AND p.c2 = '.$spy['c2'].' AND p.c3 = '.$spy['c3'].' AND u.id = p.owner'));
    $player2['buildings'] = unserialize($player2['buildings']);
    $player2['ships'] = unserialize($player2['ships']);
    $player2['sciences'] = unserialize($player2['sciences']);
    
    if($spy['owner'] != $player1['user_id']) {
        $_SESSION['errorMsg'][] = 'Ne moje da izpolzvate sondite na drug igrach';
    } else {
        if($act == 'spy') {
            Flights::spy($player1, $player2, $id);
        } else if($act == 'back') {
            $te = time() + $spy['fly_time'];
            $rand = rand(1, 1000);
            $flightId = $rand.'-'.time().'-'.$_SESSION['user']['id'].'-'.$defender['owner'];
            
            $probe[7] = 1;
            $probe = serialize($probe);
            query('INSERT INTO flights (id,owner,status,tc1,tc2,tc3,c1,c2,c3,time_start,time_end,type,ships,metal,crystal,gas) 
            VALUES("'.$flightId.'",'.$spy['owner'].',"back",'.$spy['tc1'].','.$spy['tc2'].','.$spy['tc3'].',
                '.$spy['c1'].','.$spy['c2'].','.$spy['c3'].','.time().','.$te.',"spy","'.$probe.'",0,0,0)');
            query('DELETE FROM spy WHERE id = "'.$id.'"');
        }
    }
    header('Location: fleets.php');
} else {
    header('Location: main.php');
}