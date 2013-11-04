<?php
include 'head.php';
if($_POST) {
    
    $data = $_POST;
    
    Flights::newFlight($data);
    
} else if($_GET) {
    
    $data['act'] = (string)$_GET['act'];
    $data['c1'] = (int)$_GET['c1'];
    $data['c2'] = (int)$_GET['c2'];
    $data['c3'] = (int)$_GET['c3'];
    
    Flights::newFlight($data);
    
} else {
    header('Location: fleets.php');
}