<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page">
                <?php if ((isset($this->scope["messages"]) ? $this->scope["messages"] : null)) {
?>
                <form action="messages.php?type=<?php echo $this->scope["subaction"];?>&act=deleteSelected" method="post">
                    <?php 
$_fh0_data = (isset($this->scope["messages"]) ? $this->scope["messages"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['m'])
	{
/* -- foreach start output */
?>
                    <div class="msg-panel">
                        <div class="avatar" style="background: url(../users/<?php echo $this->scope["m"]["from"];?>/<?php echo $this->scope["m"]["from_name"];?>.png) center center no-repeat;">
                            <div class="avatar-info">
                                <label><?php echo $this->scope["m"]["from_name"];?></label>
                                <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'sent') {
?><label class="msg-status"><?php if ((isset($this->scope["m"]["read"]) ? $this->scope["m"]["read"]:null) == 0) {

echo translate('Not read');

}
else {

echo translate('Read');

}?></label><?php 
}?>

                            </div>
                        </div>
                        <div class="content">
                            <div class="title">
                                <span></span>
                                <?php echo date('d-m-Y H:i:s', (isset($this->scope["m"]["time_send"]) ? $this->scope["m"]["time_send"]:null));?>

                                <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) != 'sent') {
?>
                                <?php echo $this->assignInScope('Are you sure you want to report this message as abuse?', 'msg');?>

                                <?php if ((isset($this->scope["subaction"]) ? $this->scope["subaction"] : null) == 'personal') {
?>
                                <a class="report link" onclick="show_confirm('<?php echo translate((isset($this->scope["msg"]) ? $this->scope["msg"] : null));?>','messages.php?type=personal&act=report&id=<?php echo $this->scope["m"]["id"];?>')"><?php echo translate('Report');?></a>
                                <?php 
}?>

                                <?php 
}?>

                            </div>
                            <div class="msg">
                                <?php echo $this->scope["m"]["content"];?>

                            </div>
                            <div class="options">
                                <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) != 'sent') {
?>
                                <input class="checkbox" type="checkbox" value="<?php echo $this->scope["m"]["id"];?>" name="selected[]"/>
                                <a class="delete link" href="messages.php?type=<?php echo $this->scope["m"]["type"];?>&act=delete&id=<?php echo $this->scope["m"]["id"];?>"><?php echo translate('Delete');?></a>
                                <?php 
}?>

                                <?php if ((isset($this->scope["subaction"]) ? $this->scope["subaction"] : null) == 'personal') {
?><a class="replay link" rel="#popupWindow"><?php echo translate('Replay');?></a><?php 
}?>

                            </div>
                        </div>
                    </div>
                    <div class="separator" style="float: left;"></div>
                    <?php 
/* -- foreach end output */
	}
}?>

                    <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) != 'sent') {
?>
                    <input type="submit" class="deleteMessages msg-button link" style="margin: 10px 0 0 90px;" value="<?php echo translate('Delete selected');?>" /></a>
                    <a href="messages.php?type=<?php echo $this->scope["subaction"];?>&act=deleteAll"><div class="msg-button" style="margin-left: 50px;"><label class="link"><?php echo translate('Delete all');?></label></div></a>
                    <?php 
}?>

                </form>
                <?php 
}
else {
?>
                <div class="empty"><?php echo translate('You have no messages in this section.');?></div>
                <div class="separator"></div>
                <a href="messages.php"><div class="msg-button" style="margin-left: 200px;"><label class="link"><?php echo translate('Back');?></label></div></a>
                <?php 
}?>

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