<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page">
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
                <a class="link" rel="#popupWindow"><div class="msg-button"><?php echo translate('Send message');?></div></a>
            </div>
        </div>
        <?php include 'templates/popup.php'; ?>
        <script type="text/javascript" src="js/jquery.tools.min.js"></script>
        <script>
            $(function() {
                $("a[rel]").overlay({
                    mask: '#000',
                    effect: 'apple'
                });
            });
        </script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>