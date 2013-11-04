<?php
include 'head.php';

$type = (string)$_GET['type'];
$action = (string)$_GET['act'];
if($_GET['id']) {
    $id = (int)$_GET['id'];
}
if($_GET['page']) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}
if($page > 1) {
    $limit = $pages * 10;
} else {
    $limit = 0;
}
$app->data['subaction'] = $type;

if($type == 'personal' || $type == 'alliance' || $type == 'spy' || $type == 'millitary' || $type == 'flights' || $type == 'sent') {

    if($action == 'deleteAll') {
        unset($_SESSION['messages'][$type]['old']);
        query('UPDATE messages SET state = 0 WHERE `type` = "'.$type.'" AND `to` = '.$_SESSION['user']['id'].'');
    }
    if($action == 'deleteSelected') {
        if($_POST) {
            foreach($_POST['selected'] as $s) {
                $filter .= ' OR id = '.$s;
                unset($_SESSION['messages'][$type]['old'][$s]);
            }
            $filter = substr($filter, 3);
        } else {
            if($id) {
                $filter = ' id = '.$id;
                unset($_SESSION['messages'][$type]['old'][$id]);
            } else {
                header('Location: messages.php?type='.$type);
            }
        }
        query('UPDATE messages SET state = 0 WHERE `type` = "'.$type.'" AND '.$filter);
    }
    if($action == 'delete') {
        if($id) {
            if($_SESSION['messages'][$type]['old'][$id]) {
                unset($_SESSION['messages'][$type]['old'][$id]);

                query('UPDATE messages SET state = 0 WHERE `type` = "'.$type.'" AND id = '.$id.'');
            } else {
                header('Location: messages.php?type='.$type);
            }
        } else {
            header('Location: messages.php?type='.$type);
        }
    }
    if($action == 'report') {
        query('UPDATE messages SET reported = 1 WHERE `type` = "'.$type.'" AND id = '.$id.'');
        $_SESSION['errorMsg'][] = 'Abuse reported.';
    }
    if($action == 'ignore') {
        if($id) {
            $_SESSION['user']['ignores'][$id] = $id;
            query('UPDATE users SET ignores = "'.serialize($_SESSION['user']['ignores']).'" WHERE id = '.$_SESSION['user']['id'].'');
            $_SESSION['errorMsg'][] = 'Player ignored.';
        } else {
            header('Location: messages.php?type='.$type);
        }
    }

    if($type == 'sent') {
        $app->data['subaction'] = 'sent';
        $messages = fetchAll(query('SELECT m.*, u.user as from_name FROM messages as m INNER JOIN users as u WHERE `type` = "personal" AND `from` = '.$_SESSION['user']['id'].' AND u.id = m.`to` ORDER BY time_send DESC LIMIT '.$limit.', 10'));
        $app->data['messages'] = $messages;
    } else {
        $newMsgs = $_SESSION['messages'][$type]['new'];
        $msgs = $_SESSION['messages'][$type]['old'];
        foreach($newMsgs as $nm) {
            $_SESSION['messages'][$type]['old'][$nm['id']] = $nm;
            $_SESSION['messages'][$type]['old'][$nm['id']]['read'] = 1;
            $msgs[$nm['id']] = $nm;
            $msgs[$nm['id']]['new'] = true;
            $ids .= 'id = '.$nm['id'].' OR ';
        }
        $ids = substr($ids, 0, -4);
        query('UPDATE messages SET `read` = 1 WHERE '.$ids);
        arsort($_SESSION['messages'][$type]['old']);
        arsort($msgs);
        unset($_SESSION['messages'][$type]['new']);

        $n = 0;
        foreach($msgs as $id => $msg) {
            $n++;
            if($n > ($page * 10) - 10 && $n <= $page * 10) {
                $limitedMsgs[$id] = $msg;
            }
            if($n > $page * 10) {
                break;
            }
        }
        
        $pages = ceil(sizeof($msgs) / 10);
        if($page > $pages) {
            $pages = $page;
        }
        
        $app->data['page'] = $page;
        $app->data['pages'] = $pages;
        $app->data['messages'] = $limitedMsgs;
    }
} else {
    $app->data['personalTot'] = sizeof($_SESSION['messages']['personal']['old']) + sizeof($_SESSION['messages']['personal']['new']);
    $app->data['personalNew'] = sizeof($_SESSION['messages']['personal']['new']);
    $app->data['allianceTot'] = sizeof($_SESSION['messages']['alliance']['old']) + sizeof($_SESSION['messages']['alliance']['new']);
    $app->data['allianceNew'] = sizeof($_SESSION['messages']['alliance']['new']);
    $app->data['spyTot'] = sizeof($_SESSION['messages']['spy']['old']) + sizeof($_SESSION['messages']['spy']['new']);
    $app->data['spyNew'] = sizeof($_SESSION['messages']['spy']['new']);
    $app->data['millitaryTot'] = sizeof($_SESSION['messages']['millitary']['old']) + sizeof($_SESSION['messages']['millitary']['new']);
    $app->data['millitaryNew'] = sizeof($_SESSION['messages']['millitary']['new']);
    $app->data['flightsTot'] = sizeof($_SESSION['messages']['flights']['old']) + sizeof($_SESSION['messages']['flights']['new']);
    $app->data['flightsNew'] = sizeof($_SESSION['messages']['flights']['new']);
}

include 'dwoo_view.php';