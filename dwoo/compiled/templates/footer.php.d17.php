<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        </div>
        <div id="footer">
<!--            <div class="devel">Developed by b.aleksiev</div>-->
        </div>
        <script>
            var errors = <?php echo sizeof((isset($this->scope["errors"]) ? $this->scope["errors"] : null));?>;
            for(var i=0; i < errors; i++) {
                <?php echo $this->assignInScope(0, 'i');?>

                err += '<?php echo $this->readVar("errors.".(isset($this->scope["i"]) ? $this->scope["i"] : null));?>' + '\r';
                <?php echo $this->assignInScope(((isset($this->scope["i"]) ? $this->scope["i"] : null) + 1), 'i');?>

            }
            if(err)
                alert(err);
        </script>
    </body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>