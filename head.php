<?php
session_start();
if($_SESSION['logged_in'] !== true) {
    header('Location: index.php');
}
include 'core/App.php';
db_conn();

$app = App::getInstance();
$app->run();

$action = substr(basename($_SERVER['PHP_SELF']), 0, -4);

Resources::upRes();

$_SESSION['planet'] = fetch(query('SELECT * FROM planets WHERE id='.$_SESSION['planet']['id'].''));
$_SESSION['planet']['buildings'] = unserialize($_SESSION['planet']['buildings']);
$_SESSION['planet']['ships'] = unserialize($_SESSION['planet']['ships']);
$r = fetch(query("SELECT sciences FROM users WHERE id = ".$_SESSION['user']['id'].""));
$_SESSION['user']['sciences'] = unserialize($r['sciences']);

$lang = $_SESSION['lang'];
$user = $_SESSION['user'];
$planet = $_SESSION['planet'];
$bPrices = $_SESSION['Bprices'];
$sPrices = $_SESSION['Sprices'];

//Resources::resControl($_planet_SESSION['planet]['metal'],$_SESSION['planet']['crystal'],$_SESSION['planet']['gas']);

if($action == 'buildings' || $action == 'statistic') {
    Buildings::refreshBuildingConstruction($planet['id']);
} else if($action == 'researches' || $action == 'statistic') {
    Sciences::refreshSciences($_SESSION['user']['id']);
} else if($action == 'ships' || $action == 'fleets') {
    Ships::refreshShipsConstruction($planet['id']);
} else if($action == 'factory' || $action == 'fleets') {
    Common::refreshFactory();
} else if($action == 'main') {
    $app->enemyFlights = Flights::refreshEnemyFlights();
} else if($action == 'galaxy') {
    if($_GET['c1'] && $_GET['c2']) {
        $c1 = (int)$_GET['c1'];
        $c2 = (int)$_GET['c2'];
    } else {
        $c1 = $_SESSION['planet']['c1'];
        $c2 = $_SESSION['planet']['c2'];
    }
    Common::refreshAsteroids($c1, $c2);
}
Flights::refreshFlights($_SESSION['user']['id']);
Messages::refreshMessages();

$app->data['lang'] = $_SESSION['lang'];
$app->data['energy'] = Resources::getEnergy();
$app->data['user'] = $_SESSION['user'];
$app->data['planet'] = $_SESSION['planet'];
$app->data['planets'] = $_SESSION['planets'];
$app->data['Bprices'] = $bPrices;
$app->data['Sprices'] = $sPrices;
$app->data['buildings'] = $_SESSION['buildings'];
$app->data['ranks'] = $_SESSION['ranks'];
$app->data['builds'] = $_SESSION['planet']['buildings'];
$app->data['researches'] = $_SESSION['user']['sciences'];
$app->data['sciences'] = $_SESSION['sciences'];
$app->data['ships'] = $_SESSION['ships'];
$app->data['enemyFlights'] = $app->enemyFlights;
$app->data['newMessages'] = Messages::getNewMessages();
$app->data['action'] = $app->action;
$app->data['url'] = $app->url;
$app->data['url_params'] = $app->url_params;

//echo number_format(memory_get_usage()/1024,2).' kb';