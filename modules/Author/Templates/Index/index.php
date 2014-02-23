<?php /*страница автора*/ ?>

<div class="row-fluid">
    <div class="span12">
        <div id="legend">
            <legend><?=$Author->name?></legend>
        </div>

        <div class="row-fluid">
            <div class="span1">
                <img class="img-polaroid" src="/upload/avatar/<?php if($Author->avatar): ?><?=$Author->avatar?><?php else: ?>noavatar.jpg<?php endif; ?>" title="<?=$Author->name?>">
            </div>
            <div class="span10"></div>
        </div>

        
        <table class="table">
            <thead>
                <th colspan="3">Рецензии <small>[<?=$reviewsCount?>]</small></th>
            </thead>

            <?php foreach($reviewsList as $Review): ?>
            <tr>
                <td style="width: 120px;">
                    <img class="img-polaroid poster-mini" src="/upload/posters/<?=$Review->movie_poster?>" title="<?=$Review->movie_name?> (<?=$Review->movie_name_native?>)">
                </td>
                <td>
                    <a href="/movie/<?=$Review->movie_alias?>"><?=$Review->movie_name?> / <?=$Review->movie_name_native?></a> (<?=$Review->movie_release_year?>)
                    <?php /*
                    <br>
                    <em><small><a href="/source/<?=$Review->source_id?>"><?=$Review->source_name?></a></small></em> 
                    */ ?>
                </td>
                
                <td>
                    <?=strip_tags($Review->content)?> ...   
                    <br>
                    <a href="/review/<?=$Review->id?>">Полный текст</a> <em><?=$Review->original_date?></em>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <?=$pager?>

    </div>
</div>    

