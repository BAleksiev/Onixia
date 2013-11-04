<?php
session_start();
if($_SESSION['logged_in'] === true) {
    header('Location: main.php');
} else {
    include 'functions.php';
    include 'views/index.php';
}