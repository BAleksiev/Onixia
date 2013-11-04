        <div id="leftNav">
            <div class="nav">
                <span class="main"></span>
                <label>{translate Navigation}</label>
                <div class="lines">
                    <ul>
                        <li><a href="main.php" {if $action == 'main'}style="color: #fff;"{/if}>{translate Main}</a></li>
                        <li><a href="buildings.php" {if $action == 'buildings'}style="color: #fff;"{/if}>{translate Buildings}</a></li>
                        <li><a href="researches.php" {if $action == 'researches'}style="color: #fff;"{/if}>{translate Researches}</a></li>
                        <li><a href="robots.php" {if $action == 'robots'}style="color: #fff;"{/if}>{translate Robots}</a></li>
                        <li><a href="ships.php" {if $action == 'ships'}style="color: #fff;"{/if}>{translate Ships}</a></li>
                        <li><a href="factory.php" {if $action == 'factory'}style="color: #fff;"{/if}>{translate Factory}</a></li>
                        <li><a href="fleets.php" {if $action == 'fleets'}style="color: #fff;"{/if}>{translate Fleets}</a></li>
                        <li><a href="alliance.php" {if $action == 'alliance'}style="color: #fff;"{/if}>{translate Alliance}</a></li>
                        <li><a href="galaxy.php" {if $action == 'galaxy'}style="color: #fff;"{/if}>{translate Galaxy}</a></li>
                        <li><a href="defence.php" {if $action == 'defence'}style="color: #fff;"{/if}>{translate Defence}</a></li>
                        <li><a href="market.php" {if $action == 'market'}style="color: #fff;"{/if}>{translate Market}</a></li>
                        <li><a href="bank.php" {if $action == 'bank'}style="color: #fff;"{/if}>{translate Bank}</a></li>
                        <li><a href="debug.php?back=<?php echo $_SERVER['PHP_SELF']; ?>">Debug</a></li>
                    </ul>
                </div>
                <div class="bottom"></div>
            </div>
            <div class="nav">
                <span class="planets"></span>
                <label>{translate Planets}</label>
                <div class="lines">
                    <ul>
                        {foreach $planets p}
                        <li>{if $planet.id != $p.id}<a href="changeplanet.php?id={$p.id}&where={$action}" {if $planet.id == $p.id}style="color: #fff;"{/if}>{/if}{$p.name} [{$p.c1}:{$p.c2}:{$p.c3}]{if $planet.id != $p.id}</a>{/if}</li>
                        {/foreach}
                    </ul>
                </div>
                <div class="bottom"></div>
            </div>
            <div class="nav">
                <span class="information"></span>
                <label>{translate Information}</label>
                <div class="lines">
                    <ul>
                        <li><a href="ranking.php" {if $action == 'ranking'}style="color: #fff;"{/if}>{translate Ranking}</a></li>
                        <li><a href="echnics.php" {if $action == 'technics'}style="color: #fff;"{/if}>{translate Technics}</a></li>
                        <li><a href="help.php" {if $action == 'help'}style="color: #fff;"{/if}>{translate Help}</a></li>
                        <li><a href="search.php" {if $action == 'search'}style="color: #fff;"{/if}>{translate Search}</a></li>
                    </ul>
                </div>
                <div class="bottom"></div>
            </div>
            <div class="nav">
                <span class="personal"></span>
                <label>{translate 'Personal menu'}</label>
                <div class="lines">
                    <ul>
                        <li><a href="profile.php" {if $action == 'profile'}style="color: #fff;"{/if}>{translate Profile}</a></li>
                        <li><a href="messages.php" {if $action == 'messages' && $subaction != 'sent'}style="color: #fff;"{/if}>{translate Messages} {if $newMessages}[{$newMessages}]{/if}</a></li>
                        <li><a href="messages.php?type=sent" {if $action == 'messages' && $subaction == 'sent'}style="color: #fff;"{/if}>{translate 'Sent messages'}</a></li>
                    </ul>
                </div>
                <div class="bottom"></div>
            </div>
        </div>