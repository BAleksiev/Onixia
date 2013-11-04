<?php

class Buildings {

    public $planetId = null;
    public $userId = null;

    public function upgradeBuilding($id) {

        $bic = fetch(query('SELECT * FROM buildings_in_construction WHERE planet_id='.$_SESSION['planet']['id'].''));
        if($id <= 0 || $bic['cnt'] > 0) {
            header('Location: buildings.php');
        }
        if($_GET['mode'] == 'cancel') {
            $mPrice = $_SESSION['Bprices'][$id][$_SESSION['planet']['buildings'][$id] + 1]['metal'];
            $cPrice = $_SESSION['Bprices'][$id][$_SESSION['planet']['buildings'][$id] + 1]['crystal'];
            $gPrice = $_SESSION['Bprices'][$id][$_SESSION['planet']['buildings'][$id] + 1]['gas'];
            if($mPrice != 0)
                $metal = $_SESSION['planet']['metal'] + ((70 / 100) * $mPrice);
            if($cPrice != 0)
                $crystal = $_SESSION['planet']['crystal'] + ((70 / 100) * $cPrice);
            if($gPrice != 0)
                $gas = $_SESSION['planet']['gas'] + ((70 / 100) * $gPrice);
            Resources::SetRes('metal', $metal);
            Resources::SetRes('crystal', $crystal);
            Resources::SetRes('gas', $gas);
            $pts = ($mPrice + $cPrice + $gPrice) / -1000;
            User::setPoints($_SESSION['user']['id'], $pts);
            query('DELETE FROM buildings_in_construction WHERE planet_id='.$_SESSION['planet']['id'].' AND building_id='.$id.'');
        }
        else if($_SESSION['planet']['buildings'][$id] < $_SESSION['buildings'][$id]['max_level']) {
            $bLvl = $_SESSION['planet']['buildings'][$id];
            $price = $_SESSION['Bprices'][$id][$bLvl + 1];
            if((Resources::GetEnergy() < 0 || Resources::GetEnergy() < $price['energy'] - $_SESSION['Bprices'][$id][$bLvl]['energy']) && $id != 4) {
                $_SESSION['errorMsg'][] = translate('Not enough energy.');
            } else {
                if($_SESSION['planet']['metal'] >= $price['metal']) {
                    if($_SESSION['planet']['crystal'] >= $price['crystal']) {
                        if($_SESSION['planet']['gas'] >= $price['gas']) {
                            $robotFactoryLvl = $_SESSION['planet']['buildings'][5];
                            if($robotFactoryLvl > 0)
                                $robotFactoryBonus = $_SESSION['Bprices'][5][$robotFactoryLvl]['bonus'];
                            else
                                $robotFactoryBonus = 1;
                            $timeNow = time();
                            $timeNeed = $price['time_need'] / $robotFactoryBonus;
                            $timeEnd = $timeNow + $timeNeed;
                            $build_lvl = $bLvl + 1;
                            query('INSERT INTO buildings_in_construction (building_id,planet_id,build_level,time_start,time_end) 
                            VALUES('.$id.','.$_SESSION['planet']['id'].','.$build_lvl.','.$timeNow.','.$timeEnd.')');
                            $metal = $_SESSION['planet']['metal'] - $price['metal'];
                            $crystal = $_SESSION['planet']['crystal'] - $price['crystal'];
                            $gas = $_SESSION['planet']['gas'] - $price['gas'];
                            Resources::SetRes('metal', $metal);
                            Resources::SetRes('crystal', $crystal);
                            Resources::SetRes('gas', $gas);
                            $pts = ($price['metal'] + $price['crystal'] + $price['gas']) / 1000;
                            User::setPoints($_SESSION['user']['id'], $pts);
                        } else
                            $_SESSION['errorMsg'][] = translate('Not enough gas.');
                    } else
                        $_SESSION['errorMsg'][] = translate('Not enough crystals.');
                } else
                    $_SESSION['errorMsg'][] = translate('Not enough metal.');
            }
        } else {
            $_SESSION['errorMsg'][] = translate('Max level.');
        }
        header('Location: buildings.php');
    }

    public function refreshBuildingConstruction($planetId = null) {
        
        if($planetId == null) {
            $planet = $_SESSION['planet'];
        } else {
            $planet = fetch(query('SELECT id, buildings FROM planets WHERE id = '.$planetId.''));
            $planet['buildings'] = unserialize($planet['buildings']);
        }

        $bc = fetch(query('SELECT * FROM buildings_in_construction WHERE planet_id='.$planet['id'].''));
        if($bc) {
            if($bc['time_end'] <= time()) {
                query('DELETE FROM buildings_in_construction WHERE planet_id='.$planet['id'].'');
                $planet['buildings'][$bc['building_id']]++;
                query("UPDATE planets SET buildings = '".serialize($planet['buildings'])."' WHERE id = ".$planet['id']."");
                if($planetId == null) {
                    $_SESSION['planet']['buildings'] = $planet['buildings'];
                }
            }
        }
    }

}