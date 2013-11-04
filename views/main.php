        <div id="content">
            <div class="page">
                <h2 class="title">{translate 'Main'}</h2>
                <?php foreach($enemyFlights as $ef) {
                    $te=time()-$ef['time_end'];
                    echo 'Вражеската флота от <a href="maps.php?c1='.$ef['tc1'].'&c2='.$ef['tc2'].'&c3='.$ef['tc3'].'">
                        '.$ef['tc1'].':'.$ef['tc2'].':'.$ef['tc3'].'</a> приближава към родната планета ! Удър след: '.timeConvert($te);
                } ?>
            </div>
        </div>