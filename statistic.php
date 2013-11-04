<?php
include 'head.php';

$metalIncome = $bPrices[1][$_SESSION['planet']['buildings'][1]]['bonus'];
$crystalIncome = $bPrices[2][$_SESSION['planet']['buildings'][2]]['bonus'];
$gasIncome = $bPrices[3][$_SESSION['planet']['buildings'][3]]['bonus'];
$energySystemsBonus = $_SESSION['user']['sciences'][3] * 5;
$energySystemsBonus .= '%';

$metalEnergyUse = $bPrices[1][$_SESSION['planet']['buildings'][1]]['energy'];
$crystalEnergyUse = $bPrices[2][$_SESSION['planet']['buildings'][2]]['energy'];
$gasEnergyUse = $bPrices[3][$_SESSION['planet']['buildings'][3]]['energy'];
$energy = $bPrices[4][$_SESSION['planet']['buildings'][4]]['bonus'];
$free = $energy;
for($i = 1; $i <= 3; $i++) {
    $free -= $bPrices[$i][$_SESSION['planet']['buildings'][$i]]['energy'];
}
$usedEnergy = $metalEnergyUse + $crystalEnergyUse + $gasEnergyUse;
$energyIncome = $bPrices[4][$_SESSION['planet']['buildings'][4]]['bonus'];

$metal_total_income = Resources::GetIncome(1);
$crystal_total_income = Resources::GetIncome(2);
$gas_total_income = Resources::GetIncome(3);
$metalCapacity = $bPrices[9][$_SESSION['planet']['buildings'][9]]['bonus'];
$crystalCapacity = $bPrices[10][$_SESSION['planet']['buildings'][10]]['bonus'];
$gasCapacity = $bPrices[11][$_SESSION['planet']['buildings'][11]]['bonus'];


$app->data['metalInc'] = $metalIncome;
$app->data['crystalInc'] = $crystalIncome;
$app->data['gasInc'] = $gasIncome;
$app->data['metalEnergyUse'] = $metalEnergyUse;
$app->data['crystalEnergyUse'] = $crystalEnergyUse;
$app->data['gasEnergyUse'] = $gasEnergyUse;
$app->data['energySysBonus'] = $energySystemsBonus;
$app->data['usedEnergy'] = $usedEnergy;
$app->data['energyIncome'] = $energyIncome;
$app->data['freeEnergy'] = $free;
$app->data['metalTot'] = $metal_total_income;
$app->data['crystalTot'] = $crystal_total_income;
$app->data['gasTot'] = $gas_total_income;
$app->data['metalCap'] = $metalCapacity;
$app->data['crystalCap'] = $crystalCapacity;
$app->data['gasCap'] = $gasCapacity;

include 'dwoo_view.php';