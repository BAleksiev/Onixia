        <div id="content">
            <div class="page alliance">
                <h2 class="title">{translate 'Alliance'}{if $alliance} {$alliance.name}{/if}</h2>
                {if $alliance}
                {if $user.rank == 1}
                <div class="admin-panel">
                    <div class="ap-top">{translate 'Command'}</div>
                    <div class="ap-body" {if $ap_cookie == 'show'}style="height: 220px;"{/if}>
                        <div class="ap-content" {if $ap_cookie == 'show'}style="display: block;"{/if}>
                            <form action="alliance.php" method="post">
                                <table class="alliance-admin-panel">
                                    <thead>
                                        <tr>
                                            <td class="permition">{translate 'Grant Permissions'}</td>
                                            {foreach $ranks key=id item=r}
                                            <td width="10%"><div class="rank rank-{$id}"></div></td>
                                            {/foreach}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {assign 1 i}
                                        {foreach $permissions key=pid item=p}
                                        <tr {if ($i % 2) == 1}class="odd"{/if}>
                                            <td class="permition">{translate $p}</td>
                                            {foreach $ranks key=rid item=r}
                                            <td>
                                                <input type="checkbox" class="checkbox" name="{$rid}[{$pid}]" value="{$pid}" {if $alliance.permissions[$rid][$pid]}checked="checked"{/if} {if $rid == 1}disabled="1"{/if} />
                                            </td>
                                            {/foreach}
                                        </tr>
                                        {assign $i+1 i}
                                        {/foreach}
                                    </tbody>
                                </table>
                                <button class="button"><span><span>{translate 'Save changes'}</span></span></button>
                            </form>
                        </div>
                    </div>
                    <div class="ap-footer">
                        <span class="more" {if $ap_cookie == 'show'}style="display: none;"{/if}>{translate 'show more'}</span>
                        <span class="less" {if $ap_cookie == 'show'}style="display: inline-block;"{/if}>{translate 'show less'}</span>
                    </div>
                </div>
                {/if}
                <div class="politics">
                    <table>
                        <thead>
                            <tr>
                                <td>{translate 'Policy'}</td>
                                <td>{translate 'Alliance'}</td>
                                <td>{translate 'Date of conclusion'}</td>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $politics p}
                            <tr>
                                <td>{translate $p.policy_type}</td>
                                <td>[<a href="alliance.php?id={$p.alliance_id}" class="policy-{$p.policy}">{$p.name}</a>]</td>
                                <td>{date 'd.m.Y', $p.time_concluded}</td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                    {translate 'Обяви политика спрямо друг съюз'}
                    <form action="alliance.php" method="post">
                        
                    </form>
                </div>
                <h2 class="title">{translate 'Members'}</h2>
                <table class="standart alliance">
                    <thead>
                        <tr class="head">
                            <td>{translate Rank}</td>
                            <td class="player">{translate Player}</td>
                            <td width="17%">{translate Status}</td>
                            <td width="20%">{translate Points}</td>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $members p}
                        <tr id="{$p.id}" class="{$p.id}">
                            <td class="id"><div class="rank rank-{$p.rank}" id="{$p.rank}"></div></td>
                            <td class="player {if $user.id == $p.id}active{/if}">
                                <span><a id="{$p.name}" href="">{$p.name}</a></span> 
                                <a rel="#message_panel" class="player-msg popup-opt {$p.id}" id="{$p.id}"></a>
                                <a href="statistic.php?id={$p.id}" class="player-stats popup-opt {$p.id}" id="{$p.id}"></a>
                                <a class="player-options popup-opt {$p.id}" id="{$p.id}"></a>
                            </td>
                            <td class="status {if lastOnline($p.last_login) == 0}offline{else}online{/if}">{if lastOnline($p.last_login) == 0}Offline{else}{lastOnline $p.last_login} {translate min}{/if}</td>
                            <td class="active">{number_format($p.points + $p.war_points,0,'.',' ')}</td>
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
                <a class="standart-button link" rel="">{translate 'Mass message'}</a>
                {/if}
            </div>
        </div>
        {include 'views/message_panel.php'}
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
        </script>