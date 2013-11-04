        <div id="content">
            <div class="page">
                <h2 class="title">{translate 'Ships'}</h2>
                <form action="build_ships.php" method="post">
                    {assign 1 n}
                    {foreach $ships s}
                    <div class="ship {if $n%2 == 0}ship-last{/if}">
                        <div class="image">
                            <label>{$s.name}</label>
                        </div>
                        <div class="info">
                            <div class="line">
                                <div class="title">{translate Metal} :</div>
                                <lable class="value {if $error[$s.name].id == 1}err{/if}">{number_format $s.metal,0 ,'.' ,' '}</lable>
                            </div>
                            <div class="line">
                                <div class="title">{translate Crystal} :</div>
                                <lable class="value {if $error[$s.name].id == 2}err{/if}">{number_format $s.crystal,0 ,'.' ,' '}</lable>
                            </div>
                            <div class="line">
                                <div class="title">{translate Gas} :</div>
                                <lable class="value {if $error[$s.name].id == 3}err{/if}">{number_format $s.gas,0 ,'.' ,' '}</lable>
                            </div>
                            <div class="line">
                                <div class="title">{translate 'Time need'}:</div>
                                <lable class="value">{timeConvert $s.time_need}</lable>
                            </div>
                            <div class="line">
                                <div class="title">{translate Available}:</div>
                                <div class="value">{if $avShips[$s.id]}{$avShips[$s.id]}{else}0{/if}</div>
                            </div>
                            <div class="line" style="background: none;">
                            {if $sView == true}
                                <div class="title">{translate Build}:</div>
                                <input type="text" name="{$s.id}" value="0" size="3"/> <a href=javascript:setMaximum("{$s.id}",{floor $maxNum[$s.name]})>{floor $maxNum[$s.name]}</a>
                            {else}
                                <div class="title"><label class="err">{translate $error[$s.name].msg}</label></div>
                            {/if}
                            </div>
                        </div>
                    </div>
                    {if $n%2 == 0}<div class="separator" style="float: left;"></div>{/if}
                    {assign $n+1 n}
                    {/foreach}
                    {if $n%2 == 0}<div class="separator" style="float: left;"></div>{/if}
                    <input class="submit ships" type="submit" value="{translate build}"/>
                </form>
            </div>
        </div>