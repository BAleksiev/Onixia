<?php

class Sciences {

    public function upgradeScience($id) {

        $sr = fetch(query('SELECT COUNT(*) as cnt FROM sciences_researching WHERE user_id='.$_SESSION['user']['id'].''));
        if($id <= 0 || $sr['cnt'] > 0) {
            header('Location: researches.php');
        }
        if($_GET['mode'] == 'cancel') {
            $mPrice = $_SESSION['Sprices'][$id][$_SESSION['user']['sciences'][$id] + 1]['metal'];
            $cPrice = $_SESSION['Sprices'][$id][$_SESSION['user']['sciences'][$id] + 1]['crystal'];
            $gPrice = $_SESSION['Sprices'][$id][$_SESSION['user']['sciences'][$id] + 1]['gas'];
            if($mPrice != 0)
                $metal = $_SESSION['planet']['metal'] + ((70 / 100) * $mPrice);
            if($cPrice != 0)
                $crystal = $_SESSION['planet']['crystal'] + ((70 / 100) * $cPrice);
            if($gPrice != 0)
                $gas = $_SESSION['planet']['gas'] + ((70 / 100) * $gPrice);
            Resources::SetRes('metal', $metal);
            Resources::SetRes('crystal', $crystal);
            Resources::SetRes('gas', $gas);
            query('DELETE FROM sciences_researching WHERE user_id='.$_SESSION['user']['id'].' AND science_id='.$id.'');
            $pts = ($mPrice + $cPrice + $gPrice) / -1000;
            setPoints($_SESSION['user']['id'], $pts);
        }
        if($_SESSION['user']['sciences'][$id] < $_SESSION['sciences'][$id]['max_level']) {
            $sLvl = $_SESSION['user']['sciences'][$id];
            $price = $_SESSION['Sprices'][$id][$sLvl];
            if(Resources::GetEnergy() < 0) {
                $_SESSION['errorMsg'][] = translate('Not enough energy.');
            } else {
                if($_SESSION['planet']['metal'] >= $price['metal']) {
                    if($_SESSION['planet']['crystal'] >= $price['crystal']) {
                        if($_SESSION['planet']['gas'] >= $price['gas']) {
                            $scienceFacilityLvl = $_SESSION['planet']['buildings'][6];
                            if($scienceFacilityLvl > 0)
                                $scienceFacilityBonus = $_SESSION['Bprices'][5][$scienceFacilityLvl]['bonus'];
                            else
                                $scienceFacilityBonus = 1;
                            $timeNow = time();
                            $timeNeed = $price['time_need'] / $scienceFacilityBonus;
                            $timeEnd = $timeNow + $timeNeed;
                            $science_lvl = $sLvl + 1;
                            query('INSERT INTO sciences_researching (science_id,user_id,science_level,time_start,time_end) 
                            VALUES('.$id.','.$_SESSION['user']['id'].','.$science_lvl.','.$timeNow.','.$timeEnd.')');
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
            $_SESSION['errorMsg'][] = translate('Max level');
        }
        header('Location: researches.php');
    }

    public function refreshSciences($userId = null) {
        
        if($userId == null) {
            $user = $_SESSION['user'];
        } else {
            $user = fetch(query('SELECT id, sciences FROM users WHERE id = '.$userId.''));
            $user['sciences'] = unserialize($user['sciences']);
        }
        
        $sr = fetch(query('SELECT * FROM sciences_researching WHERE user_id='.$user['id'].''));
        if($sr) {
            if($sr['time_end'] <= time()) {
                query('DELETE FROM sciences_researching WHERE user_id='.$user['id'].'');
                $user['sciences'][$sr['science_id']]++;
                query("UPDATE users SET sciences = '".serialize($user['sciences'])."' WHERE id=".$user['id']."");
                if($userId == null) {
                    $_SESSION['user']['sciences'] = $user['sciences'];
                }
            }
        }
    }

}