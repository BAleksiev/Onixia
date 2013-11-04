        <div id="content">
            <div class="page">
                <h2 class="title">{translate(ucfirst($subaction))} {translate 'messages'}</h2>
                {if $messages}
                {if $pages > 1}
                <div class="paging_nav">
                    <a class="prev_page {if $page == 1}prev-no-link{/if}" {if $page > 1}href="messages.php?type={$subaction}&page={$page-1}"{/if}></a>
                    {if $page > 3}<a class="page_button" {if $page != 1}href="messages.php?type={$subaction}&page=1"{/if}><span>1</span></a>{/if}
                    {if $page > 4}...{/if}
                    {if $page - 2 > 0}<a class="page_button" href="messages.php?type={$subaction}&page={$page - 2}"><span>{$page - 2}</span></a>{/if}
                    {if $page - 1 > 0}<a class="page_button" href="messages.php?type={$subaction}&page={$page - 1}"><span>{$page - 1}</span></a>{/if}
                    
                    <a class="page_button active" ><span>{$page}</span></a>
                    
                    {if $page + 1 <= $pages}<a class="page_button" href="messages.php?type={$subaction}&page={$page + 1}"><span>{$page + 1}</span></a>{/if}
                    {if $page + 2 <= $pages}<a class="page_button" href="messages.php?type={$subaction}&page={$page + 2}"><span>{$page + 2}</span></a>{/if}
                    {if $page < $pages - 3}...{/if}
                    {if $page <= $pages - 3}<a class="page_button" href="messages.php?type={$subaction}&page={$pages}"><span>{$pages}</span></a>{/if}
                    <a class="next_page {if $page == $pages}next-no-link{/if}" {if $page < $pages}href="messages.php?type={$subaction}&page={$page+1}"{/if}></a>
                </div>
                {/if}
                <form action="messages.php?type={$subaction}&act=deleteSelected" method="post">
                    {foreach $messages m}
                    <div class="msg-panel">
                        <div class="avatar" style="background: url(users/{$m.from}/{$m.from_name}.png) center center no-repeat;">
                            <div class="avatar-info">
                                <label>{$m.from_name}</label>
                                {if $subaction == 'sent'}<label class="msg-status">{if $m.read == 0}{translate 'Not read'}{else}{translate Read}{/if}</label>{/if}
                            </div>
                        </div>
                        <div class="content">
                            <div class="title">
                                <span class="time">{date 'd-m-Y H:i:s', $m.time_send}</span>
                                {if $m.new == true}<span class="new">{translate 'New message'}</span>{/if}
                                {if $subaction != 'sent'}
                                <a class="delete link" href="messages.php?type={$m.type}&act=delete&id={$m.id}">{translate Delete}</a>
                                {/if}
                                {if $subaction == 'personal'}<a class="replay link" id="{$m.from_name}" rel="#message_panel">{translate Replay}</a>{/if}
                            </div>
                            <div class="msg">
                                {$m.content}
                            </div>
                            <div class="options">
                                {if $subaction != 'sent'}
                                <input class="checkbox" id="{$m.id}" type="checkbox" value="{$m.id}" name="selected[]"/>
                                <label for="{$m.id}">{translate 'Select this message'}</label>
                                {assign 'Are you sure you want to report this message as abuse?' msg_report}
                                {assign 'Are you sure you want to report this message as abuse?' msg_ignore}
                                {if $subaction == 'personal'}
                                <a class="report link" onclick="show_confirm('{translate $msg_report}','messages.php?type=personal&act=report&id={$m.id}')">{translate Report}</a>
                                <a class="ignore link" onclick="show_confirm('{translate $msg_ignore}','messages.php?type=personal&act=ignore&id={$m.from}')">{translate Ignore}</a>
                                {/if}
                                {/if}
                            </div>
                        </div>
                    </div>
                    <div class="separator" style="float: left;"></div>
                    {/foreach}
                    {if $subaction != 'sent'}
                    <input type="submit" class="standart-button" value="{translate 'Delete selected'}" style="margin-right: 40px;"/></a>
                    <a href="messages.php?type={$subaction}&act=deleteAll" class="standart-button"><label class="link">{translate 'Delete all'}</label></a>
                    {/if}
                </form>
                {if $pages > 1}
                <div class="paging_nav">
                    <a class="prev_page {if $page == 1}prev-no-link{/if}" {if $page > 1}href="messages.php?type={$subaction}&page={$page-1}"{/if}></a>
                    {if $page > 3}<a class="page_button" {if $page != 1}href="messages.php?type={$subaction}&page=1"{/if}><span>1</span></a>{/if}
                    {if $page > 4}...{/if}
                    {if $page - 2 > 0}<a class="page_button" href="messages.php?type={$subaction}&page={$page - 2}"><span>{$page - 2}</span></a>{/if}
                    {if $page - 1 > 0}<a class="page_button" href="messages.php?type={$subaction}&page={$page - 1}"><span>{$page - 1}</span></a>{/if}
                    
                    <a class="page_button active" ><span>{$page}</span></a>
                    
                    {if $page + 1 <= $pages}<a class="page_button" href="messages.php?type={$subaction}&page={$page + 1}"><span>{$page + 1}</span></a>{/if}
                    {if $page + 2 <= $pages}<a class="page_button" href="messages.php?type={$subaction}&page={$page + 2}"><span>{$page + 2}</span></a>{/if}
                    {if $page < $pages - 3}...{/if}
                    {if $page <= $pages - 3}<a class="page_button" href="messages.php?type={$subaction}&page={$pages}"><span>{$pages}</span></a>{/if}
                    <a class="next_page {if $page == $pages}next-no-link{/if}" {if $page < $pages}href="messages.php?type={$subaction}&page={$page+1}"{/if}></a>
                </div>
                {/if}
                {else}
                <div class="empty">{translate 'You have no messages in this section.'}</div>
                <div class="separator"></div>
                <a href="messages.php" class="standart-button"><label class="link">{translate Back}</label></a>
                {/if}
            </div>
        </div>
        {include 'views/message_panel.php'}
        <script>
            $('a.replay').click(function(){
                var username = $(this).attr('id');
                $('input[name=user]').val(username);
            });
        </script>