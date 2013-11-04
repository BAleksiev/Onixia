<?php
include 'head.php';

if(!$_GET) {
    $c1 = $planet['c1'];
    $c2 = $planet['c2'];
} else {
    $c1 = $_GET['c1'];
    $c2 = $_GET['c2'];
    // TO FIX $c1 > """3""" 3 is number of galaxyes - config
    if($c1 < 1 || $c1 > 3)
        $c1 = $_SESSION['planet']['c1'];
    // TO FIX $c2 > """1000""" 1000 is number of solar systems - config
    if($c2 < 1 || $c2 > 1000)
        $c2 = $_SESSION['planet']['c2'];
}

$pl = fetchAll(query('SELECT p.c3, p.owner, p.name, p.last_update, u.user, u.points, u.war_points, u.alliance, a.name as alliance_name 
    FROM planets as p INNER JOIN users as u INNER JOIN alliances as a
    WHERE p.c1='.$c1.' AND p.c2='.$c2.' AND u.id = p.owner AND a.id = u.alliance'));

foreach($pl as $p)
    $planets[$p['c3']] = $p;
$ast = fetchAll(query('SELECT * FROM asteroids WHERE c1 = '.$c1.' AND c2 = '.$c2.''));
foreach($ast as $a) {
    $asteroids[$n] = $a;
    $asteroids[$n]['next_move'] = $a['moved'] + $a['speed'];
    $n++;
}
$rec = fetchAll(query('SELECT * FROM recycles WHERE c1 = '.$c1.' AND c2 = '.$c2.''));
foreach($rec as $r)
    $recycles[$r['c3']] = $r;

$app->data['planetsView'] = $planets;
$app->data['asteroids'] = $asteroids;
$app->data['recycles'] = $recycles;
$app->data['c1'] = $c1;
$app->data['c2'] = $c2;
$app->data['c3'] = $c3;

include 'dwoo_view.php';