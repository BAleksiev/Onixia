        <div id="content">
            <div class="page">
                <h2 class="title">{translate 'Buildings'}</h2>
                {assign sizeof($buildings) total_lines}
                {assign 0 lines}
                
                {foreach $buildings b}
                    {assign $lines+1 lines}
<!--                    <div class="item {if $error[$b.name]}unav{/if}">-->
                <div class="item">
                    <div class="title">
                        {translate $b.name}
                    </div>
                    <div class="resources">
                        <div class="res">
                            <div class="logo metal"></div>
                            <label class="{if $error[$b.name].id==1}err{/if}">{$Bprices[$b.id][$builds[$b.id]+1].metal}</label>
                        </div>
                        <div class="res">
                            <div class="logo crystal"></div>
                            <label class="{if $error[$b.name].id==2}err{/if}">{$Bprices[$b.id][$builds[$b.id]+1].crystal}</label>
                        </div>
                        <div class="res">
                            <div class="logo gas"></div>
                            <label class="{if $error[$b.name].id==3}err{/if}">{$Bprices[$b.id][$builds[$b.id]+1].gas}</label>
                        </div>
                        <div class="res">
                            <div class="logo energy"></div>
                            {if $b.name == "solar_panels"}<label>0</label>
                            {else}<label class="{if $error[$b.name].id==4}err{/if}">{$Bprices[$b.id][$builds[$b.id]+1].energy - $Bprices[$b.id][$builds[$b.id]].energy}</label>{/if}
                        </div>
                        <div class="res">
                            <div class="logo level"></div>
                            <label>{$builds[$b.id]}</label>
                        </div>
                    </div>
                    <div class="image"></div>
                    <div class="opt">
                        <div class="description">
                            {translate $b.description}
                        </div>
                        <div class="time" {if $error[$b.name].id == 'this'}id="time"{/if}>
                            <div class="timer-logo"></div>
                            {if $error[$b.name].id == 'this'}
                            <script>
                                pp="{$timeNeed[$b.name]}";
                                timer();
                            </script>
                            {else}
                            <label>{timeConvert $timeNeed[$b.name]}</label>{/if}
                        </div>
                        {if $build[$b.name] == true}
                        <a href="build.php?type=building&id={$b.id}">
                            <div class="build">
                                <div class="build-logo"></div>
                                build level {$builds[$b.id]+1}
                            </div>
                        </a>
                        {else}
                        {if $error[$b.name].id == 'this'}<a href="build.php?type=building&mode=cancel&id={$b.id}">{/if}
                        <div class="build">
                            <div class="build-logo"></div>
                            <label class="{if $error[$b.name].id == 'this'}link{/if}{if $error[$b.name].id == 'req' || $error[$b.name].id == 1 || $error[$b.name].id == 2 || $error[$b.name].id == 3 || $error[$b.name].id == 4}err{/if}">{translate $error[$b.name].msg}</label>
                        </div>
                        {if $error[$b.name].id == 'this'}</a>{/if}{/if}
                    </div>
                </div>
                {if $lines < $total_lines}
                <div class="separator"></div>{/if}
                {/foreach}
            </div>
        </div>