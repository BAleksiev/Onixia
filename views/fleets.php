        <div id="content">
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
                <h2 class="title">{translate 'Alliance'}</h2>
                <div class="spy-list">
                    <div class="spy-list-title"></div>
                    {foreach $spy s}
                    <div class="spy-list-line">
                        {$s.user} - [{$s.c1}:{$s.c2}:{$s.c3}] - 
                        <a href="spy.php?id={$s.id}&act=spy">spy</a> | 
                        <a href="spy.php?id={$s.id}&act=back">back</a>
                    </div>
                    {/foreach}
                </div>
                <table border="0" class="standart">
                    <thead>
                        <tr class="head">
                            <td width="50">{translate From}</td>
                            <td width="50">{translate To}</td>
                            <td width="100">{translate Arrives}</td>
                            <td width="100">{translate Back}</td>
                            <td width="70">{translate Mission}</td>
                            <td width="50">{translate Command}</td>
                        </tr>
                    </thead>
                    <tbody>
                    {if $flights}
                    {foreach $flights f}
                        <tr>
                            <td>{$f.tc1}:{$f.tc2}:{$f.tc3}</td>
                            <td>{$f.c1}:{$f.c2}:{$f.c3}</td>
                            <td>{if $f.status == 'go'}{date "H:i:s d-m-Y", $f.time_end}{/if}</td>
                            <td>{if f.status == 'go'}{date "H:i:s d-m-Y", $f.time_back}{else}{date "H:i:s d-m-Y", $f.time_end}{/if}</td>
                            <td>{$f.type}</td>
                            {if $f.status == 'go'}<td><a href="fleets.php?act=back&id={$f.id}">{translate Back}</a></td>
                            {else}<td>-</td>{/if}
                        </tr>
                    {/foreach}
                    {/if}
                    </tbody>
                </table>
                <form action="flight.php" method="post">
                {foreach $shipsC key=id item=num}
                    {translate $ships[$id].name} :
                    <input type="text" name="ships[{$id}]" value="0" size="5" class="{$id}"/>
                    <a href=javascript:setMaximum({$id},{$num})>{$num}</a>
                    <br/>
                {/foreach}
                    {translate Mission}:
                    <select name="flightType" class="mission" onchange="javascript: mission( {sizeof $ships} )">
                        <option value="">{translate Select}:</option>
                        <option value="attack">{translate Attack}</option>
                        <option value="spy">{translate Spy}</option>
                        <option value="transport">{translate Transport}</option>
                        <option value="astro">{translate Astroplatation}</option>
                        <option value="colonise">{translate Colonise}</option>
                        <option value="stationing">{translate Stationing}</option>
                        <option value="recycle">{translate Recycle}</option>
                    </select><br/>
                    <div class="missionFeatures">
                        {translate Coordinats}:
                        <input type="text" name="c1" size="3" value="{$cookies.c1}" /> :
                        <input type="text" name="c2" size="3" value="{$cookies.c2}" /> :
                        <input type="text" name="c3" size="3" value="{$cookies.c3}" /><br/>
                        {translate Speed}:
                        <select name="speed">
                        {for i 10 1}
                            <option value="{$i}0">{$i}0%</option>
                        {/for}
                        </select><br/>
                        {translate Cargo}: <?php echo $cargo ?><br/>
                        Носейки: <div class="right"></div>
                        Метал: <input type="text" name="metal" value="0" onChange="calc(<?php echo $cargo; ?>)"/><a href=javascript:setMaximum("metal",{floor $planet.metal})>{number_format $planet.metal,0 ,'.' ,' '}</a><br/>
                        Кристал: <input type="text" name="crystal" value="0" onChange="calc(<?php echo $cargo; ?>)"/><a href=javascript:setMaximum("crystal",{floor $planet.crystal})>{number_format $planet.crystal,0 ,'.' ,' '}</a><br/>
                        Газ: <input type="text" name="gas" value="0" onChange="calc(<?php echo $cargo; ?>)"/><a href=javascript:setMaximum("gas",{floor $planet.gas})>{number_format $planet.gas,0 ,'.' ,' '}</a><br/>
                        <input class="submit" type="submit" value="GO"/>
                    </div>
                </form>
            </div>
        </div>