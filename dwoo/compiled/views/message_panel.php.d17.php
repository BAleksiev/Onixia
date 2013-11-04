<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="overlay" id="message_panel">
    <div class="close"></div>
    <form action="send_message.php<?php if ((isset($this->scope["action"]) ? $this->scope["action"] : null) == 'messages' && (isset($this->scope["subaction"]) ? $this->scope["subaction"] : null) == 'personal') {

echo $this->scope["url_params"];

}?>" method="POST">
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
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>