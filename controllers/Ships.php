<?php

class Ships {

    public function buildShips($ships) {

        $app = App::getInstance();
        
        $sic = fetch(query('SELECT * FROM ships_in_construction WHERE planet_id = '.$_SESSION['planet']['id'].''));
        if($sic) {
            $_SESSION['errorMsg'][] = 've4e ima korabi v stroej';
            header('Location: ships.php');
        } else {
            
            $constructShips = orderShips($ships);
            
            foreach($ships as $id => $num) {
                $totalMetalPrice += $num * $_SESSION['ships'][$id]['metal'];
                $totalCrystalPrice += $num * $_SESSION['ships'][$id]['crystal'];
                $totalGasPrice += $num * $_SESSION['ships'][$id]['gas'];
                $mt[] = $num * $_SESSION['ships'][$id]['time_need'];
            }
            $maxTime = max($mt);
            $timeEnd = time() + $maxTime;
            if($_SESSION['planet']['metal'] < $totalMetalPrice)
                $_SESSION['errorMsg'][] = translate('Not enough metal.');
            else if($_SESSION['planet']['crystal'] < $totalCrysalPrice)
                $_SESSION['errorMsg'][] = translate('Not enough crystals');
            else if($_SESSION['planet']['gas'] < $totalGasPrice)
                $_SESSION['errorMsg'][] = translate('Not enough gas');
            if(!isset($_SESSION['errorMsg'])) {
                query("INSERT INTO ships_in_construction (planet_id,ships,time_start,time_end) 
                    VALUES(".$_SESSION['planet']['id'].",'".serialize($constructShips)."',".time().",".$timeEnd.")");
                $metalDiff = $_SESSION['planet']['metal'] - $totalMetalPrice;
                $crystalDiff = $_SESSION['planet']['crystal'] - $totalCrystalPrice;
                $gasDiff = $_SESSION['planet']['gas'] - $totalGasPrice;
                Resources::SetRes('metal', $metalDiff);
                Resources::SetRes('crystal', $crystalDiff);
                Resources::SetRes('gas', $gasDiff);
                $pts = ($totalMetalPrice + $totalCrystalPrice + $totalGasPrice) / 1000;
                User::setPoints($_SESSION['user']['id'], $pts);
            }
            header('Location: ships.php');
        }
    }

    public function refreshShipsConstruction($planetId = null) {
        
        if($planetId == null) {
            $planet = $_SESSION['planet'];
        } else {
            $planet = fetch(query('SELECT id, ships FROM planets WHERE id = '.$planetId.''));
            $planet['ships'] = unserialize($planet['ships']);
        }
        
        $sic = fetch(query('SELECT * FROM ships_in_construction WHERE planet_id='.$planet['id'].''));
        if($sic) {
            if(!$sic['time_end'] <= time()) {
                $newShips = unserialize($sic['ships']);
                $planetShips = $planet['ships'];
                
                foreach($newShips as $id => $num) {
                    $planetShips[$id] += $num;
                }
                
                query('DELETE FROM ships_in_construction WHERE planet_id = '.$planet['id'].'');
                query('UPDATE planets SET ships = "'.serialize($planetShips).'" WHERE id = '.$planet['id'].'');
                if($planetId == null) {
                    $_SESSION['planet']['ships'] = $planetShips;
                }
            }
        }
    }

}