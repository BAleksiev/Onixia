<?php
include 'head.php';

if($_GET['page']) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}
if($page > 1) {
    $limit = $page * 100;
} else {
    $limit = 0;
}

$ranking_list = fetchAll(query('SELECT id, user, points, war_points FROM users ORDER BY points DESC LIMIT '.$limit.', 100'));

$pages = ceil(sizeof($ranking_list) / 100);
if($page > $pages) {
    $pages = $page;
}

$app->data['ranking'] = $ranking_list;
$app->data['page'] = $page;
$app->data['pages'] = $pages;

include 'dwoo_view.php';