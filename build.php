<?php
include 'head.php';

if(!isset($_GET['id']) && !isset($_GET['type'])) {
    header('Location: buildings.php');
}
$type = (string)$_GET['type'];
$id = (int)$_GET['id'];

if($type == "building") {
    Buildings::upgradeBuilding($id);
} else if($type == "research") {
    Sciences::upgradeScience($id);
} else if($type == "ship_upgrade") {
    
}