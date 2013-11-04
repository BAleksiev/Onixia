<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page">
                
            </div>
        </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>