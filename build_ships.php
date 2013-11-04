<?php
include 'head.php';

if ($_POST) {
    Ships::buildShips($_POST);
} else {
    header('Location: ships.php');
}