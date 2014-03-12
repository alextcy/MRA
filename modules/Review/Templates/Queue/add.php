<?php /*добавление ссылок в очередь для парсинга рецензий */ ?>

<script type="text/javascript" src="<?=$templateFolder?>/js/queue.js"></script>

<div class="row-fluid">
    <div class="span12">
      
        <?php if(isset($messages['error']['default'])): ?>
        <div class="alert alert-error"><?=$messages['error']['default']?></div>
        <?php endif; ?>
        
        <form class="form-horizontal" method="post">
            
            <div id="legend">
                <legend class="">Добавить рецензию в очередь</legend>
            </div>
            
            <div class="control-group <?php if(isset($messages['error']['movie_id'])): ?>error<?php endif; ?>">
                <label class="control-label" for="">Фильм</label>
                <div class="controls">
                    <input type="hidden" name="movie_id" value="">
                    <input type="text" class="input-xlarge typeahead-movie">
                    <?php if(isset($messages['error']['movie_id'])): ?><span class="help-inline"><?=$messages['error']['movie_id']?></span><?php endif; ?>
                </div>
            </div>
            
            <div class="control-group <?php if(isset($messages['error']['author_id'])): ?>error<?php endif; ?>">
                <label class="control-label" for="">Автор</label>
                <div class="controls">
                    <input type="hidden" name="author_id" value="">
                    <input type="text" class="input-medium typeahead-author">
                    <?php if(isset($messages['error']['author_id'])): ?><span class="help-inline"><?=$messages['error']['author_id']?></span><?php endif; ?>
                </div>
            </div>
            
            <div class="control-group <?php if(isset($messages['error']['source_id'])): ?>error<?php endif; ?>">
                <label class="control-label" for="">Источник</label>
                <div class="controls">
                    <input type="hidden" name="source_id" value="">
                    <input type="text" class="input-medium typeahead-source">
                    <?php if(isset($messages['error']['source_id'])): ?><span class="help-inline"><?=$messages['error']['source_id']?></span><?php endif; ?>
                </div>
            </div>
            
            <div class="control-group <?php if(isset($messages['error']['original_url'])): ?>error<?php endif; ?>">
                <label class="control-label" for="original_url">Рецензия (URL)</label>
                <div class="controls">
                    <input type="text" class="input-medium" name="original_url">
                    <?php if(isset($messages['error']['original_url'])): ?><span class="help-inline"><?=$messages['error']['original_url']?></span><?php endif; ?>
                </div>
            </div>
            
            <div class="control-group">
                <div class="controls">
                    <button type="submit" name="save" class="btn">Сохранить</button>
                </div>
            </div>
            
        </form>
        
    </div>
</div>

