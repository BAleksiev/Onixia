<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="leftNav">
            <div class="nav">
                <span class="main"></span>
                <label><?php echo translate('Navigation');?></label>
                <div class="lines">
                    <ul>
                        <li><a href="main.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'main') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Main');?></a></li>
                        <li><a href="buildings.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'buildings') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Buildings');?></a></li>
                        <li><a href="researches.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'researches') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Researches');?></a></li>
                        <li><a href="robots.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'robots') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Robots');?></a></li>
                        <li><a href="ships.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'ships') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Ships');?></a></li>
                        <li><a href="factory.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'factory') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Factory');?></a></li>
                        <li><a href="fleets.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'fleets') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Fleets');?></a></li>
                        <li><a href="galaxy.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'galaxy') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Galaxy');?></a></li>
                        <li><a href="defence.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'defence') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Defence');?></a></li>
                        <li><a href="market.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'market') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Market');?></a></li>
                        <li><a href="bank.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'bank') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Bank');?></a></li>
                        <li><a href="debug.php?back=<?php echo $_SERVER['PHP_SELF']; ?>">Debug</a></li>
                    </ul>
                </div>
                <div class="bottom"></div>
            </div>
            <div class="nav">
                <span class="planets"></span>
                <label><?php echo translate('Planets');?></label>
                <div class="lines">
                    <ul>
                        <?php 
$_fh0_data = (isset($this->scope["planets"]) ? $this->scope["planets"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['p'])
	{
/* -- foreach start output */
?>
                        <li><?php if ((isset($this->scope["planet"]["id"]) ? $this->scope["planet"]["id"]:null) != (isset($this->scope["p"]["id"]) ? $this->scope["p"]["id"]:null)) {
?><a href="changeplanet.php?id=<?php echo $this->scope["p"]["id"];?>&where=<?php echo $this->scope["action"];?>" <?php if ((isset($this->scope["planet"]["id"]) ? $this->scope["planet"]["id"]:null) == (isset($this->scope["p"]["id"]) ? $this->scope["p"]["id"]:null)) {
?>style="color: #fff;"<?php 
}?>><?php 
}
echo $this->scope["p"]["name"];?> [<?php echo $this->scope["p"]["c1"];?>:<?php echo $this->scope["p"]["c2"];?>:<?php echo $this->scope["p"]["c3"];?>]<?php if ((isset($this->scope["planet"]["id"]) ? $this->scope["planet"]["id"]:null) != (isset($this->scope["p"]["id"]) ? $this->scope["p"]["id"]:null)) {
?></a><?php 
}?></li>
                        <?php 
/* -- foreach end output */
	}
}?>

                    </ul>
                </div>
                <div class="bottom"></div>
            </div>
            <div class="nav">
                <span class="information"></span>
                <label><?php echo translate('Information');?></label>
                <div class="lines">
                    <ul>
                        <li><a href="ranking.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'ranking') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Ranking');?></a></li>
                        <li><a href="echnics.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'technics') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Technics');?></a></li>
                        <li><a href="help.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'help') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Help');?></a></li>
                        <li><a href="search.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'search') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Search');?></a></li>
                    </ul>
                </div>
                <div class="bottom"></div>
            </div>
            <div class="nav">
                <span class="personal"></span>
                <label><?php echo translate('Personal menu');?></label>
                <div class="lines">
                    <ul>
                        <li><a href="messages.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'messages') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Messages');?> <?php if (getNewMessages() > 0) {
?>[<?php echo getNewMessages();?>]<?php 
}?></a></li>
                        <li><a href="messages.php?type=sent" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'sent') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Sent messages');?></a></li>
                        <li><a href="notes.php" <?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'notes') {
?>style="color: #fff;"<?php 
}?>><?php echo translate('Notes');?></a></li>
                    </ul>
                </div>
                <div class="bottom"></div>
            </div>
        </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>