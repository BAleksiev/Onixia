<?php

$battlereport.='
<div id="info" style="width: 100%; height: 200px;">
<div id="attackerInfo" style="float: left;">Attacker<br/><br/>';
//    foreach($attacker['bonuses'] as $id => $num) $battlereport.=$_SESSION['sciences'][$id]['name'].' - '.$num.'<br />';
$battlereport.='
</div>
<div id="defenderInfo" style="margin-left: 100px; float: left;">Defender<br/><br/>';
//    foreach($defender['bonuses'] as $id => $num) $battlereport.=$_SESSION['sciences'][$id]['name'].' - '.$num.'<br />';
$battlereport.='
</div>
</div>
<div id="battlestart" style="width: 100%; height: 200px;">
<div id="title">Battle start</div><br/>
<div id="attacker" style="float: left;">Attacker<br/><br/>';
    foreach($player1['ships'] as $id => $num) $battlereport.=$_SESSION['ships'][$id]['name'].' : '.$num.'<br/>';
$battlereport.='
</div>
<div id="defender" style="margin-left: 100px; float: left;">Defender<br /><br />';
    foreach($player2['ships'] as $id => $num) $battlereport.=$_SESSION['ships'][$id]['name'].' : '.$num.'<br/>';
$battlereport.='
</div>
</div>
<div id="title">Battle end</div><br />
<div id="attacker" style="float: left;">Attacker<br /><br />';
    foreach($p1ships as $id => $num) $battlereport.=$_SESSION['ships'][$id]['name'].' : '.$num.'<br/>';
$battlereport.='
</div>
<div id="defender" style="margin-left: 100px; float: left;">Defender<br /><br />';
    foreach($p2ships as $id => $num) $battlereport.=$_SESSION['ships'][$id]['name'].' : '.$num.'<br/>';
$battlereport.='
</div>
</div><br/>
<div style="float: left; width: 100%;">
Winner: '.$winner.'<br/><br/>
Otkradnati resursi:<br/>
Metal: '.($cMetal - $flight['metal']).'<br/>
Crystal: '.($cCrystal - $flight['crystal']).'<br/>
Gas: '.($cGas - $flight['gas']).'</div>';