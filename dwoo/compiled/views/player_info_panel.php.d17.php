<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="player_info_panel">
    <div class="fill">
        <div class="pi_title">
            <span><?php echo translate('Player options');?></span>
            <a class="close"></a>
        </div>
        <ul>
            <li class="player">
                <span class="title"><?php echo translate('Player');?></span>
                <span class="content"></span>
            </li>
            <li class="player_rank">
                <span class="title"><?php echo translate('Rank');?></span>
                <span class="content"></span>
            </li>
        </ul>
    </div>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>