<div class="overlay" id="message_panel">
    <div class="close"></div>
    <form action="send_message.php{if $action == 'messages' && $subaction == 'personal'}{$url_params}{/if}" method="POST">
        <input class="submit" type="submit" value="Send" style="float: right; width: 100px;" />
        <div class="title">
            To: 
            <input type="text" name="user" style="width: 200px;" value="" />
        </div>
        <div class="content">
            Message: 
            <textarea name="content" class="msg"></textarea>
        </div>
    </form>
</div>