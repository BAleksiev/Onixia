<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="uni_map">
                <div class="alpha">
                    <div class="galaxy a1">
                        <a href="galaxy.php?g=a1">
                            
                        </a>
                    </div>
                    <div class="galaxy a2">
                        <a href="galaxy.php?g=a2">
                            
                        </a>
                    </div>
                    <div class="galaxy a3">
                        <a href="galaxy.php?g=a3">
                            
                        </a>
                    </div>
                </div>
                <div class="neutral">
                    <div class="galaxy n2">
                        <a href="galaxy.php?g=2">
                            
                        </a>
                    </div>
                    <div class="galaxy n1">
                        <a href="galaxy.php?g=1">
                            
                        </a>
                    </div>
                    <div class="galaxy n3">
                        <a href="galaxy.php?g=3">
                            
                        </a>
                    </div>
                </div>
                <div class="beta">
                    <div class="galaxy b1">
                        <a href="galaxy.php?g=b1">
                            
                        </a>
                    </div>
                    <div class="galaxy b2">
                        <a href="galaxy.php?g=b2">
                            
                        </a>
                    </div>
                    <div class="galaxy b3">
                        <a href="galaxy.php?g=b3">
                            
                        </a>
                    </div>
                </div>
            </div>
        </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>