<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page">
                <div class="message404">
                    <label>ERROR 403/404</label><br/><br/>
                    Страницата, която се опитвате да отворите не съществува или е защитена !
                </div>
            </div>
        </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>