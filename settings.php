<?php
include 'head.php';

if($_POST) {
    if($_POST['changeAvatar'] == 1) {
        $format = substr($_FILES['avatar']['type'], 6);
        $imgName = $user['user'] . '.png';
        $dir = 'users/' . $user['id'] . '/';
        move_uploaded_file($_FILES['avatar']['tmp_name'], $dir . $imgName);
        imgRewidth($format, $dir . $imgName, 132);
        imgReheight($format, $dir . $imgName, 174);
        header('Location: settings.php');
        
    } else if($_POST['changeGsm'] == 1) {
        $gsm = trim($_POST['gsm']);
        if(substr($gsm,0,4) != '+359')
            $_SESSION['errorMsg'][] = translate('Invalid code');
        else if(strlen($gsm) != 13)
            $_SESSION['errorMsg'][] = translate('Invalid number');
        else {
            query('UPDATE users SET gsm = "'.$gsm.'" WHERE id = '.$user['id'].'');
            $_SESSION['user']['gsm'] = $gsm;
            header('Location: settings.php');
        }
    } else if($_POST['changePassword'] == 1) {
        $oldPassword = trim($_POST['oldPassword']);
        $newPassword = trim($_POST['newPassword']);
        if($oldPassword == $user['pass']) {
            query('UPDATE users SET pass = "'.$newPassword.'" WHERE id = '.$user['id'].'');
            $_SESSION['user']['pass'] = $newPassword;
            header('Location: settings.php');
        } else
            $_SESSION['errorMsg'][] = translate('Wrong password !');
        
    } else if($_POST['changeEmail'] == 1) {
        $oldEmail = trim($_POST['oldEmail']);
        $newEmail = trim($_POST['newEmail']);
        $password = trim($_POST['password']);
        if($oldEmail == $user['email']) {
            if($password == $user['pass']) {
                query('UPDATE users SET email = "'.$newEmail.'" WHERE id = '.$user['id'].'');
                $_SESSION['user']['email'] = $newEmail;
                header('Location: settings.php');
            } else 
                $_SESSION['errorMsg'][] = translate('Wrong password !');
        } else
            $_SESSION['errorMsg'][] = translate('Wrong email !');
        
    } else if($_POST['changeUsername'] == 1) {
        $newUsername = trim($_POST['newUsername']);
        $password = trim($_POST['password']);
        if($user['credits'] >= 100) {
            if($password == $user['pass']) {
                if(strlen($newUsername) <= 15) {
                    query('UPDATE users SET user = "'.$newUsername.'", credits = '.$user['credits'].' 
                        WHERE id = '.$user['id'].'');
                    $_SESSION['user']['credits'] -= 100;
                    $_SESSION['user']['user'] = $newUsername;
                    header('Location: settings.php');
                } else
                    $_SESSION['errorMsg'][] = translate('Invalid username.');
            } else 
                $_SESSION['errorMsg'][] = translate('Wrong password !');
        } else
            $_SESSION['errorMsg'][] = translate('Do not have enough credits');
        
    } else if($_POST['changePlanetname'] == 1) {
        $planet = $_POST['planets'];
        $newName = trim($_POST['newPlanetname']);
        if(strlen($newName) <= 15) {
            query('UPDATE planets SET name = "'.$newName.'" WHERE id = '.$planet.'');
            $_SESSION['planets'][$planet]['name'] = $newName;
            header('Location: settings.php');
        } else 
            $_SESSION['errorMsg'][] = translate('The name is too long.');
        
    } else if($_POST['language'] == 1) {
        $lang = $_POST['lang'];
        if($lang != $user['lang']) {
            $_SESSION['user']['lang'] = $lang;
            mysql_q('UPDATE users SET lang = "'.$lang.'" WHERE id = '.$user['id'].'');
            header('Location: settings.php');
        }
    }
}

$langs = fetchAll(query('SELECT * FROM langs'));
foreach($langs as $l) {
    $languages[$l['code']] = $l;
}

$app->data['languages'] = $languages;
$app->data['user']['id'] = $_SESSION['user']['id'];
$app->data['user']['user'] = $_SESSION['user']['user'];

include 'dwoo_view.php';