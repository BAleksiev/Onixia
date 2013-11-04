<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page">
                <?php echo $this->assignInScope(sizeof((isset($this->scope["buildings"]) ? $this->scope["buildings"] : null)), 'total_lines');?>

                <?php echo $this->assignInScope(0, 'lines');?>

                
                <?php 
$_fh0_data = (isset($this->scope["buildings"]) ? $this->scope["buildings"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['b'])
	{
/* -- foreach start output */
?>
                    <?php echo $this->assignInScope(((isset($this->scope["lines"]) ? $this->scope["lines"] : null) + 1), 'lines');?>

<!--                    <div class="item <?php if ($this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null))) {
?>unav<?php 
}?>">-->
                <div class="item">
                    <div class="title">
                        <?php echo translate((isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null));?>

                    </div>
                    <div class="resources">
                        <div class="res">
                            <div class="logo metal"></div>
                            <label class="<?php if ($this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 1) {
?>err<?php 
}?>"><?php echo $this->readVar("Bprices.".(isset($this->scope["b"]["id"]) ? $this->scope["b"]["id"]:null).".".($this->readVar("builds.".(isset($this->scope["b"]["id"]) ? $this->scope["b"]["id"]:null)) + 1).".metal");?></label>
                        </div>
                        <div class="res">
                            <div class="logo crystal"></div>
                            <label class="<?php if ($this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 2) {
?>err<?php 
}?>"><?php echo $this->readVar("Bprices.".(isset($this->scope["b"]["id"]) ? $this->scope["b"]["id"]:null).".".($this->readVar("builds.".(isset($this->scope["b"]["id"]) ? $this->scope["b"]["id"]:null)) + 1).".crystal");?></label>
                        </div>
                        <div class="res">
                            <div class="logo gas"></div>
                            <label class="<?php if ($this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 3) {
?>err<?php 
}?>"><?php echo $this->readVar("Bprices.".(isset($this->scope["b"]["id"]) ? $this->scope["b"]["id"]:null).".".($this->readVar("builds.".(isset($this->scope["b"]["id"]) ? $this->scope["b"]["id"]:null)) + 1).".gas");?></label>
                        </div>
                        <div class="res">
                            <div class="logo energy"></div>
                            <?php if ((isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null) == "solar_panels") {
?><label>0</label>
                            <?php 
}
else {
?><label class="<?php if ($this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 4) {
?>err<?php 
}?>"><?php echo $this->readVar("Bprices.".(isset($this->scope["b"]["id"]) ? $this->scope["b"]["id"]:null).".".($this->readVar("builds.".(isset($this->scope["b"]["id"]) ? $this->scope["b"]["id"]:null)) + 1).".energy")-$this->readVar("Bprices.".(isset($this->scope["b"]["id"]) ? $this->scope["b"]["id"]:null).".".$this->readVar("builds.".(isset($this->scope["b"]["id"]) ? $this->scope["b"]["id"]:null)).".energy");?></label><?php 
}?>

                        </div>
                        <div class="res">
                            <div class="logo level"></div>
                            <label><?php echo $this->readVar("builds.".(isset($this->scope["b"]["id"]) ? $this->scope["b"]["id"]:null));?></label>
                        </div>
                    </div>
                    <div class="image"></div>
                    <div class="opt">
                        <div class="description">
                            <?php echo translate((isset($this->scope["b"]["description"]) ? $this->scope["b"]["description"]:null));?>

                        </div>
                        <div class="time" <?php if ($this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 'this') {
?>id="time"<?php 
}?>>
                            <div class="timer-logo"></div>
                            <?php if ($this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 'this') {
?>
                            <script>
                                pp="<?php echo $this->readVar("timeNeed.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null));?>";
                                timer();
                            </script>
                            <?php 
}
else {
?>
                            <label><?php echo timeConvert($this->readVar("timeNeed.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null)));?></label><?php 
}?>

                        </div>
                        <?php if ($this->readVar("build.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null)) == true) {
?>
                        <a href="build.php?type=building&id=<?php echo $this->scope["b"]["id"];?>">
                            <div class="build">
                                <div class="build-logo"></div>
                                build level <?php echo ($this->readVar("builds.".(isset($this->scope["b"]["id"]) ? $this->scope["b"]["id"]:null)) + 1);?>

                            </div>
                        </a>
                        <?php 
}
else {
?>
                        <?php if ($this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 'this') {
?><a href="build.php?type=building&mode=cancel&id=<?php echo $this->scope["b"]["id"];?>"><?php 
}?>

                        <div class="build">
                            <div class="build-logo"></div>
                            <label class="<?php if ($this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 'this') {
?>link<?php 
}
if ($this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 'req' || $this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 1 || $this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 2 || $this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 3 || $this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 4) {
?>err<?php 
}?>"><?php echo translate($this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".msg"));?></label>
                        </div>
                        <?php if ($this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null).".id") == 'this') {
?></a><?php 
}

}?>

                    </div>
                </div>
                <?php if ((isset($this->scope["lines"]) ? $this->scope["lines"] : null) < (isset($this->scope["total_lines"]) ? $this->scope["total_lines"] : null)) {
?>
                <div class="separator"></div><?php 
}?>

                <?php 
/* -- foreach end output */
	}
}?>

            </div>
        </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>