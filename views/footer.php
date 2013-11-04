        </div>
        <div id="footer">
<!--            <div class="devel">Developed by b.aleksiev</div>-->
        </div>
        <script>
            {if $errors}
                $("#system_messages_popup").overlay({
                    mask: '#000',
                    effect: 'apple',
                    load: true
                });
            {/if}
            
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
                    {translate 'System message'}
                </div>
                <div class="smp-body">
                    <b>{translate 'This site makes extensive use of JavaScript.'}</b><br/>
                    Please <a href="https://www.google.com/support/adsense/bin/answer.py?answer=12654" target="_blank">enable JavaScript</a> in your browser.
                </div>
                <div class="smp-footer">
                    <a class="button" href="{$url}"><span><span>{translate 'Reload page'}</span></span></a>
                </div>
            </div>
        </noscript>
    </body>
</html>