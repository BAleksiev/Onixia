<?php

class Resources {

    public function upRes($planetId = null) {
        
        if($planetId == null) {
            $planet = $_SESSION['planet'];
            $sciences = $_SESSION['user']['sciences'];
        } else {
            $planet = fetch(query('SELECT * FROM planets WHERE id = '.$planetId.''));
            $planet['buildings'] = unserialize($planet['buildings']);
            $rs = fetch(query('SELECT sciences FROM users WHERE id = '.$planet['owner'].''));
            $sciences = unserialize($rs);
        }

        $timeDiff = (time() - $planet['last_update']) / 3600;
        for($i = 1; $i <= 3; $i++) {
            $mineLvl = $planet['buildings'][$i];
            $income = $_SESSION['Bprices'][$i][$mineLvl]['bonus'];
            $energySysBonus = $sciences[3] * 5;
            if($i == 1) {
                $metalUp = $planet['metal'] + (($income + (($energySysBonus / 100) * $income)) * $timeDiff);
                $planet['metal'] = $metalUp;
//                echo 'metal= +'.$income*$timeDiff.'<br>';
            }
            if($i == 2) {
                $crystalUp = $planet['crystal'] + (($income + (($energySysBonus / 100) * $income)) * $timeDiff);
                $planet['crystal'] = $crystalUp;
//                echo 'crystal= +'.$income*$timeDiff.'<br>';
            }
            if($i == 3) {
                $gasUp = $planet['gas'] + (($income + (($energySysBonus / 100) * $income)) * $timeDiff);
                $planet['gas'] = $gasUp;
//                echo 'gas= +'.$income*$timeDiff.'<br>';
            }
        }
        $planet['last_update'] = time();
        query('UPDATE planets SET metal = '.$metalUp.', crystal = '.$crystalUp.', gas = '.$gasUp.', last_update='.time().' WHERE id = '.$planet['id'].'');
    }

    public function GetEnergy($planet_id = null) {
        if($planet_id != null) {
            $rs = fetch(query('SELECT buildings FROM planets WHERE id = '.$planet_id.''));
            $buildings = unserialize($rs['buildings']);
            $spLvl = $buildings[4];
            foreach($buildings as $id => $b) {
                $builds[$id] = $b;
            }
        } else {
            $spLvl = $_SESSION['planet']['buildings'][4];
            $builds = $_SESSION['planet']['buildings'];
        }
        $energy = $_SESSION['Bprices'][4][$spLvl]['bonus'];
        for($i = 1; $i <= 3; $i++) {
            $bLvl = $builds[$i];
            $dif = $_SESSION['Bprices'][$i][$bLvl]['energy'];
            $energy -= $dif;
        }
        return (int)$energy;
    }

    public function GetIncome($building_id) {
        $bLvl = $_SESSION['planet']['buildings'][$building_id];
        $energySysBonus = $_SESSION['user']['sciences'][3] * 5;
        if($bLvl != 0) {
            $inc = $_SESSION['Bprices'][$building_id][$bLvl]['bonus'];
            $income = $inc + (($energySysBonus / 100) * $inc);
            return $income;
        } else {
            return 0;
        }
    }

    public function SetRes($res_type, $rq, $planet_id = null) {
        if($planet_id == null) {
            $planet_id = $_SESSION['planet']['id'];
            $_SESSION['planet'][$res_type] = $rq;
        }
        query('UPDATE planets SET '.$res_type.' = '.$rq.' WHERE id='.$planet_id.'');
    }

    public function resControl($metal, $crystal, $gas) {
        $metalWh = $_SESSION['Bprices'][9][$_SESSION['planet']['buildings'][9]]['bonus'];
        $crystalWh = $_SESSION['Bprices'][10][$_SESSION['planet']['buildings'][10]]['bonus'];
        $gasWh = $_SESSION['Bprices'][11][$_SESSION['planet']['buildings'][11]]['bonus'];
        if($metal > $metalWh) {
            query('UPDATE planets SET metal='.$metalWh.' WHERE id='.$_SESSION['planet']['id'].'');
            $_SESSION['planet']['metal'] = $metalWh;
        }
        if($crystal > $crystalWh) {
            query('UPDATE planets SET crystal='.$crystalWh.' WHERE id='.$_SESSION['planet']['id'].'');
            $_SESSION['planet']['crystal'] = $crystalWh;
        }
        if($gas > $gasWh) {
            query('UPDATE planets SET gas='.$gasWh.' WHERE id='.$_SESSION['planet']['id'].'');
            $_SESSION['planet']['gas'] = $gasWh;
        }
    }

}