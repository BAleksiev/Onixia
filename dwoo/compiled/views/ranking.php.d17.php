<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page ranking">
                <h2 class="title"><?php echo translate('Ranking');?></h2>
                <?php if ((isset($this->scope["pages"]) ? $this->scope["pages"] : null) > 1) {
?>
                <div class="paging_nav">
                    <a class="prev_page <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) == 1) {
?>prev-no-link<?php 
}?>" <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) > 1) {
?>href="ranking.php?page=<?php echo ($this->scope["page"] - 1);?>"<?php 
}?>></a>
                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) > 3) {
?><a class="page_button" <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) != 1) {
?>href="ranking.php?page=1"<?php 
}?>><span>1</span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) > 4) {
?>...<?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)-2 > 0) {
?><a class="page_button" href="ranking.php?page=<?php echo $this->scope["page"]-2;?>"><span><?php echo $this->scope["page"]-2;?></span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)-1 > 0) {
?><a class="page_button" href="ranking.php?page=<?php echo $this->scope["page"]-1;?>"><span><?php echo $this->scope["page"]-1;?></span></a><?php 
}?>


                    <a class="page_button active" ><span><?php echo $this->scope["page"];?></span></a>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)+1 <= (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?><a class="page_button" href="ranking.php?page=<?php echo $this->scope["page"]+1;?>"><span><?php echo $this->scope["page"]+1;?></span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)+2 <= (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?><a class="page_button" href="ranking.php?page=<?php echo $this->scope["page"]+2;?>"><span><?php echo $this->scope["page"]+2;?></span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) < (isset($this->scope["pages"]) ? $this->scope["pages"] : null)-3) {
?>...<?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) <= (isset($this->scope["pages"]) ? $this->scope["pages"] : null)-3) {
?><a class="page_button" href="ranking.php?page=<?php echo $this->scope["pages"];?>"><span><?php echo $this->scope["pages"];?></span></a><?php 
}?>

                    <a class="next_page <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) == (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?>next-no-link<?php 
}?>" <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) < (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?>href="ranking.php?page=<?php echo ($this->scope["page"] + 1);?>"<?php 
}?>></a>
                </div>
                <?php 
}?>

                <table border="0" class="standart left">
                    <thead>
                        <tr class="head">
                            <td class="cell20"></td>
                            <td class="player"><?php echo translate('Player');?></td>
                            <td class="cell20"><?php echo translate('Level');?></td>
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

                        <tr>
                            <td class="id"><?php echo $this->scope["n"];?></td>
                            <td class="player <?php if ((isset($this->scope["user"]["id"]) ? $this->scope["user"]["id"]:null) == (isset($this->scope["r"]["id"]) ? $this->scope["r"]["id"]:null)) {
?>active<?php 
}?>"><?php echo $this->scope["r"]["user"];?></td>
                            <td class="active"><?php echo $this->scope["r"]["race"];?></td>
                            <td><?php echo number_format((isset($this->scope["r"]["war_points"]) ? $this->scope["r"]["war_points"]:null), 0, '.', ' ');?></td>
                            <td><?php echo number_format((isset($this->scope["r"]["points"]) ? $this->scope["r"]["points"]:null), 0, '.', ' ');?></td>
                            <td class="active"><?php echo number_format(((isset($this->scope["r"]["points"]) ? $this->scope["r"]["points"]:null) + (isset($this->scope["r"]["war_points"]) ? $this->scope["r"]["war_points"]:null)), 0, '.', ' ');?></td>
                        </tr>
                        <?php 
/* -- foreach end output */
	}
}?>

                    </tbody>
                </table>
                <?php if ((isset($this->scope["pages"]) ? $this->scope["pages"] : null) > 1) {
?>
                <div class="paging_nav">
                    <a class="prev_page <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) == 1) {
?>prev-no-link<?php 
}?>" <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) > 1) {
?>href="ranking.php?page=<?php echo ($this->scope["page"] - 1);?>"<?php 
}?>></a>
                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) > 3) {
?><a class="page_button" <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) != 1) {
?>href="ranking.php?page=1"<?php 
}?>><span>1</span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) > 4) {
?>...<?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)-2 > 0) {
?><a class="page_button" href="ranking.php?page=<?php echo $this->scope["page"]-2;?>"><span><?php echo $this->scope["page"]-2;?></span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)-1 > 0) {
?><a class="page_button" href="ranking.php?page=<?php echo $this->scope["page"]-1;?>"><span><?php echo $this->scope["page"]-1;?></span></a><?php 
}?>


                    <a class="page_button active" ><span><?php echo $this->scope["page"];?></span></a>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)+1 <= (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?><a class="page_button" href="ranking.php?page=<?php echo $this->scope["page"]+1;?>"><span><?php echo $this->scope["page"]+1;?></span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null)+2 <= (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?><a class="page_button" href="ranking.php?page=<?php echo $this->scope["page"]+2;?>"><span><?php echo $this->scope["page"]+2;?></span></a><?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) < (isset($this->scope["pages"]) ? $this->scope["pages"] : null)-3) {
?>...<?php 
}?>

                    <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) <= (isset($this->scope["pages"]) ? $this->scope["pages"] : null)-3) {
?><a class="page_button" href="ranking.php?page=<?php echo $this->scope["pages"];?>"><span><?php echo $this->scope["pages"];?></span></a><?php 
}?>

                    <a class="next_page <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) == (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?>next-no-link<?php 
}?>" <?php if ((isset($this->scope["page"]) ? $this->scope["page"] : null) < (isset($this->scope["pages"]) ? $this->scope["pages"] : null)) {
?>href="ranking.php?page=<?php echo ($this->scope["page"] + 1);?>"<?php 
}?>></a>
                </div>
                <?php 
}?>

            </div>
        </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>