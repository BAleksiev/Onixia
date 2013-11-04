<?php

if(sizeof($_SESSION['errorMsg']) > 0) {
    $app->data['errors'] = $_SESSION['errorMsg'];
    unset($_SESSION['errorMsg']);
}

$app->act[] = 'header';
$app->act[] = 'leftNav';
if($app->action == 'messages' && $type) {
    if($type == 'personal' || $type == 'alliance' || $type == 'spy' || $type == 'millitary' || $type == 'flights' || $type == 'sent')
        $app->act[] = 'messages_view';
} else
    $app->act[] = $app->action;
$app->act[] = 'system_messages_popup';
if($app->action == 'alliance' || $app->action == 'galaxy')
    $app->act[] = 'player_info_panel';
$app->act[] = 'footer';

loadDwoo($app->act, $app->data);