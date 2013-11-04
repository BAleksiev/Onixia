<?php
/* template head */
if (function_exists('Dwoo_Plugin_include')===false)
	$this->getLoader()->loadPlugin('include');
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page">
                <h2 class="title"><?php echo translate(ucfirst((isset($this->scope["subaction"]) ? $this->scope["subaction"] : null)));?> <?php echo translate('messages');?></h2>
                <?php if ((isset($this->scope["messages"]) ? $this->scope["messages"] : null)) {
?>
                <?php if ((isset($this->scope["pages"]) ? $this->scope["pages"] : null) > 1) {
?>
                <div class="paging_nav">
                    <a class="prev_page <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) == 1) {
?>prev-no-link<?php 
}?>" <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) > 1) {
?>href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo ($this->scope["page"] - 1);?>"<?php 
}?>></a>
                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) > 3) {
?><a class="page_button" <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) != 1) {
?>href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=1"<?php 
}?>><span>1</span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) > 4) {
?>...<?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)-2 > 0) {
?><a class="page_button" href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo $this->scope["page"]-2;?>"><span><?php echo $this->scope["page"]-2;?></span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)-1 > 0) {
?><a class="page_button" href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo $this->scope["page"]-1;?>"><span><?php echo $this->scope["page"]-1;?></span></a><?php 
}?>

                    
                    <a class="page_button active" ><span><?php echo $this->scope["page"];?></span></a>
                    
                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)+1 <= (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?><a class="page_button" href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo $this->scope["page"]+1;?>"><span><?php echo $this->scope["page"]+1;?></span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)+2 <= (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?><a class="page_button" href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo $this->scope["page"]+2;?>"><span><?php echo $this->scope["page"]+2;?></span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) < (isset($this->scope["pages"]) ? $this->scope["pages"] : null)-3) {
?>...<?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) <= (isset($this->scope["pages"]) ? $this->scope["pages"] : null)-3) {
?><a class="page_button" href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo $this->scope["pages"];?>"><span><?php echo $this->scope["pages"];?></span></a><?php 
}?>

                    <a class="next_page <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) == (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?>next-no-link<?php 
}?>" <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) < (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?>href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo ($this->scope["page"] + 1);?>"<?php 
}?>></a>
                </div>
                <?php 
}?>

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
                        <div class="avatar" style="background: url(users/<?php echo $this->scope["m"]["from"];?>/<?php echo $this->scope["m"]["from_name"];?>.png) center center no-repeat;">
                            <div class="avatar-info">
                                <label><?php echo $this->scope["m"]["from_name"];?></label>
                                <?php if ((isset($this->scope["subaction"]) ? $this->scope["subaction"] : null) == 'sent') {
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
                                <span class="time"><?php echo date('d-m-Y H:i:s', (isset($this->scope["m"]["time_send"]) ? $this->scope["m"]["time_send"]:null));?></span>
                                <?php if ((isset($this->scope["m"]["new"]) ? $this->scope["m"]["new"]:null) == true) {
?><span class="new"><?php echo translate('New message');?></span><?php 
}?>

                                <?php if ((isset($this->scope["subaction"]) ? $this->scope["subaction"] : null) != 'sent') {
?>
                                <a class="delete link" href="messages.php?type=<?php echo $this->scope["m"]["type"];?>&act=delete&id=<?php echo $this->scope["m"]["id"];?>"><?php echo translate('Delete');?></a>
                                <?php 
}?>

                                <?php if ((isset($this->scope["subaction"]) ? $this->scope["subaction"] : null) == 'personal') {
?><a class="replay link" id="<?php echo $this->scope["m"]["from_name"];?>" rel="#message_panel"><?php echo translate('Replay');?></a><?php 
}?>

                            </div>
                            <div class="msg">
                                <?php echo $this->scope["m"]["content"];?>

                            </div>
                            <div class="options">
                                <?php if ((isset($this->scope["subaction"]) ? $this->scope["subaction"] : null) != 'sent') {
?>
                                <input class="checkbox" id="<?php echo $this->scope["m"]["id"];?>" type="checkbox" value="<?php echo $this->scope["m"]["id"];?>" name="selected[]"/>
                                <label for="<?php echo $this->scope["m"]["id"];?>"><?php echo translate('Select this message');?></label>
                                <?php echo $this->assignInScope('Are you sure you want to report this message as abuse?', 'msg_report');?>

                                <?php echo $this->assignInScope('Are you sure you want to report this message as abuse?', 'msg_ignore');?>

                                <?php if ((isset($this->scope["subaction"]) ? $this->scope["subaction"] : null) == 'personal') {
?>
                                <a class="report link" onclick="show_confirm('<?php echo translate((isset($this->scope["msg_report"]) ? $this->scope["msg_report"] : null));?>','messages.php?type=personal&act=report&id=<?php echo $this->scope["m"]["id"];?>')"><?php echo translate('Report');?></a>
                                <a class="ignore link" onclick="show_confirm('<?php echo translate((isset($this->scope["msg_ignore"]) ? $this->scope["msg_ignore"] : null));?>','messages.php?type=personal&act=ignore&id=<?php echo $this->scope["m"]["from"];?>')"><?php echo translate('Ignore');?></a>
                                <?php 
}?>

                                <?php 
}?>

                            </div>
                        </div>
                    </div>
                    <div class="separator" style="float: left;"></div>
                    <?php 
/* -- foreach end output */
	}
}?>

                    <?php if ((isset($this->scope["subaction"]) ? $this->scope["subaction"] : null) != 'sent') {
?>
                    <input type="submit" class="standart-button" value="<?php echo translate('Delete selected');?>" style="margin-right: 40px;"/></a>
                    <a href="messages.php?type=<?php echo $this->scope["subaction"];?>&act=deleteAll" class="standart-button"><label class="link"><?php echo translate('Delete all');?></label></a>
                    <?php 
}?>

                </form>
                <?php if ((isset($this->scope["pages"]) ? $this->scope["pages"] : null) > 1) {
?>
                <div class="paging_nav">
                    <a class="prev_page <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) == 1) {
?>prev-no-link<?php 
}?>" <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) > 1) {
?>href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo ($this->scope["page"] - 1);?>"<?php 
}?>></a>
                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) > 3) {
?><a class="page_button" <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) != 1) {
?>href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=1"<?php 
}?>><span>1</span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) > 4) {
?>...<?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)-2 > 0) {
?><a class="page_button" href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo $this->scope["page"]-2;?>"><span><?php echo $this->scope["page"]-2;?></span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)-1 > 0) {
?><a class="page_button" href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo $this->scope["page"]-1;?>"><span><?php echo $this->scope["page"]-1;?></span></a><?php 
}?>

                    
                    <a class="page_button active" ><span><?php echo $this->scope["page"];?></span></a>
                    
                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)+1 <= (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?><a class="page_button" href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo $this->scope["page"]+1;?>"><span><?php echo $this->scope["page"]+1;?></span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)+2 <= (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?><a class="page_button" href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo $this->scope["page"]+2;?>"><span><?php echo $this->scope["page"]+2;?></span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) < (isset($this->scope["pages"]) ? $this->scope["pages"] : null)-3) {
?>...<?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) <= (isset($this->scope["pages"]) ? $this->scope["pages"] : null)-3) {
?><a class="page_button" href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo $this->scope["pages"];?>"><span><?php echo $this->scope["pages"];?></span></a><?php 
}?>

                    <a class="next_page <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) == (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?>next-no-link<?php 
}?>" <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) < (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?>href="messages.php?type=<?php echo $this->scope["subaction"];?>&page=<?php echo ($this->scope["page"] + 1);?>"<?php 
}?>></a>
                </div>
                <?php 
}?>

                <?php 
}
else {
?>
                <div class="empty"><?php echo translate('You have no messages in this section.');?></div>
                <div class="separator"></div>
                <a href="messages.php" class="standart-button"><label class="link"><?php echo translate('Back');?></label></a>
                <?php 
}?>

            </div>
        </div>
        <?php echo Dwoo_Plugin_include($this, 'views/message_panel.php', null, null, null, '_root', null);?>

        <script>
            $('a.replay').click(function(){
                var username = $(this).attr('id');
                $('input[name=user]').val(username);
            });
        </script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>