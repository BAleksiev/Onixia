<?php
include 'head.php';
$bic = fetch(query('SELECT * FROM buildings_in_construction WHERE planet_id='.$_SESSION['planet']['id'].''));

$robotFactoryLvl = $_SESSION['planet']['buildings'][5];
if($robotFactoryLvl > 0) {
    $robotFactoryBonus = $_SESSION['Bprices'][5][$robotFactoryLvl]['bonus'];
} else {
    $robotFactoryBonus = 1;
}

foreach($_SESSION['buildings'] as $building) {
    $t = $_SESSION['Bprices'][$building['id']][$_SESSION['planet']['buildings'][$building['id']] + 1]['time_need'] / $robotFactoryBonus;
    if($bic) {
        $tr = $bic['time_end'] - time();
        $timeNeed[$building['name']] = $t;
        $error[$building['name']]['msg'] = ' !-! ';
        $error[$building['name']]['id'] = 'build';
        if($building['id'] == $bic['building_id']) {
            $timeNeed[$building['name']] = $tr;
            $error[$building['name']]['msg'] = 'cancel';
            $error[$building['name']]['id'] = 'this';
        }
    } else {
        $BpriceMetal = $_SESSION['Bprices'][$building['id']][$_SESSION['planet']['buildings'][$building['id']] + 1]['metal'];
        $BpriceCrystal = $_SESSION['Bprices'][$building['id']][$_SESSION['planet']['buildings'][$building['id']] + 1]['crystal'];
        $BpriceGas = $_SESSION['Bprices'][$building['id']][$_SESSION['planet']['buildings'][$building['id']] + 1]['gas'];
        $b_req = explode_req($_SESSION['buildings'][$building['id']]['b_requirements']);
        $s_req = explode_req($_SESSION['buildings'][$building['id']]['s_requirements']);
        foreach($b_req as $br) {
            if($br['num'] > $_SESSION['planet']['buildings'][$br['id']]) {
                $b_err[$building['name']][] = 'You need '.$br['num'].' level of '.$_SESSION['buildings'][$br['id']]['name'];
            }
        }
        foreach($s_req as $sr) {
            if($sr['num'] > $_SESSION['user']['sciences'][$sr['id']]) {
                $s_err[$building['name']][] = 'You need '.$sr['num'].' level of '.$_SESSION['sciences'][$sr['id']]['name'];
            }
        }
        if(!isset($b_err[$building['name']]) && !isset($s_err[$building['name']])) {
            if((Resources::GetEnergy() < 0 || Resources::GetEnergy() < $_SESSION['Bprices'][$building['id']][$_SESSION['planet']['buildings'][$building['id']] + 1]['energy'] - $bPrices[$building['id']][$_SESSION['planet']['buildings'][$building['id']]]['energy']) && $building['name'] != "solar_panels") {
                $timeNeed[$building['name']] = $t;
                $error[$building['name']]['msg'] = "Not enough energy";
                $error[$building['name']]['id'] = 4;
            } else {
                if($_SESSION['planet']['metal'] >= $BpriceMetal || $BpriceMetal == 0) {
                    if($_SESSION['planet']['crystal'] >= $BpriceCrystal || $BpriceCrystal == 0) {
                        if($_SESSION['planet']['gas'] >= $BpriceGas || $BpriceGas == 0) {
                            if($_SESSION['planet']['buildings'][$building['id']] < $_SESSION['buildings'][$building['id']]['max_level']) {
                                $timeNeed[$building['name']] = $t;
                                $build[$building['name']] = true;
                            } else {
                                $error[$building['name']]['msg'] = 'Maximum level';
                                $error[$building['name']]['id'] = 'level';
                            }
                        } else {
                            $timeNeed[$building['name']] = (($BpriceGas - $_SESSION['planet']['gas']) / Resources::GetIncome(3)) * 3600;
                            $error[$building['name']]['msg'] = "Not enough gas";
                            $error[$building['name']]['id'] = 3;
                        }
                    } else {
                        $timeNeed[$building['name']] = (($BpriceCrystal - $_SESSION['planet']['crystal']) / Resources::GetIncome(2)) * 3600;
                        $error[$building['name']]['msg'] = "Not enough crystals";
                        $error[$building['name']]['id'] = 2;
                    }
                } else {
                    $timeNeed[$building['name']] = (($BpriceMetal - $_SESSION['planet']['metal']) / Resources::GetIncome(1)) * 3600;
                    $error[$building['name']]['msg'] = "Not enough metal";
                    $error[$building['name']]['id'] = 1;
                }
            }
        } else {
            $timeNeed[$building['name']] = $t;
            if($b_err[$building['name']]) {
                $error[$building['name']]['msg'] = 'Need building.';
                $error[$building['name']]['id'] = 'req';
            } else if($s_err[$building['name']]) {
                $error[$building['name']]['msg'] = 'Need science.';
                $error[$building['name']]['id'] = 'req';
            }
        }
    }
}
$app->data['error'] = $error;
$app->data['timeNeed'] = $timeNeed;
$app->data['build'] = $build;
$app->data['b_err'] = $b_err;
$app->data['s_err'] = $s_err;

include 'dwoo_view.php';