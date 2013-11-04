<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><?php
include 'head.php';
$rs=mysql_q('SELECT COUNT(*) as cnt FROM buildings_in_construction WHERE planet_id='.$planet['id'].'');
$c=mysql_fetch_assoc($rs);
if($c['cnt']>0) {
    $rs=mysql_q('SELECT * FROM buildings_in_construction WHERE planet_id='.$planet['id'].'');
    $bic=mysql_fetch_assoc($rs);
}
$robotFactoryLvl=$_SESSION['builds'][5];
if($robotFactoryLvl>0) {
    $robotFactoryBonus=$_SESSION['Bprices'][5][$robotFactoryLvl]['bonus'];
} else {
    $robotFactoryBonus=1;
}
foreach($_SESSION['buildings'] as $building) {
    $t=$_SESSION['Bprices'][$building['id']][$_SESSION['builds'][$building['id']]+1]['time_need']/$robotFactoryBonus;
    if($bic) {
        $tn=time();
        $tr=$bic['time_end']-$tn;
        $timeNeed[$building['name']]=$t;
        $error[$building['name']]['msg']=' !-! ';
        $error[$building['name']]['id']='build';
        if($building['id']==$bic['building_id']) {
            $timeNeed[$building['name']]=$tr;
            $error[$building['name']]['msg']='cancel';
            $error[$building['name']]['id']='this';
        }
    } else {
        $BpriceMetal=$_SESSION['Bprices'][$building['id']][$_SESSION['builds'][$building['id']]+1]['metal'];
        $BpriceCrystal=$_SESSION['Bprices'][$building['id']][$_SESSION['builds'][$building['id']]+1]['crystal'];
        $BpriceGas=$_SESSION['Bprices'][$building['id']][$_SESSION['builds'][$building['id']]+1]['gas'];
        if(($res->GetEnergy()<0 || $res->GetEnergy()<=$_SESSION['Bprices'][$building['id']][$_SESSION['builds'][$building['id']]+1]['energy']) && $building['name']!="solar_panels") {
            $timeNeed[$building['name']]=$t;
            $error[$building['name']]['msg']="Not enough energy";
            $error[$building['name']]['id']=4;
        } else {
            if($planet['metal']>=$BpriceMetal) {
                if($planet['crystal']>=$BpriceCrystal) {
                    if($planet['gas']>=$BpriceGas) {
                        if($_SESSION['builds'][$building['id']]<$_SESSION['buildings'][$building['id']]['max_level']) {
                            $timeNeed[$building['name']]=$t;
                            $build[$building['name']]=true;
                        } else {
                            $error[$building['name']]['msg']='Maximum level';
                            $error[$building['name']]['id']='level';
                        }
                    } else {
                        $timeNeed[$building['name']]=(($BpriceGas-$planet['gas'])/$res->GetIncome(3))*60*60;
                        $error[$building['name']]['msg']="Not enough gas";
                        $error[$building['name']]['id']=3;
                    }
                } else {
                    $timeNeed[$building['name']]=(($BpriceCrystal-$planet['crystal'])/$res->GetIncome(2))*60*60;
                    $error[$building['name']]['msg']="Not enough crystals";
                    $error[$building['name']]['id']=2;
                }
            } else {
                $timeNeed[$building['name']]=(($BpriceMetal-$planet['metal'])/$res->GetIncome(1))*60*60;
                $error[$building['name']]['msg']="Not enough metal";
                $error[$building['name']]['id']=1;
            }
        }
    }
}
$data['error'] = $error;
$data['timeNeed'] = $timeNeed;
$data['build'] = $build;

$act[] = 'header';
$act[] = 'leftNav';
$act[] = $action;
$act[] = 'rightNav';
$act[] = 'footer';

loadDwoo($action, $data);<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>