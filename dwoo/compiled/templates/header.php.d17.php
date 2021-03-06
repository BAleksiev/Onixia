<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/general.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/funcs.js"></script>
        <title>Onixia</title>
    </head>
    <body>
        <div id="res-title" style="display: none; position: fixed;">
            <div id="res">
                <div class="user"><a href="logout.php" class="logout"></a><?php echo $user['user'] ?></div>
                <label id="serverTime" class="servertime"></label>
<!--                <div class="cubits logo"><label><?php echo number_format($user['cubits'],0,'.',' '); ?></label></div>-->
                <div class="energy logo"><label><?php echo number_format($res->GetEnergy(),0,'.',' '); ?></label></div>
                <div class="gas logo"><label><?php echo number_format($planet['gas'],0,'.',' '); ?></label></div>
                <div class="crystal logo"><label><?php echo number_format($planet['crystal'],0,'.',' '); ?></label></div>
                <div class="metal logo"><label><?php echo number_format($planet['metal'],0,'.',' '); ?></label></div>
            </div>
        </div>
        <div id="header">
            <div class="title">
                <div class="user">
                    <a href="logout.php" class="logout"></a>
                    <?php echo $user['user'] ?>
                </div>
                <label id="servertime" class="servertime"></label>
                <a href="settings.php"><div class="button"><label class="link"><?php echo translate('settings'); ?></label></div></a>
                <a href="messages.php"><div class="button"><label class="link"><?php echo translate('messages'); if(getNewMessages() > 0) echo ' ['.getNewMessages().']'?></label></div></a>
                <div class="onixia"></div>
            </div>
            <div class="content">
                <div class="res">
<!--                    <div class="res-box metal logo">
                        
                        <label><?php //echo number_format($planet['metal'],0,'.',' '); ?></label>
                    </div>
                    <div class="res-box metal logo">
                        
                        <label><?php //echo number_format($planet['metal'],0,'.',' '); ?></label>
                    </div>
                    <div class="res-box metal logo">
                        
                        <label><?php //echo number_format($planet['metal'],0,'.',' '); ?></label>
                    </div>-->
                    <div class="res-box">
                        <div class="metal logo" title="<?php echo translate('Metal') ?>"></div>
                        <label><?php echo number_format($planet['metal'],0,'.',' '); ?></label>
                    </div>
                    <div class="res-box">
                        <div class="crystal logo" title="<?php echo translate('Crystal') ?>"></div>
                        <label><?php echo number_format($planet['crystal'],0,'.',' '); ?></label>
                    </div>
                    <div class="res-box">
                        <div class="gas logo" title="<?php echo translate('Gas') ?>"></div>
                        <label><?php echo number_format($planet['gas'],0,'.',' '); ?></label>
                    </div>
                    <div class="res-box last">
                        <div class="energy logo" title="<?php echo translate('Energy') ?>"></div>
                        <label><?php echo number_format($res->GetEnergy(),0,'.',' '); ?></label>
                    </div>
<!--                    <div class="res-box last">
                        <div class="cubits logo" title="<?php //echo translate('Cubits') ?>"></div>
                        <label><?php //echo number_format($user['cubits'],0,'.',' '); ?></label>
                    </div>-->
                </div>
                <div class="menu">
                    <a href="statistic.php">
                        <div class="tab">
                            <label class="link"><?php echo translate('Statistic'); ?></label>
                        </div>
                    </a>
                    <a href="recycles.php">
                        <div class="tab">
                            <label class="link"><?php echo translate('Recycles'); ?></label>
                        </div>
                    </a>
                    <a href="universe.php">
                        <div class="tab">
                            <label class="link"><?php echo translate('Universe'); ?></label>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div id="body"><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>