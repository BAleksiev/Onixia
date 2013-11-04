<?php
/* template head */
if (function_exists('Dwoo_Plugin_include')===false)
	$this->getLoader()->loadPlugin('include');
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page">
                <h2 class="title"><?php echo translate('Messages');?></h2>
                <a href="messages.php?type=personal">
                    <div class="message">
                        <?php echo translate('Personal mesages');?>

                        <div class="logo personal"></div>
                        <label class="link"><?php echo $this->scope["personalNew"];?> / <?php echo $this->scope["personalTot"];?></label>
                    </div>
                </a>
                <a href="messages.php?type=alliance">
                    <div class="message">
                        <?php echo translate('Alliances');?>

                        <div class="logo alliance"></div>
                        <label class="link"><?php echo $this->scope["allianceNew"];?> / <?php echo $this->scope["allianceTot"];?></label>
                    </div>
                </a>
                <a href="messages.php?type=spy">
                    <div class="message">
                        <?php echo translate('Spy reports');?>

                        <div class="logo spy"></div>
                        <label class="link"><?php echo $this->scope["spyNew"];?> / <?php echo $this->scope["spyTot"];?></label>
                    </div>
                </a>
                <a href="messages.php?type=millitary">
                    <div class="message">
                        <?php echo translate('Millitary reports');?>

                        <div class="logo millitary"></div>
                        <label class="link"><?php echo $this->scope["millitaryNew"];?> / <?php echo $this->scope["millitaryTot"];?></label>
                    </div>
                </a>
                <a href="messages.php?type=flights">
                    <div class="message">
                        <?php echo translate('Landing zone');?>

                        <div class="logo flights"></div>
                        <label class="link"><?php echo $this->scope["flightsNew"];?> / <?php echo $this->scope["flightsTot"];?></label>
                    </div>
                </a>
                <a class="standart-button" rel="#message_panel"><?php echo translate('Send message');?></a>
            </div>
        </div>
        <?php echo Dwoo_Plugin_include($this, 'views/message_panel.php', null, null, null, '_root', null);
 /* end template body */
return $this->buffer . ob_get_clean();
?>