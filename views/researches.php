        <div id="content">
            <div class="page">
                <h2 class="title">{translate 'Researches'}</h2>
                {assign sizeof($sciences) total_lines}
                {assign 0 lines}
                
                {foreach $sciences sc}
                    {assign $lines+1 lines}
<!--                    <div class="item {if $error[$b.name]}unav{/if}">-->
                <div class="item">
                    <div class="title">
                        {translate $sc.name}
                    </div>
                    <div class="resources">
                        <div class="res">
                            <div class="logo metal"></div>
                            <label {if $error[$sc.name].id==1}class="err"{/if}>{$Sprices[$sc.id][$researches[$sc.id]+1].metal}</label>
                        </div>
                        <div class="res">
                            <div class="logo crystal"></div>
                            <label {if $error[$sc.name].id==2}class="err"{/if}>{$Sprices[$sc.id][$researches[$sc.id]+1].crystal}</label>
                        </div>
                        <div class="res">
                            <div class="logo gas"></div>
                            <label {if $error[$sc.name].id==3}class="err"{/if}>{$Sprices[$sc.id][$researches[$sc.id]+1].gas}</label>
                        </div>
                        <div class="res">
                            <div class="logo energy"></div>
                            <label>0</label>
                        </div>
                        <div class="res">
                            <div class="logo level"></div>
                            <label>{$researches[$sc.id]}</label>
                        </div>
                    </div>
                    <div class="image"></div>
                    <div class="opt">
                        <div class="description">
                            {translate $sc.description}
                        </div>
                        <div class="time" {if $error[$sc.name].id == 'this'}id="time"{/if}>
                            <div class="timer-logo"></div>
                            {if $error[$sc.name].id == 'this'}
                            <script>
                                pp="{$timeNeed[$sc.name]}";
                                timer();
                            </script>
                            {else}
                            <label>{timeConvert $timeNeed[$sc.name]}</label>{/if}
                        </div>
                        {if $rView[$sc.name] == true}
                        <a href="build.php?type=research&id={$sc.id}">
                            <div class="build">
                                <div class="build-logo"></div>
                                research level {$researches[$sc.id]+1}
                            </div>
                        </a>
                        {else}
                        {if $error[$sc.name].id == 'this'}<a href="build.php?type=research&mode=cancel&id={$sc.id}">{/if}
                        <div class="build">
                            <div class="build-logo"></div>
                            <label class="{if $error[$sc.name].id == 'this'}link{/if}{if $error[$sc.name].id == 'req' || $error[$sc.name].id == 1 || $error[$sc.name].id == 2 || $error[$sc.name].id == 3 || $error[$sc.name].id == 4}err{/if}">{translate $error[$sc.name].msg}</label>
                        </div>
                        {if $error[$sc.name].id == 'this'}</a>{/if}{/if}
                    </div>
                </div>
                {if $lines < $total_lines}
                <div class="separator"></div>{/if}
                {/foreach}
            </div>
        </div>