<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page">
                <h2 class="title"><?php echo translate('Galaxy');?></h2>
                <div class="coordinats">
                    <form action="galaxy.php" method="get">
                        <a href="galaxy.php?c1=<?php echo ($this->scope["c1"] - 1);?>&c2=<?php echo $this->scope["c2"];?>"><div class="back_button"><</div></a>
                        <input type="text" name="c1" size="2" value="<?php echo $this->scope["c1"];?>"/>
                        <a href="galaxy.php?c1=<?php echo ($this->scope["c1"] + 1);?>&c2=<?php echo $this->scope["c2"];?>"><div class="next_button">></div></a>
                        <label> : </label>
                        <a href="galaxy.php?c1=<?php echo $this->scope["c1"];?>&c2=<?php echo ($this->scope["c2"] - 1);?>"><div class="back_button"><</div></a>
                        <input type="text" name="c2" size="2" value="<?php echo $this->scope["c2"];?>"/>
                        <a href="galaxy.php?c1=<?php echo $this->scope["c1"];?>&c2=<?php echo ($this->scope["c2"] + 1);?>"><div class="next_button">></div></a>
                        <input class="submit" type="submit" value="<?php echo translate('Show');?>"/>
                    </form>
                </div>
                <div class="planets">
                    <table class="galaxy" cellspacing="1">
                        <tbody>
                        <?php 
$_for0_from = 1;
$_for0_to = 10;
$_for0_step = abs(1);
if (is_numeric($_for0_from) && !is_numeric($_for0_to)) { $this->triggerError('For requires the <em>to</em> parameter when using a numerical <em>from</em>'); }
$tmp_shows = $this->isArray($_for0_from, true) || (is_numeric($_for0_from) && (abs(($_for0_from - $_for0_to)/$_for0_step) !== 0 || $_for0_from == $_for0_to));
if ($tmp_shows)
{
	if ($this->isArray($_for0_from, true)) {
		$_for0_to = is_numeric($_for0_to) ? $_for0_to - $_for0_step : count($_for0_from) - 1;
		$_for0_from = 0;
	}
	if ($_for0_from > $_for0_to) {
				$tmp = $_for0_from;
				$_for0_from = $_for0_to;
				$_for0_to = $tmp;
			}
	for ($this->scope['i'] = $_for0_from; $this->scope['i'] <= $_for0_to; $this->scope['i'] += $_for0_step)
	{
/* -- for start output */
?>
                            <tr>
                                <td class="id"><?php echo $this->scope["i"];?></td>
                                <td class="ast-rec">
                                <?php if ((isset($this->scope["asteroids"]) ? $this->scope["asteroids"] : null) || (isset($this->scope["recycles"]) ? $this->scope["recycles"] : null)) {
?>
                                <?php if ((isset($this->scope["recycles"]) ? $this->scope["recycles"] : null)) {
?>
                                <?php 
$_fh0_data = (isset($this->scope["recycles"]) ? $this->scope["recycles"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['r'])
	{
/* -- foreach start output */
?>
                                <?php if ((isset($this->scope["r"]["c3"]) ? $this->scope["r"]["c3"]:null) == (isset($this->scope["i"]) ? $this->scope["i"] : null)) {
?>
                                <label class="link recycle" onclick="saveCoordinates(<?php echo $this->scope["c1"];?>,<?php echo $this->scope["c2"];?>,<?php echo $this->scope["i"];?>)" title="<h2><?php echo translate('Recycle');?></h2><?php echo translate('Metal');?>: <?php echo $this->scope["r"]["metal"];?>, <?php echo translate('Crystal');?>: <?php echo $this->scope["r"]["crystal"];?>, <?php echo translate('Gas');?>: <?php echo $this->scope["r"]["gas"];?>">R</label>
                                <?php 
}

/* -- foreach end output */
	}
}

}?>

                                <?php if ((isset($this->scope["asteroids"]) ? $this->scope["asteroids"] : null)) {
?>
                                <?php 
$_fh1_data = (isset($this->scope["asteroids"]) ? $this->scope["asteroids"] : null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['a'])
	{
/* -- foreach start output */
?>
                                <?php if ((isset($this->scope["a"]["c3"]) ? $this->scope["a"]["c3"]:null) == (isset($this->scope["i"]) ? $this->scope["i"] : null)) {
?>
                                <label class="link asteroid" onclick="saveCoordinates(<?php echo $this->scope["c1"];?>,<?php echo $this->scope["c2"];?>,<?php echo $this->scope["i"];?>)"  title="<h2><?php echo translate('Asteroid');?></h2><b><?php echo translate('Speed');?>:</b> <?php echo timeConvert((isset($this->scope["a"]["speed"]) ? $this->scope["a"]["speed"]:null));?><br/><b><?php echo translate('Next move');?>: </b> <?php echo date('d.m.Y H:i:s', (isset($this->scope["a"]["next_move"]) ? $this->scope["a"]["next_move"]:null));?>">A</label>
                                <?php 
}

/* -- foreach end output */
	}
}

}?>

                                <?php 
}?>

                                </td>
                                <?php if ($this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".c3") == (isset($this->scope["i"]) ? $this->scope["i"] : null)) {
?>
                                <td <?php if ((isset($this->scope["recycles"]) ? $this->scope["recycles"] : null) || (isset($this->scope["asteroids"]) ? $this->scope["asteroids"] : null)) {

if ((isset($this->scope["recycles"]) ? $this->scope["recycles"] : null) && (isset($this->scope["asteroids"]) ? $this->scope["asteroids"] : null)) {
?>colspan="2"<?php 
}
else {
?>colspan="3"<?php 
}

}?> class="active"><?php if ($this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".alliance") != 0) {
?>[ <a href="alliance.php?id=<?php echo $this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".alliance");?>"><?php echo $this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".alliance_name");?></a> ]<?php 
}?> <?php echo $this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".name");?> / <label title="<h2><?php echo $this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".user");?></h2><b><?php echo translate('Points');?>:</b> <?php echo $this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".points");?><br/><b><?php echo translate('Last online');?>:</b> <br/><?php echo date('Y-m-d H:i:s', $this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".last_update"));?><br/><b><?php echo translate('Rank');?>:</b> <?php echo $this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".rank");?>"><?php echo $this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".user");?></label></td>
                                <?php if ($this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".owner") != (isset($this->scope["user"]["id"]) ? $this->scope["user"]["id"]:null)) {
?>
                                <td class="opt"><a href="flight.php?act=fastspy&c1=<?php echo $this->scope["c1"];?>&c2=<?php echo $this->scope["c2"];?>&c3=<?php echo $this->scope["i"];?>"><img src="images/spy-icon.png" title="<h2><?php echo translate('spy');?></h2><?php echo translate('Send a spy probe to this planet.');?>" /></a></td>
                                <td class="opt"><img class="link" onclick="saveCoordinates(<?php echo $this->scope["c1"];?>,<?php echo $this->scope["c2"];?>,<?php echo $this->scope["i"];?>)" src="images/attack-icon.png" title="<h2><?php echo translate('Fast attack');?></h2><?php echo translate('Remembers the coordinates and imputs them in the fleets menu');?>" /></td>
                                <td class="opt"><img class="link" rel="#popupWindow" src="images/msg-icon.png" title="<h2><?php echo translate('Message');?></h2><?php echo translate('Send message to this player.');?>" /></td>
                                <?php 
}?>

                                <?php 
}
else {
?>
                                <td <?php if ((isset($this->scope["recycles"]) ? $this->scope["recycles"] : null) || (isset($this->scope["asteroids"]) ? $this->scope["asteroids"] : null)) {

if ((isset($this->scope["recycles"]) ? $this->scope["recycles"] : null) && (isset($this->scope["asteroids"]) ? $this->scope["asteroids"] : null)) {
?>colspan="2"<?php 
}
else {
?>colspan="3"<?php 
}

}?>></td>
                                <td class="opt"></td>
                                <td class="opt"></td>
                                <td class="opt"></td>
                                <?php 
}?>

                            </tr>
                        <?php /* -- for end output */
	}
}
?>

                        </tbody>
                    </table>
                </div>
<!--                <div class="legend">
                    <table border="0" cellspacing="1">
                        <tbody>
                            <tr>
                                <td class="id" align="center"></td>
                                <td class="desc">opisanie</td>
                            </tr>
                        </tbody>
                    </table>
                </div>-->
            </div>
        </div>
        <?php include 'templates/popup.php'; ?>
        <script type="text/javascript" src="js/jquery.tools.min.js"></script>
        <script>
            $("td label[title], td img[title]").tooltip({
                position: "bottom right"
            });
            
            $(function() {
                $("img[rel]").overlay({
                    mask: '#000',
                    effect: 'apple'
                });
            });
        </script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>