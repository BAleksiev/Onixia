        <div id="content">
            <div class="page">
                <h2 class="title">{translate 'Galaxy'}</h2>
                <div class="coordinats">
                    <form action="galaxy.php" method="get">
                        <a href="galaxy.php?c1={$c1-1}&c2={$c2}"><div class="back_button"><</div></a>
                        <input type="text" name="c1" size="2" value="{$c1}"/>
                        <a href="galaxy.php?c1={$c1+1}&c2={$c2}"><div class="next_button">></div></a>
                        <label> : </label>
                        <a href="galaxy.php?c1={$c1}&c2={$c2-1}"><div class="back_button"><</div></a>
                        <input type="text" name="c2" size="2" value="{$c2}"/>
                        <a href="galaxy.php?c1={$c1}&c2={$c2+1}"><div class="next_button">></div></a>
                        <input class="submit" type="submit" value="{translate Show}"/>
                    </form>
                </div>
                <div class="planets">
                    <table class="galaxy" cellspacing="1">
                        <tbody>
                        {for i 1 10}
                            <tr>
                                <td class="id">{$i}</td>
                                <td class="ast-rec">
                                {if $asteroids || $recycles}
                                {if $recycles}
                                {foreach $recycles r}
                                {if $r.c3 == $i}
                                <label class="link recycle" onclick="saveCoordinates({$c1},{$c2},{$i})" title="<h2>{translate Recycle}</h2>{translate Metal}: {$r.metal}, {translate Crystal}: {$r.crystal}, {translate Gas}: {$r.gas}">R</label>
                                {/if}{/foreach}{/if}
                                {if $asteroids}
                                {foreach $asteroids a}
                                {if $a.c3 == $i}
                                <label class="link asteroid" onclick="saveCoordinates({$c1},{$c2},{$i})"  title="<h2>{translate Asteroid}</h2><b>{translate Speed}:</b> {timeConvert $a.speed}<br/><b>{translate 'Next move'}: </b> {date('d.m.Y H:i:s', $a.next_move)}">A</label>
                                {/if}{/foreach}{/if}
                                {/if}
                                </td>
                                {if $planetsView[$i].c3 == $i}
                                <td {if $recycles || $asteroids}{if $recycles && $asteroids}colspan="2"{else}colspan="3"{/if}{/if} class="active">{if $planetsView[$i].alliance != 0}[ <a href="alliance.php?id={$planetsView[$i].alliance}">{$planetsView[$i].alliance_name}</a> ]{/if} {$planetsView[$i].name} / <label title="<h2>{$planetsView[$i].user}</h2><b>{translate Points}:</b> {$planetsView[$i].points}<br/><b>{translate 'Last online'}:</b> <br/>{date 'Y-m-d H:i:s', $planetsView[$i].last_update}<br/><b>{translate Rank}:</b> {$planetsView[$i].rank}">{$planetsView[$i].user}</label></td>
                                {if $planetsView[$i].owner != $user.id}
                                <td class="opt"><a href="flight.php?act=fastspy&c1={$c1}&c2={$c2}&c3={$i}"><img src="images/spy-icon.png" title="<h2>{translate spy}</h2>{translate 'Send a spy probe to this planet.'}" /></a></td>
                                <td class="opt"><img class="link" onclick="saveCoordinates({$c1},{$c2},{$i})" src="images/attack-icon.png" title="<h2>{translate 'Fast attack'}</h2>{translate 'Remembers the coordinates and imputs them in the fleets menu'}" /></td>
                                <td class="opt"><img class="link" rel="#popupWindow" src="images/msg-icon.png" title="<h2>{translate Message}</h2>{translate 'Send message to this player.'}" /></td>
                                {/if}
                                {else}
                                <td {if $recycles || $asteroids}{if $recycles && $asteroids}colspan="2"{else}colspan="3"{/if}{/if}></td>
                                <td class="opt"></td>
                                <td class="opt"></td>
                                <td class="opt"></td>
                                {/if}
                            </tr>
                        {/for}
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
        </script>