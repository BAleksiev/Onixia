<?php
session_start();
include 'functions.php';
db_conn();
echo '<a href="' . $_GET['back'] . '"><- BACK</a></br></br>';

//$s[1] = 435;
//$s[3] = 524;
//$s[4] = 2543;
//$s[6] = 343;
//$s[7] = 50;
//$s[8] = 10;
//$s[10] = 1000;
//$s[11] = 500;
//
//$a[1] = 200;
//$a[3] = 432;
//$a[4] = 1000;
//$a[6] = 30;
//
//echo serialize($s);
//echo '<br>';
//echo serialize($a);

echo time();

//ASTEROID ADDING
//for($c1=1; $c1<4; $c1++) {
//    $ast_num = rand(400,600);
//    for($n=0; $n<=$ast_num; $n++) {
//        $c2 = rand(1,1000);
//        $c3 = rand(1,10);
//        $gas = rand(2000,300000);
//        $speed = rand(1500,2700);
//        $tn = time();
//        mysql_q('INSERT INTO asteroids (c1,c2,c3,speed,gas,moved) 
//            VALUES('.$c1.','.$c2.','.$c3.','.$speed.','.$gas.','.$tn.')');
//        echo mysql_error();
//    }
//}

//$bID=15;
//$rs=mysql_q('SELECT max_level FROM sciences WHERE id='.$bID.'');
//$id=mysql_fetch_assoc($rs);
//$metal=10000;
//$crystal=7000;
//$gas=3000;
////$energy=0;
////$income=0;
//$tn=4700;
//for($i=1; $i<=$id['max_level']; $i++) {
//    mysql_q('INSERT INTO sciences_prices_1 (science_id,level,metal,crystal,gas,time_need)
//        VALUES('.$bID.','.$i.','.$metal.','.$crystal.','.$gas.','.$tn.')');
//    echo mysql_error();
//$metal*=2;
//$crystal*=2;
//$gas*=2;
//$tn+=$tn/2;
//}