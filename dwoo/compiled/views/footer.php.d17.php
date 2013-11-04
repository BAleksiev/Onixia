<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        </div>
        <div id="footer">
<!--            <div class="devel">Developed by b.aleksiev</div>-->
        </div>
        <script>
            <?php if ((isset($this->scope["errors"]) ? $this->scope["errors"] : null)) {
?>
                $("#system_messages_popup").overlay({
                    mask: '#000',
                    effect: 'apple',
                    load: true
                });
            <?php 
}?>

            
            $(function() {
                $("a[rel]").overlay({
                    mask: '#000',
                    effect: 'apple'
                });
            });
        </script>
        <noscript>
            <div id="noscript-bg"></div>
            <div id="noscript-panel">
                <div class="smp-header">
                    <?php echo translate('System message');?>

                </div>
                <div class="smp-body">
                    <b><?php echo translate('This site makes extensive use of JavaScript.');?></b><br/>
                    Please <a href="https://www.google.com/support/adsense/bin/answer.py?answer=12654" target="_blank">enable JavaScript</a> in your browser.
                </div>
                <div class="smp-footer">
                    <a class="button" href="<?php echo $this->scope["url"];?>"><span><span><?php echo translate('Reload page');?></span></span></a>
                </div>
            </div>
        </noscript>
    </body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>