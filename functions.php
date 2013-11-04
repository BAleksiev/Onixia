<?php

function db_conn() {
    mysql_connect('localhost', 'root', '') or die("Грешка при свързване с базата данни");
    mysql_select_db('onixia');
    mysql_query('SET NAMES utf8');
}

function mysql_q($query) {
    if(mysql_error())
        return mysql_error();
    return mysql_query($query);
}

function query($query) {
    if(mysql_error())
        return mysql_error();
    return mysql_query($query);
}

function fetch($query) {
    if(mysql_error())
        return mysql_error();
    return mysql_fetch_assoc($query);
}

function fetchAll($res) {
    if(mysql_error())
        return mysql_error();
    while($rs = mysql_fetch_assoc($res))
        $result[] = $rs;
    return $result;
}

function redirect($dir) {
    header('Location: '.$dir);
}

function pr($var) {
    echo '<pre>'.print_r($var, true).'</pre>';
}

function imgRewidth($format, $dir, $rewidth) {
    if($format == 'jpeg')
        $img = imagecreatefromjpeg($dir);
    else if($format == 'png')
        $img = imagecreatefrompng($dir);
    else if($format == 'gif')
        $img = imagecreatefromgif($dir);
    $width = imagesx($img);
    $height = imagesy($img);
    if($width > $rewidth) {
        $new_width = $rewidth;
        $new_height = floor($height * ($rewidth / $width));
        $tmp_img = imagecreatetruecolor($new_width, $new_height);
        imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        if($format == 'jpeg')
            imagejpeg($tmp_img, $dir);
        else if($format == 'png')
            imagepng($tmp_img, $dir);
        else if($format == 'gif')
            imagegif($tmp_img, $dir);
    }
}

function imgReheight($format, $dir, $reheight) {
    if($format == 'jpeg')
        $img = imagecreatefromjpeg($dir);
    else if($format == 'png')
        $img = imagecreatefrompng($dir);
    else if($format == 'gif')
        $img = imagecreatefromgif($dir);
    $width = imagesx($img);
    $height = imagesy($img);
    if($height > $reheight) {
        $new_width = floor($width * ($reheight / $height));
        $new_height = $reheight;
        $tmp_img = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        if($format == 'jpeg')
            imagejpeg($tmp_img, $dir);
        else if($format == 'png')
            imagepng($tmp_img, $dir);
        else if($format == 'gif')
            imagegif($tmp_img, $dir);
    }
}

function explodeShips($array) {
    $a = explode(',', $array);
    $n = 0;
    foreach($a as $b) {
        $c[] = explode('-', $b);
        $d[$c[$n][0]]['id'] = $c[$n][0];
        $d[$c[$n][0]]['num'] = $c[$n][1];
        $n++;
    }
    return $d;
}

function explode_req($array) {
    $a = explode(',', $array);
    $n = 0;
    foreach($a as $b) {
        $c[] = explode('-', $b);
        $d[$n]['id'] = $c[$n][0];
        $d[$n]['num'] = $c[$n][1];
        $n++;
    }
    return $d;
}

function orderShips($ships) {

    foreach($ships as $id => $num) {
        if($num != 0) {
            $order[$id] = (int)$num;
        }
    }
    ksort($order);
    return $order;
}

function translate($str) {
    $st = explode(' ', $str);
    if(sizeof($st) > 1) {
        $str = null;
        $n = 0;
        foreach($st as $s) {
            $n++;
            if($n == sizeof($st)) {
                $dot = substr($s, -1);
                if($dot == '.')
                    $s = substr($s, 0, -1);
            }
            if(isset($_SESSION['lang'][$s][$_SESSION['user']['lang']]))
                $str .= $_SESSION['lang'][$s][$_SESSION['user']['lang']].' ';
            else
                $str .= $s.' ';
            if($dot == '.')
                $str = substr($str, 0, -1).'.';
        }
        return $str;
    } else {
        if(isset($_SESSION['lang'][$str][$_SESSION['user']['lang']]))
            return $_SESSION['lang'][$str][$_SESSION['user']['lang']];
        else
            return $str;
    }
}

function loadDwoo($action, $data) {
    include 'dwoo/dwooAutoload.php';
    $dwoo = new Dwoo();

    if(is_array($action))
        foreach($action as $act)
            $dwoo->output('views/'.$act.'.php', $data);
    else
        $dwoo->output('views/'.$action.'.php', $data);
}

function timeConvert($secs) {
    $h = floor(($secs / 60) / 60);
    $m = floor(($secs / 60) - ($h * 60));
    $s = $secs % 60;
    
    if(strlen($h) == 1)
        $h = '0'.$h;
    if(strlen($m) == 1)
        $m = '0'.$m;
    if(strlen($s) == 1)
        $s = '0'.$s;
    
    $time = $h.':'.$m.':'.$s;
    return $time;
}

function getIpAddress() {
    if(trim($_SERVER['HTTP_CLIENT_IP']) != "") {   //проверява адреса
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if(trim($_SERVER['HTTP_X_FORWARDED_FOR']) != "") {   //проверява дали адреса е от прокси
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function flightDistance($c1, $c2, $c3, $tc1, $tc2, $tc3) {

    $c1diff = $c1 - $tc1;
    $c2diff =
            $c2 - $tc2;
    if($c1diff < 0)
        $c1diff *= -1;
    if($c2diff < 0)
        $c2diff *= -1;

    if(($c2 > $tc2 && $c1 == $tc1) || ($c1 > $tc1))
        $c3diff = (10 - $tc3) + $c3;
    else
        $c3diff = (10 - $c3) + $tc3;

    if($c1diff == 0) {
        $planets = $c2diff * 5 + $c3diff;
    } else {
        if($c1diff == 1)
            $gSystems = 0;
        else
            $gSystems = $c1diff * 200;
        $systems = (200 - $tc2) + ($c2 - 1);
        $planets = ($gSystems * 5) + ($systems * 5) + $c3diff;
    }

    return $planets;
}

function lastOnline($time) {
    $secs = time() - $time;
    
    if($secs > 900)
        return 0;
    else if($secs < 60)
        return 1;
    else
        return round($secs / 60);
}