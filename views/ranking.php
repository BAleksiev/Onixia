        <div id="content">
            <div class="page ranking">
                <h2 class="title">{translate 'Ranking'}</h2>
                {if $pages > 1}
                <div class="paging_nav">
                    <a class="prev_page {if $page == 1}prev-no-link{/if}" {if $page > 1}href="ranking.php?page={$page-1}"{/if}></a>
                    {if $page > 3}<a class="page_button" {if $page != 1}href="ranking.php?page=1"{/if}><span>1</span></a>{/if}
                    {if $page > 4}...{/if}
                    {if $page - 2 > 0}<a class="page_button" href="ranking.php?page={$page - 2}"><span>{$page - 2}</span></a>{/if}
                    {if $page - 1 > 0}<a class="page_button" href="ranking.php?page={$page - 1}"><span>{$page - 1}</span></a>{/if}

                    <a class="page_button active" ><span>{$page}</span></a>

                    {if $page + 1 <= $pages}<a class="page_button" href="ranking.php?page={$page + 1}"><span>{$page + 1}</span></a>{/if}
                    {if $page + 2 <= $pages}<a class="page_button" href="ranking.php?page={$page + 2}"><span>{$page + 2}</span></a>{/if}
                    {if $page < $pages - 3}...{/if}
                    {if $page <= $pages - 3}<a class="page_button" href="ranking.php?page={$pages}"><span>{$pages}</span></a>{/if}
                    <a class="next_page {if $page == $pages}next-no-link{/if}" {if $page < $pages}href="ranking.php?page={$page+1}"{/if}></a>
                </div>
                {/if}
                <table border="0" class="standart left">
                    <thead>
                        <tr class="head">
                            <td class="cell20"></td>
                            <td class="player">{translate Player}</td>
                            <td class="cell20">{translate Level}</td>
                            <td width="15%">{translate 'War points'}</td>
                            <td width="20%">{translate 'Resource points'}</td>
                            <td width="15%">{translate Points}</td>
                        </tr>
                    </thead>
                    <tbody>
                        {assign 0 n}
                        {foreach $ranking r}
                        {assign $n+1 n}
                        <tr>
                            <td class="id">{$n}</td>
                            <td class="player {if $user.id == $r.id}active{/if}">{$r.user}</td>
                            <td class="active">{$r.race}</td>
                            <td>{number_format $r.war_points,0,'.',' '}</td>
                            <td>{number_format $r.points,0,'.',' '}</td>
                            <td class="active">{number_format($r.points+$r.war_points,0,'.',' ')}</td>
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
                {if $pages > 1}
                <div class="paging_nav">
                    <a class="prev_page {if $page == 1}prev-no-link{/if}" {if $page > 1}href="ranking.php?page={$page-1}"{/if}></a>
                    {if $page > 3}<a class="page_button" {if $page != 1}href="ranking.php?page=1"{/if}><span>1</span></a>{/if}
                    {if $page > 4}...{/if}
                    {if $page - 2 > 0}<a class="page_button" href="ranking.php?page={$page - 2}"><span>{$page - 2}</span></a>{/if}
                    {if $page - 1 > 0}<a class="page_button" href="ranking.php?page={$page - 1}"><span>{$page - 1}</span></a>{/if}

                    <a class="page_button active" ><span>{$page}</span></a>

                    {if $page + 1 <= $pages}<a class="page_button" href="ranking.php?page={$page + 1}"><span>{$page + 1}</span></a>{/if}
                    {if $page + 2 <= $pages}<a class="page_button" href="ranking.php?page={$page + 2}"><span>{$page + 2}</span></a>{/if}
                    {if $page < $pages - 3}...{/if}
                    {if $page <= $pages - 3}<a class="page_button" href="ranking.php?page={$pages}"><span>{$pages}</span></a>{/if}
                    <a class="next_page {if $page == $pages}next-no-link{/if}" {if $page < $pages}href="ranking.php?page={$page+1}"{/if}></a>
                </div>
                {/if}
            </div>
        </div>