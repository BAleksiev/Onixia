<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="overlay" id="system_messages_popup">
    <div class="smp-header">
        <?php echo translate('System message');?>

    </div>
    <div class="smp-body">
        <?php if ((isset($this->scope["errors"]) ? $this->scope["errors"] : null)) {
?>
        <?php 
$_fh0_data = (isset($this->scope["errors"]) ? $this->scope["errors"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['e'])
	{
/* -- foreach start output */
?>
        <?php echo $this->scope["e"];?><br/>
        <?php 
/* -- foreach end output */
	}
}?>

        <?php 
}?>

    </div>
    <div class="smp-footer">
        <div class="close button"><span><span><?php echo translate('Close');?></span></span></div>
    </div>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>