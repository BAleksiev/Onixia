<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <script>
                function calc(cargo) {
                    metal=document.getElementsByName("metal")[0].value*1;
                    crystal=document.getElementsByName("crystal")[0].value*1;
                    gas=document.getElementsByName("gas")[0].value*1;
                    diff=cargo-(metal+crystal+gas);
                    document.getElementById("right").innerHTML= diff;
                }
            </script>
            <div class="page">
                <div class="spy-list">
                    <div class="spy-list-title"></div>
                    <?php 
$_fh0_data = (isset($this->scope["spy"]) ? $this->scope["spy"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['s'])
	{
/* -- foreach start output */
?>
                    <div class="spy-list-line">
                        <?php echo $this->scope["s"]["user"];?> - [<?php echo $this->scope["s"]["c1"];?>:<?php echo $this->scope["s"]["c2"];?>:<?php echo $this->scope["s"]["c3"];?>] - 
                        <a href="spy.php?id=<?php echo $this->scope["s"]["id"];?>&act=spy">spy</a> | 
                        <a href="spy.php?id=<?php echo $this->scope["s"]["id"];?>&act=back">back</a>
                    </div>
                    <?php 
/* -- foreach end output */
	}
}?>

                </div>
                <table border="0">
                    <thead>
                        <tr class="head">
                            <td width="50"><?php echo translate('From');?></td>
                            <td width="50"><?php echo translate('To');?></td>
                            <td width="100"><?php echo translate('Arrives');?></td>
                            <td width="100"><?php echo translate('Back');?></td>
                            <td width="70"><?php echo translate('Mission');?></td>
                            <td width="50"><?php echo translate('Command');?></td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ((isset($this->scope["flights"]) ? $this->scope["flights"] : null)) {
?>
                    <?php 
$_fh1_data = (isset($this->scope["flights"]) ? $this->scope["flights"] : null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['f'])
	{
/* -- foreach start output */
?>
                        <tr>
                            <td><?php echo $this->scope["f"]["tc1"];?>:<?php echo $this->scope["f"]["tc2"];?>:<?php echo $this->scope["f"]["tc3"];?></td>
                            <td><?php echo $this->scope["f"]["c1"];?>:<?php echo $this->scope["f"]["c2"];?>:<?php echo $this->scope["f"]["c3"];?></td>
                            <td><?php if ((isset($this->scope["f"]["status"]) ? $this->scope["f"]["status"]:null) == 'go') {

echo date("H:i:s d-m-Y", (isset($this->scope["f"]["time_end"]) ? $this->scope["f"]["time_end"]:null));

}?></td>
                            <td><?php if ('f.status' == 'go') {

echo date("H:i:s d-m-Y", (isset($this->scope["f"]["time_back"]) ? $this->scope["f"]["time_back"]:null));

}
else {

echo date("H:i:s d-m-Y", (isset($this->scope["f"]["time_end"]) ? $this->scope["f"]["time_end"]:null));

}?></td>
                            <td><?php echo $this->scope["f"]["type"];?></td>
                            <?php if ((isset($this->scope["f"]["status"]) ? $this->scope["f"]["status"]:null) == 'go') {
?><td><a href="fleets.php?act=back&id=<?php echo $this->scope["f"]["id"];?>"><?php echo translate('Back');?></a></td>
                            <?php 
}
else {
?><td>-</td><?php 
}?>

                        </tr>
                    <?php 
/* -- foreach end output */
	}
}?>

                    <?php 
}?>

                    </tbody>
                </table>
                <form action="flight.php" method="post">
                <?php 
$_fh2_data = (isset($this->scope["shipsC"]) ? $this->scope["shipsC"] : null);
if ($this->isArray($_fh2_data) === true)
{
	foreach ($_fh2_data as $this->scope['s'])
	{
/* -- foreach start output */
?>
                    <?php echo translate($this->readVar("ships.".(isset($this->scope["s"]["id"]) ? $this->scope["s"]["id"]:null).".name"));?> :
                    <input type="text" name="<?php echo $this->scope["s"]["id"];?>" value="0" size="5" class="<?php echo $this->scope["s"]["id"];?>"/>
                    <a href=javascript:setMaximum("<?php echo $this->scope["s"]["id"];?>",<?php echo $this->scope["s"]["num"];?>)><?php echo $this->scope["s"]["num"];?></a>
                    <br/>
                <?php 
/* -- foreach end output */
	}
}?>

                    <?php echo translate('Mission');?>:
                    <select name="flightType" class="mission" onchange="javascript: mission(<?php echo sizeof((isset($this->scope["ships"]) ? $this->scope["ships"] : null));?>)">
                        <option value=""><?php echo translate('Select');?>:</option>
                        <option value="attack"><?php echo translate('Attack');?></option>
                        <option value="spy"><?php echo translate('Spy');?></option>
                        <option value="transport"><?php echo translate('Transport');?></option>
                        <option value="astro"><?php echo translate('Astroplatation');?></option>
                        <option value="colonise"><?php echo translate('Colonise');?></option>
                        <option value="stationing"><?php echo translate('Stationing');?></option>
                        <option value="recycle"><?php echo translate('Recycle');?></option>
                    </select><br/>
                    <div class="missionFeatures">
                        <?php echo translate('Coordinats');?>:
                        <input type="text" name="c1" size="3" value="<?php echo $this->scope["cookies"]["c1"];?>" /> :
                        <input type="text" name="c2" size="3" value="<?php echo $this->scope["cookies"]["c2"];?>" /> :
                        <input type="text" name="c3" size="3" value="<?php echo $this->scope["cookies"]["c3"];?>" /><br/>
                        <?php echo translate('Speed');?>:
                        <select name="speed">
                        <?php 
$_for0_from = 10;
$_for0_to = 1;
$_for0_step = abs(1);
if (is_numeric($_for0_from) && !is_numeric($_for0_to)) { $this->triggerError('For requires the <em>to</em> parameter when using a numerical <em>from</em>'); }
$tmp_shows = $this->isArray($_for0_from, true) || (is_numeric($_for0_from) && (abs(($_for0_from - $_for0_to)/$_for0_step) !== 0 || $_for0_from == $_for0_to));
if ($tmp_shows)
{
	if ($this->isArray($_for0_from, true)) {
		$_for0_to = is_numeric($_for0_to) ? $_for0_to - $_for0_step : count($_for0_from) - 1;
		$_for0_from = 0;
	}
	for ($this->scope['i'] = $_for0_from; $this->scope['i'] >= $_for0_to; $this->scope['i'] -= $_for0_step)
	{
/* -- for start output */
?>
                            <option name="<?php echo $this->scope["i"];?>0"><?php echo $this->scope["i"];?>0%</option>
                        <?php /* -- for end output */
	}
}
?>

                        </select><br/>
                        <?php echo translate('Cargo');?>: <?php echo $cargo ?><br/>
                        Носейки: <div class="right"></div>
                        Метал: <input type="text" name="metal" value="0" onChange="calc(<?php echo $cargo; ?>)"/><a href=javascript:setMaximum("metal",<?php echo floor((isset($this->scope["planet"]["metal"]) ? $this->scope["planet"]["metal"]:null));?>)><?php echo number_format((isset($this->scope["planet"]["metal"]) ? $this->scope["planet"]["metal"]:null), 0, '.', ' ');?></a><br/>
                        Кристал: <input type="text" name="crystal" value="0" onChange="calc(<?php echo $cargo; ?>)"/><a href=javascript:setMaximum("crystal",<?php echo floor((isset($this->scope["planet"]["crystal"]) ? $this->scope["planet"]["crystal"]:null));?>)><?php echo number_format((isset($this->scope["planet"]["crystal"]) ? $this->scope["planet"]["crystal"]:null), 0, '.', ' ');?></a><br/>
                        Газ: <input type="text" name="gas" value="0" onChange="calc(<?php echo $cargo; ?>)"/><a href=javascript:setMaximum("gas",<?php echo floor((isset($this->scope["planet"]["gas"]) ? $this->scope["planet"]["gas"]:null));?>)><?php echo number_format((isset($this->scope["planet"]["gas"]) ? $this->scope["planet"]["gas"]:null), 0, '.', ' ');?></a><br/>
                        <input type="hidden" name="submitFlight" value="1"/>
                        <input class="submit" type="submit" value="GO"/>
                    </div>
                </form>
            </div>
        </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>