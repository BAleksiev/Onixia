<?php
include 'head.php';

if($_POST) {
    $playerName = trim($_POST['user']);
    $to = fetch(query('SELECT id, ignores FROM users WHERE user = "'.$playerName.'"'));
    $to['ignores'] = unserialize($to['ignores']);
    if($to) {
        if(!$to['ignores'][$_SESSION['user']['id']]) {
            if($to['id'] != $_SESSION['user']['id']) {
                $msg = trim($_POST['content']);
                Messages::sendMessage('personal', $to['id'], $msg);
            } else {
                $_SESSION['errorMsg'][] = 'ne moje da pra6tate saob6tenie na sebe si !';
            }
        } else {
            $_SESSION['errorMsg'][] = 'Tozi potrebitel vi e blokiral i ne mojete da izpra6tate saob6teniq do nego.';
        }
    } else {
        $_SESSION['errorMsg'][] = translate('Not found player').' '.$playerName;
    }
    
    if($id) {
    }
}
if($_GET)
    redirect('messages.php'.$app->url_params);
else
    redirect('messages.php');