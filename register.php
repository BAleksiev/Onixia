<?php
session_start();
include 'functions.php';
db_conn();

if($_SESSION['logged_in'] === true) {
    header('Location: main.php');
}
if($_POST['register'] == 1) {
    $user = trim($_POST['user']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);

    $_user = fetch(query('SELECT * FROM users WHERE user="'.$user.'"'));
    if(!$_user) {
        $dateReg = time();
        $c1 = rand(1, 4);
        $c2 = rand(1, 200);
        $c3 = rand(1, 10);
        $fields = rand(100, 250);
        for($i = 1; $i <= 15; $i++) {
            $sciences[$i] = 0;
        }
        query('INSERT INTO users (user,pass,email,sciences,lang,date_reg) 
            VALUES("'.$user.'","'.$pass.'","'.$email.'",'.serialize($sciences).',"bg",'.$dateReg.')');
        $res = fetch(query('SELECT id FROM users WHERE user="'.$user.'"'));
        $userId = $res['id'];
        for($i = 1; $i <= 15; $i++) {
            $buildings[$i] = 0;
        }
        query('INSERT INTO planets (owner,name,metal,crystal,gas,energy,fields,buildings,c1,c2,c3,main) 
            VALUES('.$userId.',"main planet",500,500,500,'.$fields.','.serialize($buildings).','.$c1.','.$c2.','.$c3.',1)');
        header('index.php');
    } else {
        $_SESSION['errorMsg'][] = translate('This nickname is already taken by other player.');
        header('Location: index.php');
    }
}