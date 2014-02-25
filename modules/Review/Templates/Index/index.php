<?php /*текст рецензии*/ ?>
<div class="row-fluid">
    <div class="span12">
        <div id="legend">
            <legend>Рецензия: <a href="/movie/<?=$Review->movie_alias?>"><?=$Review->movie_name?> / <?=$Review->movie_name_native?> (<?=$Review->movie_release_year?>)</a></legend>
        </div>
        
        <div class="row-fluid">
            <div class="span10 content-block">
                
                    <blockquote>
                        <p><a href="/author/<?=$Review->author_id?>" title="Рецензии критика"><?=$Review->author_name?></a></p>
                        <small>Оригинал: <a href="<?=$Review->original_url?>"><?=$Review->source_name?></a> </small>
                        <small>Дата публикации: <?=$Review->original_date?> </small>
                    </blockquote>
                
                <?=$Review->content?>
            </div>
        </div>
        
    </div>
</div>


