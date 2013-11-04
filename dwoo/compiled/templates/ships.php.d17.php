<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page">
                <form action="build_ships.php" method="post">
                    <?php echo $this->assignInScope(1, 'n');?>

                    <?php 
$_fh0_data = (isset($this->scope["ships"]) ? $this->scope["ships"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['s'])
	{
/* -- foreach start output */
?>
                    <div class="ship <?php if (((isset($this->scope["n"]) ? $this->scope["n"] : null) % 2) == 0) {
?>ship-last<?php 
}?>">
                        <div class="image">
                            <label><?php echo $this->scope["s"]["name"];?></label>
                        </div>
                        <div class="info">
                            <div class="line">
                                <div class="title"><?php echo translate('Metal');?> :</div>
                                <lable class="value <?php if ($this->readVar("error.".(isset($this->scope["s"]["name"]) ? $this->scope["s"]["name"]:null).".id") == 1) {
?>err<?php 
}?>"><?php echo number_format((isset($this->scope["s"]["metal"]) ? $this->scope["s"]["metal"]:null), 0, '.', ' ');?></lable>
                            </div>
                            <div class="line">
                                <div class="title"><?php echo translate('Crystal');?> :</div>
                                <lable class="value <?php if ($this->readVar("error.".(isset($this->scope["s"]["name"]) ? $this->scope["s"]["name"]:null).".id") == 2) {
?>err<?php 
}?>"><?php echo number_format((isset($this->scope["s"]["crystal"]) ? $this->scope["s"]["crystal"]:null), 0, '.', ' ');?></lable>
                            </div>
                            <div class="line">
                                <div class="title"><?php echo translate('Gas');?> :</div>
                                <lable class="value <?php if ($this->readVar("error.".(isset($this->scope["s"]["name"]) ? $this->scope["s"]["name"]:null).".id") == 3) {
?>err<?php 
}?>"><?php echo number_format((isset($this->scope["s"]["gas"]) ? $this->scope["s"]["gas"]:null), 0, '.', ' ');?></lable>
                            </div>
                            <div class="line">
                                <div class="title"><?php echo translate('Time need');?>:</div>
                                <lable class="value"><?php echo timeConvert((isset($this->scope["s"]["time_need"]) ? $this->scope["s"]["time_need"]:null));?></lable>
                            </div>
                            <div class="line">
                                <div class="title"><?php echo translate('Available');?>:</div>
                                <div class="value"><?php if ($this->readVar("avShips.".(isset($this->scope["s"]["id"]) ? $this->scope["s"]["id"]:null).".num")) {

echo $this->readVar("avShips.".(isset($this->scope["s"]["id"]) ? $this->scope["s"]["id"]:null).".num");

}
else {
?>0<?php 
}?></div>
                            </div>
                            <div class="line" style="background: none;">
                            <?php if ((isset($this->scope["sView"]) ? $this->scope["sView"] : null) == true) {
?>
                                <div class="title"><?php echo translate('Build');?>:</div>
                                <input type="text" name="<?php echo $this->scope["s"]["id"];?>" value="0" size="3"/> <a href=javascript:setMaximum("<?php echo $this->scope["s"]["id"];?>",<?php echo floor($this->readVar("maxNum.".(isset($this->scope["s"]["name"]) ? $this->scope["s"]["name"]:null)));?>)><?php echo floor($this->readVar("maxNum.".(isset($this->scope["s"]["name"]) ? $this->scope["s"]["name"]:null)));?></a>
                            <?php 
}
else {
?>
                                <div class="title"><label class="err"><?php echo translate($this->readVar("error.".(isset($this->scope["s"]["name"]) ? $this->scope["s"]["name"]:null).".msg"));?></label></div>
                            <?php 
}?>

                            </div>
                        </div>
                    </div>
                    <?php if (((isset($this->scope["n"]) ? $this->scope["n"] : null) % 2) == 0) {
?><div class="separator" style="float: left;"></div><?php 
}?>

                    <?php echo $this->assignInScope(((isset($this->scope["n"]) ? $this->scope["n"] : null) + 1), 'n');?>

                    <?php 
/* -- foreach end output */
	}
}?>

                    <?php if (((isset($this->scope["n"]) ? $this->scope["n"] : null) % 2) == 0) {
?><div class="separator" style="float: left;"></div><?php 
}?>

                    <input type="hidden" name="submit" value="1"/>
                    <input class="submit ships" type="submit" value="<?php echo translate('build');?>"/>
                </form>
            </div>
        </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>