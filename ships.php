<?php
include 'head.php';
$sic = fetch(query('SELECT * FROM ships_in_construction WHERE planet_id = '.$_SESSION['planet']['id'].''));
if($sic) {
    $si = unserialize($sic['ships']);
    foreach($si as $si2) {
        $_SESSION['msg'] .= $_SESSION['ships'][$si2['id']]['name'].' : '.$si2['num'].'<br>';
    }
    $timeLeft = $sic['time_end'] - time();
    $_SESSION['msg'] .= timeConvert($timeLeft);
}

foreach($_SESSION['ships'] as $ship) {
    if($sic) {
        $error[$ship['name']]['msg'] = ' - ! -';
        $error[$ship['name']]['id'] = 'build';
    } else {
        if($_SESSION['planet']['metal'] >= $ship['metal'] || $ship['metal'] == 0) {
            if($_SESSION['planet']['crystal'] >= $ship['crystal'] || $ship['crystal'] == 0) {
                if($_SESSION['planet']['gas'] >= $ship['gas'] || $ship['gas'] == 0) {
                    if($ship['metal'] != 0)
                        $max[] = $planet['metal'] / $ship['metal'];
                    if($ship['crystal'] != 0)
                        $max[] = $planet['crystal'] / $ship['crystal'];
                    if($ship['gas'] != 0)
                        $max[] = $planet['gas'] / $ship['gas'];
                    $maxNum[$ship['name']] = min($max);
                    $sView[$ship['name']] = true;
                } else {
                    $error[$ship['name']]['msg'] = 'Not enough gas.';
                    $error[$ship['name']]['id'] = 3;
                }
            } else {
                $error[$ship['name']]['msg'] = 'Not enough crystals.';
                $error[$ship['name']]['id'] = 2;
            }
        } else {
            $error[$ship['name']]['msg'] = 'Not enough metal.';
            $error[$ship['name']]['id'] = 1;
        }
        $max = null;
    }
}

$app->data['sView'] = $sView;
$app->data['error'] = $error;
$app->data['timeNeed'] = $timeNeed;
$app->data['maxNum'] = $maxNum;
$app->data['avShips'] = $_SESSION['planet']['ships'];

include 'dwoo_view.php';