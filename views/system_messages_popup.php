<div class="overlay" id="system_messages_popup">
    <div class="smp-header">
        {translate 'System message'}
    </div>
    <div class="smp-body">
        {if $errors}
        {foreach $errors e}
        {$e}<br/>
        {/foreach}
        {/if}
    </div>
    <div class="smp-footer">
        <div class="close button"><span><span>{translate 'Close'}</span></span></div>
    </div>
</div>