<?php
if($_POST['ajax']) {
    session_start();
    if($_POST['ajax'] == 'getRanks') {
        header('Content-type: application/json');

        foreach($_SESSION['ranks'] as $id => $r) {
            $ranks[$id]['id'] = $id;
            $ranks[$id]['rank'] = $r;
        }

        echo json_encode($ranks);
        die;
    } else if($_POST['ajax'] == 'updateRank') {
        
    }
}
include 'head.php';


if($_GET['id']) {
    $id = (int)$_GET['id'];
} else if($_SESSION['user']['alliance'] != 0) {
    $id = $_SESSION['user']['alliance'];
}
if($_GET['act']) {
    $act = (string)$_GET['act'];
}

if($id) {
    $alliance = fetch(query('SELECT * FROM alliances WHERE id = '.$id.' '));
    if($alliance) {
        $alliance['permissions'] = unserialize($alliance['permissions']);
        $perms = fetchAll(query('SELECT * FROM alliance_permissions'));
        foreach($perms as $p) {
            $permissions[$p['id']] = $p['key'];
        }
        
        $rs = fetchAll(query('SELECT * FROM alliance_policies'));
        foreach($rs as $id => $p)
            $policies[$id] = $p;
        
        $politics = fetchAll(query('SELECT p.*, ap.policy as policy_type 
            FROM alliance_politics as p INNER JOIN alliance_policies as ap 
            WHERE (p.alliance1_id = '.$alliance['id'].' OR p.alliance2_id = '.$alliance['id'].') 
                AND ap.id = p.policy ORDER BY p.policy'));
        foreach($politics as $k => $p) {
            if($p['alliance1_id'] != $alliance['id']) {
                $al_ids .= ' OR id = '.$p['alliance1_id'];
                $politics[$k]['alliance_id'] = $p['alliance1_id'];
            } else if($p['alliance2_id'] != $alliance['id']) {
                $al_ids .= ' OR id = '.$p['alliance2_id'];
                $politics[$k]['alliance_id'] = $p['alliance2_id'];
            }
            unset($politics[$k]['alliance1_id']);
            unset($politics[$k]['alliance2_id']);
        }
        $al_ids = substr($al_ids, 4);
        
        $rs = fetchAll(query('SELECT id, name FROM alliances WHERE '.$al_ids));
        foreach($rs as $k => $a) {
            if($a['id'] == $politics[$k]['alliance_id']) {
                $politics[$k]['name'] = $a['name'];
            }
        }
        
        $members = fetchAll(query('SELECT id, user as name, points, war_points, rank, last_login, state 
            FROM users WHERE alliance = '.$id.' ORDER BY rank'));
        
        $app->data['ap_cookie'] = $_COOKIE['admin_panel'];
        
        if($_POST) {
            foreach($permissions as $pid => $p) {
                $newPermissions[1][$pid] = $pid;
            }
            foreach($_POST as $pid => $p) {
                $pid = (int)$pid;
                foreach($p as $r) {
                    $r = (int)$r;
                    $newPermissions[$pid][$r] = $r;
                }
            }
            $alliance['permissions'] = $newPermissions;
            $newPermissions = serialize($newPermissions);
            query('UPDATE alliances SET permissions = "'.$newPermissions.'" WHERE id = '.$alliance['id'].'');
            $_SESSION['errorMsg'][] = 'Permissions has changed successfully.';
        }
        
    } else {
        $_SESSION['errorMsg'][] = 'Saiuzat koito se opitvate da namerite ne sa6testvuva';
        redirect('alliance.php');
    }
    
    $app->data['id'] = $id;
    $app->data['alliance'] = $alliance;
    $app->data['permissions'] = $permissions;
    $app->data['policies'] = $policies;
    $app->data['politics'] = $politics;
    $app->data['members'] = $members;
}

include 'dwoo_view.php';