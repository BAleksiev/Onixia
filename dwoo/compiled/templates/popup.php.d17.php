<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="popupWindow">
    <div class="close" onclick="javascript: closePopup(100);"></div>
    <form action="../messages.php" method="POST">
        <div class="title">
            <?php echo translate('To');?>: 
            <input type="text" name="user" style="width: 250px;"/>
        </div>
        <div class="content">
            <textarea name="content" class="msg" style="width: 400px;"></textarea>
        </div>
        </form>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>