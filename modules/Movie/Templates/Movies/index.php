<?php /* список фильмов */ ?>

<div class="row-fluid">
    <div class="span12">
        <div id="legend">
            <legend>Новинки кино</legend>
        </div>
        
        <?php /*
        <div class="row-fluid">
            <div class="span2">
                <a href="/movie/"><img class="img-polaroid" src="/upload/posters/" title="<?=$Movie->name?> (<?=$Movie->name_native?>)"></a>
            </div>
            <div class="span4">
                <p></p>
                <p>Премьера: </p>
                <p>Рецензий: </p>
            </div>
            <div class="span2">
                <a href="/movie/"><img class="img-polaroid" src="/upload/posters/" title="<?=$Movie->name?> (<?=$Movie->name_native?>)"></a>
            </div>
            <div class="span4">
                <p></p>
                <p>Премьера: </p>
                <p>Рецензий: </p>
            </div>
        </div>
        <div class="row-fluid"><div class="span12"></div></div>
        */ ?>
        
        
        <?php foreach($Movies as $index=>$Movie): ?>
            <?php if(($index % 2) == 0): ?>
            <div class="row-fluid">
            <?php endif; ?>    

                <div class="span2">
                    <a href="/movie/<?=$Movie->alias?>"><img class="img-polaroid" src="/upload/posters/<?=$Movie->poster?>" title="<?=$Movie->name?> (<?=$Movie->name_native?>)"></a>
                </div>
                <div class="span4">
                    <p><a href="/movie/<?=$Movie->alias?>"><?=$Movie->name?> / <?=$Movie->name_native?> (<?=$Movie->release_year?>)</a></p>
                    <p>Премьера: <?=$Movie->release_date?></p>
                    <p>Рецензий: <?=$Movie->reviews_count?></p>
                </div>

            <?php if(($index % 2) != 0 or ($index == count($Movies)-1) ): ?>    
            </div>
            <div class="row-fluid"><div class="span12"></div></div>
            <?php endif; ?>
        <?php endforeach; ?>
        

        

        <?=$pager?>

    </div>
</div>    
