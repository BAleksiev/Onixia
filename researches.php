<?php
include 'head.php';
$sr = fetch(query('SELECT * FROM sciences_researching WHERE user_id = '.$_SESSION['user']['id'].''));

$scienceFacilityLvl = $_SESSION['planet']['buildings'][6];
if($scienceFacilityLvlLvl > 0) {
    $scienceFacilityBonus = $_SESSION['Bprices'][5][$scienceFacilityLvl]['bonus'];
} else {
    $scienceFacilityBonus = 1;
}
foreach($_SESSION['sciences'] as $science) {
    $t = $_SESSION['Sprices'][$science['id']][$_SESSION['researches'][$science['id']] + 1]['time_need'] / $scienceFacilityBonus;
    if($sr) {
        $tr = $sr['time_end'] - time();
        $timeNeed[$science['name']] = $t;
        $error[$science['name']]['msg'] = ' !-! ';
        $error[$science['name']]['id'] = 'research';
        if($science['id'] == $sr['science_id']) {
            $timeNeed[$science['name']] = $tr;
            $error[$science['name']]['msg'] = 'cancel';
            $error[$science['name']]['id'] = 'this';
        }
    } else {
        $SpriceMetal = $_SESSION['Sprices'][$science['id']][$_SESSION['researches'][$science['id']] + 1]['metal'];
        $SpriceCrystal = $_SESSION['Sprices'][$science['id']][$_SESSION['researches'][$science['id']] + 1]['crystal'];
        $SpriceGas = $_SESSION['Sprices'][$science['id']][$_SESSION['researches'][$science['id']] + 1]['gas'];
        $b_req = explode_req($_SESSION['sciences'][$science['id']]['b_requirements']);
        $s_req = explode_req($_SESSION['sciences'][$science['id']]['s_requirements']);
        foreach($b_req as $br) {
            if($br['num'] > $_SESSION['planet']['buildings'][$br['id']]) {
                $b_err[$science['name']][] = 'You need '.$br['num'].' level of '.$_SESSION['buildings'][$br['id']]['name'];
            }
        }
        foreach($s_req as $sr) {
            if($sr['num'] > $_SESSION['researches'][$sr['id']]) {
                $s_err[$science['name']][] = 'You need '.$sr['num'].' level of '.$_SESSION['sciences'][$sr['id']]['name'];
            }
        }
        $sr = null;
        if(!isset($b_err[$science['name']]) && !isset($s_err[$science['name']])) {
            if(Resources::GetEnergy() < 0) {
                $timeNeed[$science['name']] = $t;
                $error[$science['name']]['msg'] = "Not enough energy";
                $error[$science['name']]['id'] = 4;
            } else {
                if($planet['metal'] >= $SpriceMetal) {
                    if($planet['crystal'] >= $SpriceCrystal) {
                        if($planet['gas'] >= $SpriceGas) {
                            if($_SESSION['researches'][$science['id']] < $_SESSION['sciences'][$science['id']]['max_level']) {
                                $timeNeed[$science['name']] = $t;
                                $rView[$science['name']] = true;
                            } else {
                                $error[$science['name']]['msg'] = 'Maximum level';
                                $error[$science['name']]['id'] = 'level';
                            }
                        } else {
                            $timeNeed[$science['name']] = (($SpriceGas - $planet['gas']) / Resources::GetIncome(3)) * 60 * 60;
                            $error[$science['name']]['msg'] = "Not enough gas";
                            $error[$science['name']]['id'] = 3;
                        }
                    } else {
                        $timeNeed[$science['name']] = (($SpriceCrystal - $planet['crystal']) / Resources::GetIncome(2)) * 60 * 60;
                        $error[$science['name']]['msg'] = "Nqma dostata4no kristal";
                        $error[$science['name']]['id'] = "Nqma dostata4no kristal";
                    }
                } else {
                    $timeNeed[$science['name']] = (($SpriceMetal - $planet['metal']) / Resources::GetIncome(1)) * 60 * 60;
                    $error[$science['name']]['msg'] = "Nqma dostata4no metal";
                    $error[$science['name']]['id'] = "Nqma dostata4no metal";
                }
            }
        } else {
            $timeNeed[$science['name']] = $t;
            if($b_err[$science['name']]) {
                $error[$science['name']]['msg'] = 'Need building.';
                $error[$science['name']]['id'] = 'req';
            } else if($s_err[$science['name']]) {
                $error[$science['name']]['msg'] = 'Need science.';
                $error[$science['name']]['id'] = 'req';
            }
        }
    }
}
$app->data['error'] = $error;
$app->data['timeNeed'] = $timeNeed;
$app->data['rView'] = $rView;
$app->data['b_err'] = $b_err;
$app->data['s_err'] = $s_err;

include 'dwoo_view.php';