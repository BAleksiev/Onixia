<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page">
                <?php echo $this->assignInScope(sizeof((isset($this->scope["sciences"]) ? $this->scope["sciences"] : null)), 'total_lines');?>

                <?php echo $this->assignInScope(0, 'lines');?>

                
                <?php 
$_fh0_data = (isset($this->scope["sciences"]) ? $this->scope["sciences"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['sc'])
	{
/* -- foreach start output */
?>
                    <?php echo $this->assignInScope(((isset($this->scope["lines"]) ? $this->scope["lines"] : null) + 1), 'lines');?>

<!--                    <div class="item <?php if ($this->readVar("error.".(isset($this->scope["b"]["name"]) ? $this->scope["b"]["name"]:null))) {
?>unav<?php 
}?>">-->
                <div class="item">
                    <div class="title">
                        <?php echo translate((isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null));?>

                    </div>
                    <div class="resources">
                        <div class="res">
                            <div class="logo metal"></div>
                            <label <?php if ($this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".id") == 1) {
?>class="err"<?php 
}?>><?php echo $this->readVar("Sprices.".(isset($this->scope["sc"]["id"]) ? $this->scope["sc"]["id"]:null).".".($this->readVar("researches.".(isset($this->scope["sc"]["id"]) ? $this->scope["sc"]["id"]:null)) + 1).".metal");?></label>
                        </div>
                        <div class="res">
                            <div class="logo crystal"></div>
                            <label <?php if ($this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".id") == 2) {
?>class="err"<?php 
}?>><?php echo $this->readVar("Sprices.".(isset($this->scope["sc"]["id"]) ? $this->scope["sc"]["id"]:null).".".($this->readVar("researches.".(isset($this->scope["sc"]["id"]) ? $this->scope["sc"]["id"]:null)) + 1).".crystal");?></label>
                        </div>
                        <div class="res">
                            <div class="logo gas"></div>
                            <label <?php if ($this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".id") == 3) {
?>class="err"<?php 
}?>><?php echo $this->readVar("Sprices.".(isset($this->scope["sc"]["id"]) ? $this->scope["sc"]["id"]:null).".".($this->readVar("researches.".(isset($this->scope["sc"]["id"]) ? $this->scope["sc"]["id"]:null)) + 1).".gas");?></label>
                        </div>
                        <div class="res">
                            <div class="logo energy"></div>
                            <label>0</label>
                        </div>
                        <div class="res">
                            <div class="logo level"></div>
                            <label><?php echo $this->readVar("researches.".(isset($this->scope["sc"]["id"]) ? $this->scope["sc"]["id"]:null));?></label>
                        </div>
                    </div>
                    <div class="image"></div>
                    <div class="opt">
                        <div class="description">
                            <?php echo translate((isset($this->scope["sc"]["description"]) ? $this->scope["sc"]["description"]:null));?>

                        </div>
                        <div class="time" <?php if ($this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".id") == 'this') {
?>id="time"<?php 
}?>>
                            <div class="timer-logo"></div>
                            <?php if ($this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".id") == 'this') {
?>
                            <script>
                                pp="<?php echo $this->readVar("timeNeed.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null));?>";
                                timer();
                            </script>
                            <?php 
}
else {
?>
                            <label><?php echo timeConvert($this->readVar("timeNeed.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null)));?></label><?php 
}?>

                        </div>
                        <?php if ($this->readVar("rView.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null)) == true) {
?>
                        <a href="build.php?type=research&id=<?php echo $this->scope["sc"]["id"];?>">
                            <div class="build">
                                <div class="build-logo"></div>
                                research level <?php echo ($this->readVar("researches.".(isset($this->scope["sc"]["id"]) ? $this->scope["sc"]["id"]:null)) + 1);?>

                            </div>
                        </a>
                        <?php 
}
else {
?>
                        <?php if ($this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".id") == 'this') {
?><a href="build.php?type=research&mode=cancel&id=<?php echo $this->scope["sc"]["id"];?>"><?php 
}?>

                        <div class="build">
                            <div class="build-logo"></div>
                            <label class="<?php if ($this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".id") == 'this') {
?>link<?php 
}
if ($this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".id") == 'req' || $this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".id") == 1 || $this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".id") == 2 || $this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".id") == 3 || $this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".id") == 4) {
?>err<?php 
}?>"><?php echo translate($this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".msg"));?></label>
                        </div>
                        <?php if ($this->readVar("error.".(isset($this->scope["sc"]["name"]) ? $this->scope["sc"]["name"]:null).".id") == 'this') {
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