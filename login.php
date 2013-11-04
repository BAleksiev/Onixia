<?php
session_start();
include 'functions.php';
db_conn();

if($_SESSION['logged_in'] == true) {
    header('Location: main.php');
} else {
    if($_POST['login'] == 1 || ($_GET['user'] != null && $_GET['pass'] != null)) {
        if($_GET['user'] != null && $_GET['pass'] != null) {
            $user = trim($_GET['user']);
            $pass = trim($_GET['pass']);
        } else {
            $user = trim($_POST['user']);
            $pass = trim($_POST['pass']);
        }

        $_user = fetch(query('SELECT * FROM users WHERE user = "'.$user.'" AND pass = "'.$pass.'"'));
        if($_user) {
            $_SESSION['logged_in'] = true;

            $_SESSION['user'] = $_user;
            $_SESSION['user']['sciences'] = unserialize($_user['sciences']);
            $_SESSION['user']['ignores'] = unserialize($_user['ignores']);

            $_SESSION['planet'] = fetch(query('SELECT * FROM planets WHERE owner='.$_SESSION['user']['id'].' AND main=1'));
            $_SESSION['planet']['buildings'] = unserialize($_SESSION['planet']['buildings']);
            $_SESSION['planet']['ships'] = unserialize($_SESSION['planet']['ships']);

            $rs = fetchAll(query('SELECT * FROM planets WHERE owner = '.$_SESSION['user']['id'].''));
            foreach($rs as $p)
                $_SESSION['planets'][$p['id']] = $p;

            $rs = fetchAll(query('SELECT m.*, u.user as from_name, u2.user as to_name FROM messages as m 
                INNER JOIN users as u INNER JOIN users as u2 
                WHERE m.`to` = '.$_SESSION['user']['id'].' AND u.id = m.`from` AND u2.id = m.`to` AND m.type = "personal" AND m.state > 0 
                ORDER BY time_send DESC'));
            foreach($rs as $m) {
                if($m['read'] == 0)
                    $_SESSION['messages']['personal']['new'][$m['id']] = $m;
                else
                    $_SESSION['messages']['personal']['old'][$m['id']] = $m;
            }
            $rs = fetchAll(query('SELECT * FROM messages 
                WHERE `to` = '.$_SESSION['user']['id'].' AND state > 0 AND type != "personal"
                ORDER BY time_send DESC'));
            foreach($rs as $m) {
                if($m['read'] == 0) {
                    if($m['type'] == 'alliance')
                        $_SESSION['messages']['alliance']['new'][$m['id']] = $m;
                    if($m['type'] == 'spy')
                        $_SESSION['messages']['spy']['new'][$m['id']] = $m;
                    if($m['type'] == 'millitary')
                        $_SESSION['messages']['millitary']['new'][$m['id']] = $m;
                    if($m['type'] == 'flights')
                        $_SESSION['messages']['flights']['new'][$m['id']] = $m;
                } else {
                    if($m['type'] == 'alliance')
                        $_SESSION['messages']['alliance']['old'][$m['id']] = $m;
                    if($m['type'] == 'spy')
                        $_SESSION['messages']['spy']['old'][$m['id']] = $m;
                    if($m['type'] == 'millitary')
                        $_SESSION['messages']['millitary']['old'][$m['id']] = $m;
                    if($m['type'] == 'flights')
                        $_SESSION['messages']['flights']['old'][$m['id']] = $m;
                }
            }

            $rs = query('SELECT * FROM buildings');
            while($rss = mysql_fetch_assoc($rs))
                $_SESSION['buildings'][$rss['id']] = $rss;

            $rs = query('SELECT * FROM buildings_prices');
            while($rss = mysql_fetch_assoc($rs))
                $_SESSION['Bprices'][$rss['building_id']][$rss['level']] = $rss;

            $rs = query('SELECT * FROM sciences');
            while($rss = mysql_fetch_assoc($rs))
                $_SESSION['sciences'][$rss['id']] = $rss;

            $rs = query('SELECT * FROM sciences_prices');
            while($rss = mysql_fetch_assoc($rs))
                $_SESSION['Sprices'][$rss['science_id']][$rss['level']] = $rss;

            $rs = query('SELECT * FROM ships');
            while($rss = mysql_fetch_assoc($rs))
                $_SESSION['ships'][$rss['id']] = $rss;
            
            $rs = fetchAll(query('SELECT * FROM alliance_ranks'));
            foreach($rs as $r)
                $_SESSION['ranks'][$r['id']] = $r['name'];
            
            $langs = fetchAll(query('SELECT * FROM languages'));
            foreach($langs as $l) {
                $_SESSION['lang'][$l['key']]['en'] = $l['en'];
                $_SESSION['lang'][$l['key']]['bg'] = $l['bg'];
            }
            $ip = getIpAddress();
            if($ip != '127.0.0.1')
                query('INSERT INTO logins (ip, time, acc) 
                    VALUES("'.$ip.'",'.time().',"'.$user.'")');

            query('UPDATE users SET last_login = '.time().' WHERE id='.$_SESSION['user']['id'].'');

            header('Location: main.php');
        } else {
            echo 'Wrong username or password';
        }
    }
}