<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/general.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.tools.min.js"></script>
        <script type="text/javascript" src="js/general.js"></script>
        <title>Onixia</title>
    </head>
    <body>
        <div id="res-title" style="display: none; position: fixed;">
            <div id="res">
                <div class="user"><a href="logout.php" class="logout"></a>{$user.user}</div>
                <label id="serverTime" class="servertime"></label>
<!--                <div class="cubits logo"><label>{number_format $_SESSION.user.cubits,0,'.',' '}</label></div>-->
                <div class="energy logo"><label>{number_format $energy,0,'.',' ' }</label></div>
                <div class="gas logo"><label>{number_format $planet.gas,0,'.',' '}</label></div>
                <div class="crystal logo"><label>{number_format $planet.crystal,0,'.',' '}</label></div>
                <div class="metal logo"><label>{number_format $planet.metal,0,'.',' '}</label></div>
            </div>
        </div>
        <div id="header">
            <div class="title">
                <div class="user">
                    <a href="logout.php" class="logout"></a>
                    {$user.user}
                </div>
                <label id="servertime" class="servertime"></label>
                <a href="settings.php"><div class="button"><label class="link">{translate 'settings'}</label></div></a>
                <a href="messages.php"><div class="button"><label class="link">{translate 'messages'} {if $newMessages}[{$newMessages}]{/if}</label></div></a>
                <div class="onixia"></div>
            </div>
            <div class="content">
                <div class="res">
<!--                    <div class="res-box metal">
                        
                        <label>{number_format $planet.metal,0,'.',' '}</label>
                    </div>
                    <div class="res-box metal">
                        
                        <label>{number_format $planet.metal,0,'.',' '}</label>
                    </div>
                    <div class="res-box metal">
                        
                        <label>{number_format $planet.metal,0,'.',' '}</label>
                    </div>-->
                    <div class="res-box">
                        <div class="metal logo" title="{translate 'Metal'}"></div>
                        <label>{number_format $planet.metal,0,'.',' '}</label>
                    </div>
                    <div class="res-box">
                        <div class="crystal logo" title="{translate 'Crystal'}"></div>
                        <label>{number_format $planet.crystal,0,'.',' '}</label>
                    </div>
                    <div class="res-box">
                        <div class="gas logo" title="{translate 'Gas'}"></div>
                        <label>{number_format $planet.gas,0,'.',' '}</label>
                    </div>
                    <div class="res-box last">
                        <div class="energy logo" title="{translate 'Energy'}"></div>
                        <label>{number_format $energy,0,'.',' '}</label>
                    </div>
<!--                    <div class="res-box last">
                        <div class="cubits logo" title="{translate 'Cubits'}"></div>
                        <label>{number_format $user.cubits,0,'.',' '}</label>
                    </div>-->
                </div>
                <div class="menu">
                    <a href="statistic.php">
                        <div class="tab">
                            <label class="link">{translate 'Statistic'}</label>
                        </div>
                    </a>
                    <a href="recycles.php">
                        <div class="tab">
                            <label class="link">{translate 'Recycles'}</label>
                        </div>
                    </a>
                    <a href="universe.php">
                        <div class="tab">
                            <label class="link">{translate 'Universe'}</label>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div id="body">