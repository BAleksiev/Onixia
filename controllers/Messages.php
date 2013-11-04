<?php

class Messages {

    public function sendMessage($type, $to, $msg) {
        if($type == 'personal') {
            query('INSERT INTO messages (type,`read`,`from`,`to`,content,time_send) 
            VALUES("personal",0,'.$_SESSION['user']['id'].','.$to.',"'.$msg.'",'.time().')');
        }
        if($type == 'alliance') {
            query("INSERT INTO messages (type,`from`,`to`,content,time_send) 
            VALUES('".$type."',-1,".$to.",'".$msg."',".time().")");
        }
        if($type == 'spy') {
            query("INSERT INTO messages (type,`from`,`to`,content,time_send) 
            VALUES('".$type."',-2,".$to.",'".$msg."',".time().")");
        }
        if($type == 'millitary') {
            query("INSERT INTO messages (type,`from`,`to`,content,time_send) 
            VALUES('".$type."',-3,".$to.",'".$msg."',".time().")");
        }
        if($type == 'flights') {
            query("INSERT INTO messages (type,`from`,`to`,content,time_send) 
            VALUES('".$type."',-4,".$to.",'".$msg."',".time().")");
        }
    }

    public function getNewMessages() {
        $newMessages = 0;
        foreach($_SESSION['messages'] as $m) {
            $newMessages += sizeof($m['new']);
        }
        return $newMessages;
    }

    public function refreshMessages() {
        $rs = fetchAll(query('SELECT m.*, u.user as from_name, u2.user as to_name FROM messages as m
                                INNER JOIN users as u INNER JOIN users as u2
                                WHERE m.`to` = '.$_SESSION['user']['id'].' AND m.`read` = 0 AND m.type = "personal" AND u.id = m.`from` AND u2.id = m.`to` AND m.state > 0
                                ORDER BY time_send DESC'));
        foreach($rs as $m)
            if($m['type'] == 'personal')
                $_SESSION['messages']['personal']['new'][$m['id']] = $m;

        $rs = fetchAll(query('SELECT * FROM messages
                                WHERE `to` = 1 AND `read` = 0 AND state > 0 AND type != "personal"
                                ORDER BY time_send DESC'));
        foreach($rs as $m) {
            if($m['type'] == 'alliance')
                $_SESSION['messages']['alliance']['new'][$m['id']] = $m;
            if($m['type'] == 'spy')
                $_SESSION['messages']['spy']['new'][$m['id']] = $m;
            if($m['type'] == 'millitary')
                $_SESSION['messages']['millitary']['new'][$m['id']] = $m;
            if($m['type'] == 'flights')
                $_SESSION['messages']['flights']['new'][$m['id']] = $m;
        }
    }

}