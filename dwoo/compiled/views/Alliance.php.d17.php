<?php
/* template head */
if (function_exists('Dwoo_Plugin_include')===false)
	$this->getLoader()->loadPlugin('include');
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page alliance">
                <h2 class="title"><?php echo translate('Alliance');
if ((isset($this->scope["alliance"]) ? $this->scope["alliance"] : null)) {
?> <?php echo $this->scope["alliance"]["name"];

}?></h2>
                <?php if ((isset($this->scope["alliance"]) ? $this->scope["alliance"] : null)) {
?>
                <?php if ((isset($this->scope["user"]["rank"]) ? $this->scope["user"]["rank"]:null) == 1) {
?>
                <div class="admin-panel">
                    <div class="ap-top"><?php echo translate('Command');?></div>
                    <div class="ap-body" <?php if ((isset($this->scope["ap_cookie"]) ? $this->scope["ap_cookie"] : null) == 'show') {
?>style="height: 220px;"<?php 
}?>>
                        <div class="ap-content" <?php if ((isset($this->scope["ap_cookie"]) ? $this->scope["ap_cookie"] : null) == 'show') {
?>style="display: block;"<?php 
}?>>
                            <form action="alliance.php" method="post">
                                <table class="alliance-admin-panel">
                                    <thead>
                                        <tr>
                                            <td class="permition"><?php echo translate('Grant Permissions');?></td>
                                            <?php 
$_fh0_data = (isset($this->scope["ranks"]) ? $this->scope["ranks"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['id']=>$this->scope['r'])
	{
/* -- foreach start output */
?>
                                            <td width="10%"><div class="rank rank-<?php echo $this->scope["id"];?>"></div></td>
                                            <?php 
/* -- foreach end output */
	}
}?>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $this->assignInScope(1, 'i');?>

                                        <?php 
$_fh2_data = (isset($this->scope["permissions"]) ? $this->scope["permissions"] : null);
if ($this->isArray($_fh2_data) === true)
{
	foreach ($_fh2_data as $this->scope['pid']=>$this->scope['p'])
	{
/* -- foreach start output */
?>
                                        <tr <?php if (( (isset($this->scope["i"]) ? $this->scope["i"] : null)%2 ) == 1) {
?>class="odd"<?php 
}?>>
                                            <td class="permition"><?php echo translate((isset($this->scope["p"]) ? $this->scope["p"] : null));?></td>
                                            <?php 
$_fh1_data = (isset($this->scope["ranks"]) ? $this->scope["ranks"] : null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['rid']=>$this->scope['r'])
	{
/* -- foreach start output */
?>
                                            <td>
                                                <input type="checkbox" class="checkbox" name="<?php echo $this->scope["rid"];?>[<?php echo $this->scope["pid"];?>]" value="<?php echo $this->scope["pid"];?>" <?php if ($this->readVar("alliance.permissions.".(isset($this->scope["rid"]) ? $this->scope["rid"] : null).".".(isset($this->scope["pid"]) ? $this->scope["pid"] : null))) {
?>checked="checked"<?php 
}?> <?php if ((isset($this->scope["rid"]) ? $this->scope["rid"] : null) == 1) {
?>disabled="1"<?php 
}?> />
                                            </td>
                                            <?php 
/* -- foreach end output */
	}
}?>

                                        </tr>
                                        <?php echo $this->assignInScope(((isset($this->scope["i"]) ? $this->scope["i"] : null) + 1), 'i');?>

                                        <?php 
/* -- foreach end output */
	}
}?>

                                    </tbody>
                                </table>
                                <button class="button"><span><span><?php echo translate('Save changes');?></span></span></button>
                            </form>
                        </div>
                    </div>
                    <div class="ap-footer">
                        <span class="more" <?php if ((isset($this->scope["ap_cookie"]) ? $this->scope["ap_cookie"] : null) == 'show') {
?>style="display: none;"<?php 
}?>><?php echo translate('show more');?></span>
                        <span class="less" <?php if ((isset($this->scope["ap_cookie"]) ? $this->scope["ap_cookie"] : null) == 'show') {
?>style="display: inline-block;"<?php 
}?>><?php echo translate('show less');?></span>
                    </div>
                </div>
                <?php 
}?>

                <div class="politics">
                    <table>
                        <thead>
                            <tr>
                                <td><?php echo translate('Policy');?></td>
                                <td><?php echo translate('Alliance');?></td>
                                <td><?php echo translate('Date of conclusion');?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
$_fh3_data = (isset($this->scope["politics"]) ? $this->scope["politics"] : null);
if ($this->isArray($_fh3_data) === true)
{
	foreach ($_fh3_data as $this->scope['p'])
	{
/* -- foreach start output */
?>
                            <tr>
                                <td><?php echo translate((isset($this->scope["p"]["policy_type"]) ? $this->scope["p"]["policy_type"]:null));?></td>
                                <td>[<a href="alliance.php?id=<?php echo $this->scope["p"]["alliance_id"];?>" class="policy-<?php echo $this->scope["p"]["policy"];?>"><?php echo $this->scope["p"]["name"];?></a>]</td>
                                <td><?php echo date('d.m.Y', (isset($this->scope["p"]["time_concluded"]) ? $this->scope["p"]["time_concluded"]:null));?></td>
                            </tr>
                            <?php 
/* -- foreach end output */
	}
}?>

                        </tbody>
                    </table>
                    <?php echo translate('Обяви политика спрямо друг съюз');?>

                    <form action="alliance.php" method="post">
                        
                    </form>
                </div>
                <h2 class="title"><?php echo translate('Members');?></h2>
                <table class="standart alliance">
                    <thead>
                        <tr class="head">
                            <td><?php echo translate('Rank');?></td>
                            <td class="player"><?php echo translate('Player');?></td>
                            <td width="17%"><?php echo translate('Status');?></td>
                            <td width="20%"><?php echo translate('Points');?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
$_fh4_data = (isset($this->scope["members"]) ? $this->scope["members"] : null);
if ($this->isArray($_fh4_data) === true)
{
	foreach ($_fh4_data as $this->scope['p'])
	{
/* -- foreach start output */
?>
                        <tr id="<?php echo $this->scope["p"]["id"];?>" class="<?php echo $this->scope["p"]["id"];?>">
                            <td class="id"><div class="rank rank-<?php echo $this->scope["p"]["rank"];?>" id="<?php echo $this->scope["p"]["rank"];?>"></div></td>
                            <td class="player <?php if ((isset($this->scope["user"]["id"]) ? $this->scope["user"]["id"]:null) == (isset($this->scope["p"]["id"]) ? $this->scope["p"]["id"]:null)) {
?>active<?php 
}?>">
                                <span><a id="<?php echo $this->scope["p"]["name"];?>" href=""><?php echo $this->scope["p"]["name"];?></a></span> 
                                <a rel="#message_panel" class="player-msg popup-opt <?php echo $this->scope["p"]["id"];?>" id="<?php echo $this->scope["p"]["id"];?>"></a>
                                <a href="statistic.php?id=<?php echo $this->scope["p"]["id"];?>" class="player-stats popup-opt <?php echo $this->scope["p"]["id"];?>" id="<?php echo $this->scope["p"]["id"];?>"></a>
                                <a class="player-options popup-opt <?php echo $this->scope["p"]["id"];?>" id="<?php echo $this->scope["p"]["id"];?>"></a>
                            </td>
                            <td class="status <?php if (lastOnline((isset($this->scope["p"]["last_login"]) ? $this->scope["p"]["last_login"]:null)) == 0) {
?>offline<?php 
}
else {
?>online<?php 
}?>"><?php if (lastOnline((isset($this->scope["p"]["last_login"]) ? $this->scope["p"]["last_login"]:null)) == 0) {
?>Offline<?php 
}
else {

echo lastOnline((isset($this->scope["p"]["last_login"]) ? $this->scope["p"]["last_login"]:null));?> <?php echo translate('min');

}?></td>
                            <td class="active"><?php echo number_format((isset($this->scope["p"]["points"]) ? $this->scope["p"]["points"]:null)+(isset($this->scope["p"]["war_points"]) ? $this->scope["p"]["war_points"]:null), 0, '.', ' ');?></td>
                        </tr>
                        <?php 
/* -- foreach end output */
	}
}?>

                    </tbody>
                </table>
                <a class="standart-button link" rel=""><?php echo translate('Mass message');?></a>
                <?php 
}?>

            </div>
        </div>
        <?php echo Dwoo_Plugin_include($this, 'views/message_panel.php', null, null, null, '_root', null);?>

        <script>
            
            var $tooltip = null;
            
            $(function() {
                $tooltip = $('a.player-options').tooltip({
                    tip: '.player_info_panel',
                    position: 'bottom right',
                    offset: [0, -320],
                    bounce: true,
                    events: {
                        def: 'click, x',
                        tooltip: 'mouseenter'
                    },
                    effect: 'fade'
                });
            });
            
            function hideTooltip() {
                if($tooltip) {
                    $tooltip.each(function() {
                        var $this = $(this).data('tooltip');
                        if($this.isShown(true)) {
                            $this.hide();
                        }
                    });
                }
            }
            
            $(document).ready(function() {
                
                $.ajax({
                    url: 'alliance.php',
                    type: 'post',
                    data: {
                        ajax: 'getRanks'
                    },
                    dataType: 'json'
                }).done(function(data){
                    window.ranks = data;
                });
                
                $('a.player-options').click(function() {
                    id = $(this).attr('id');
                    var rank = $('tbody tr.'+id+' td.id div').attr('id');
                    var rankClass = $('tbody tr.'+id+' td.id div').attr('class');
                    var player = $('tbody tr.'+id+' td span a').html();
                    if(rank == 1) {
                        $('.change-rank a.rank-up').addClass('up-blind');
                        $('.change-rank a.rank-up').removeClass('rank-up');
                        $('.change-rank a.rank-down').addClass('down-blind');
                        $('.change-rank a.rank-down').removeClass('rank-down');
                    } else if(rank == 2) {
                        $('.change-rank a.rank-up').addClass('up-blind');
                        $('.change-rank a.rank-up').removeClass('rank-up');
                        var cl = $('.change-rank a.down-blind');
                        if(cl) {
                            $('.change-rank a.down-blind').addClass('rank-down');
                            $('.change-rank a.rank-down').removeClass('down-blind');
                        }
                        $('.change-rank a.rank-down').addClass('rank-down');
                        $('.change-rank a.rank-up').removeClass('rank-up');
                    } else if(rank == 5) {
                        $('.change-rank a.rank-down').addClass('down-blind');
                        $('.change-rank a.rank-down').removeClass('rank-down');
                    } else {
                        $('.change-rank a.up-blind').addClass('rank-up');
                        $('.change-rank a.rank-up').removeClass('up-blind');
                        $('.change-rank a.down-blind').addClass('rank-down');
                        $('.change-rank a.rank-down').removeClass('down-blind');
                    }
                    $('.player_info_panel .fill').attr('id', id);
                    $('.player_info_panel li.player span.content').html(player);
                    $('.player_info_panel li.player_rank span.content').html(ranks[rank]['rank']);
                });
            
                $('.pi_title a.close').click(function() {
                    hideTooltip();
                });
                
                $('tbody tr, .fill').hover(function(){
                    id = $(this).attr('id');
                    $('a.' + id).show();
                }, function(){
                    id = $(this).attr('id');
                    $('a.' + id).hide();
                });
            });
            
            $('a.player-msg').click(function(){
                 id = $(this).attr('id');
                var username = $('tr.' + id + ' span a').attr('id');
                $('input[name=user]').val(username);
            });
            
            $('.ap-footer span.more').click(function(){
                $('.ap-body').animate({
                    height: '220'
                }, 700, function(){
                    $('.ap-footer span.more').hide();
                    $('.ap-footer span.less').css('display','inline-block');
                });
                $('.ap-content').fadeIn(700);
                setCookie('admin_panel','show');
            });
            
            $('.ap-footer span.less').click(function(){
                $('.ap-body').animate({
                    height: '1'
                }, 700, function(){
                    $('.ap-footer span.less').hide();
                    $('.ap-footer span.more').css('display','inline-block');
                });
                $('.ap-content').fadeOut(500);
                deleteCookie('admin_panel');
            });
        </script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>