<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div id="content">
    <div class="page ranking">
        <table border="0" class="fixed">
            <thead>
                <tr class="head">
                    <td class="cell20"></td>
                    <td class="player"><?php echo translate('Player');?></td>
                    <td class="cell20"><?php echo translate('Race');?></td>
                    <td width="15%"><?php echo translate('War points');?></td>
                    <td width="20%"><?php echo translate('Resource points');?></td>
                    <td width="15%"><?php echo translate('Points');?></td>
                </tr>
            </thead>
            <tbody>
                <?php echo $this->assignInScope(0, 'n');?>

                <?php 
$_fh0_data = (isset($this->scope["ranking"]) ? $this->scope["ranking"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['r'])
	{
/* -- foreach start output */
?>
                <?php echo $this->assignInScope(((isset($this->scope["n"]) ? $this->scope["n"] : null) + 1), 'n');?>

                <tr class="<?php if ((isset($this->scope["r"]["race"]) ? $this->scope["r"]["race"]:null) == 1) {
?>conf<?php 
}
else {
?>orion<?php 
}?>">
                    <td class="id"><?php echo $this->scope["n"];?></td>
                    <td class="player <?php if ((isset($this->scope["user"]["id"]) ? $this->scope["user"]["id"]:null) == (isset($this->scope["r"]["id"]) ? $this->scope["r"]["id"]:null)) {
?>active<?php 
}?>"><?php echo $this->scope["r"]["user"];?></td>
                    <td class="active"><?php echo $this->scope["r"]["race"];?></td>
                    <td><?php echo $this->scope["r"]["war_points"];?></td>
                    <td><?php echo $this->scope["r"]["points"];?></td>
                    <td class="active"><?php echo ($this->scope["r"]["points"] + (isset($this->scope["r"]["war_points"]) ? $this->scope["r"]["war_points"]:null));?></td>
                </tr>
                <?php 
/* -- foreach end output */
	}
}?>

            </tbody>
        </table>   
    </div>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>