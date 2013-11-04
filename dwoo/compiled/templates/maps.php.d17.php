<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page">
                <div class="coordinats">
                    <form action="maps.php" method="get">
                        <a href="maps.php?c1=<?php echo ($this->scope["c1"] - 1);?>&c2=<?php echo $this->scope["c2"];?>&c3=<?php echo $this->scope["c3"];?>"><div class="back_button"><</div></a>
                        <input type="text" name="c1" size="2" value="<?php echo $this->scope["c1"];?>"/>
                        <a href="maps.php?c1=<?php echo ($this->scope["c1"] + 1);?>&c2=<?php echo $this->scope["c2"];?>&c3=<?php echo $this->scope["c3"];?>"><div class="next_button">></div></a>
                        <label> : </label>
                        <a href="maps.php?c1=<?php echo $this->scope["c1"];?>&c2=<?php echo ($this->scope["c2"] - 1);?>&c3=<?php echo $this->scope["c3"];?>"><div class="back_button"><</div></a>
                        <input type="text" name="c2" size="2" value="<?php echo $this->scope["c2"];?>"/>
                        <a href="maps.php?c1=<?php echo $this->scope["c1"];?>&c2=<?php echo ($this->scope["c2"] + 1);?>&c3=<?php echo $this->scope["c3"];?>"><div class="next_button">></div></a>
                        <input class="submit" type="submit" value="<?php echo translate('Show');?>"/>
                    </form>
                </div>
                <div class="planets">
                    <table border="0" cellspacing="1">
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
                            <?php if ($this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".c3") == (isset($this->scope["i"]) ? $this->scope["i"] : null)) {
?>
                            <tr>
                                <td class="id"><?php echo $this->scope["i"];?></td>
                                <td class="active"><?php echo $this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".name");?> / <label><?php echo $this->readVar("planetsView.".(isset($this->scope["i"]) ? $this->scope["i"] : null).".owner");?></label></td>
                            </tr>
                            <?php 
}
else {
?>
                            <tr>
                                <td class="id"><?php echo $this->scope["i"];?></td>
                                <td> </td>
                            </tr><?php 
}?>

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
        </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>