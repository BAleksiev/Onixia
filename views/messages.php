        <div id="content">
            <div class="page">
                <h2 class="title">{translate 'Messages'}</h2>
                <a href="messages.php?type=personal">
                    <div class="message">
                        {translate 'Personal mesages'}
                        <div class="logo personal"></div>
                        <label class="link">{$personalNew} / {$personalTot}</label>
                    </div>
                </a>
                <a href="messages.php?type=alliance">
                    <div class="message">
                        {translate Alliances}
                        <div class="logo alliance"></div>
                        <label class="link">{$allianceNew} / {$allianceTot}</label>
                    </div>
                </a>
                <a href="messages.php?type=spy">
                    <div class="message">
                        {translate 'Spy reports'}
                        <div class="logo spy"></div>
                        <label class="link">{$spyNew} / {$spyTot}</label>
                    </div>
                </a>
                <a href="messages.php?type=millitary">
                    <div class="message">
                        {translate 'Millitary reports'}
                        <div class="logo millitary"></div>
                        <label class="link">{$millitaryNew} / {$millitaryTot}</label>
                    </div>
                </a>
                <a href="messages.php?type=flights">
                    <div class="message">
                        {translate 'Landing zone'}
                        <div class="logo flights"></div>
                        <label class="link">{$flightsNew} / {$flightsTot}</label>
                    </div>
                </a>
                <a class="standart-button" rel="#message_panel">{translate 'Send message'}</a>
            </div>
        </div>
        {include 'views/message_panel.php'}