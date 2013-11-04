<?php
include 'head.php';
$fl = fetchAll(query('SELECT * FROM flights WHERE owner='.$user['id'].''));
$n = 0;
foreach($fl as $f) {
    $flights[$n] = $f;
    $flights[$n]['time_back'] = $f['time_end'] - $f['time_start'] + $f['time_end'];
    $n++;
}
$spy = fetchAll(query('SELECT s.*, u.user FROM spy as s INNER JOIN users as u WHERE s.owner = '.$user['id'].' AND u.id = s.defender'));

if($_GET['act'] == 'back') {
    if($_GET['id']) {
        $id = $_GET['id'];
        $fl = fetch(query('SELECT * FROM flights WHERE id="'.$id.'"'));
        if($fl['owner'] == $_SESSION['user']['id']) {
            $tn = time();
            $timeBack = ($tn - $fl['time_start']) + $tn;
            query('UPDATE flights SET status = "back", time_end = '.$timeBack.' WHERE id = "'.$id.'"');
        }
    }
    header('Location: fleets.php');
}

$cookies['c1'] = $_COOKIE['c1'];
$cookies['c2'] = $_COOKIE['c2'];
$cookies['c3'] = $_COOKIE['c3'];

$app->data['cookies'] = $cookies;
$app->data['flights'] = $flights;
$app->data['spy'] = $spy;
$app->data['shipsC'] = $_SESSION['planet']['ships'];

include 'dwoo_view.php';