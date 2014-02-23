<?php /*страница с инфой о фильме*/ ?>
<div class="row-fluid">
    <div class="span12">
        <div id="legend">
            <legend><?=$Movie->name?> / <?=$Movie->name_native?> (<?=$Movie->release_year?>)</legend>
        </div>

        <div class="row-fluid">
            <div class="span2">
                <img class="img-polaroid" src="/upload/posters/<?=$Movie->poster?>" title="<?=$Movie->name?> (<?=$Movie->name_native?>)">
            </div>
            <div class="span10"><?=$Movie->description?></div>
        </div>

        
        <table class="table">
            <thead>
                <th colspan="2">Рецензии <small>[<?=$reviewsCount?>]</small></th>
            </thead>    

            <?php foreach($reviewsList as $Review): ?>
            <tr>
                <td class="span3">
                    <a href="/author/<?=$Review->author_id?>"><?=$Review->author_name?></a> 
                    <br>
                    <em><small><a href="/source/<?=$Review->source_id?>"><?=$Review->source_name?></a></small></em> 
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