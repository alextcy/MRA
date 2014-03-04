<?php /*добавление ссылок в очередь для парсинга рецензий */ ?>

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
                    <input type="text" class="input-medium">
                    <?php if(isset($messages['error']['movie_id'])): ?><span class="help-inline"><?=$messages['error']['movie_id']?></span><?php endif; ?>
                </div>
            </div>
            
            <div class="control-group <?php if(isset($messages['error']['author_id'])): ?>error<?php endif; ?>">
                <label class="control-label" for="">Автор</label>
                <div class="controls">
                    <input type="hidden" name="author_id" value="">
                    <input type="text" class="input-medium">
                    <?php if(isset($messages['error']['author_id'])): ?><span class="help-inline"><?=$messages['error']['author_id']?></span><?php endif; ?>
                </div>
            </div>
            
            <div class="control-group <?php if(isset($messages['error']['source_id'])): ?>error<?php endif; ?>">
                <label class="control-label" for="">Источник</label>
                <div class="controls">
                    <input type="hidden" name="source_id" value="">
                    <input type="text" class="input-medium">
                    <?php if(isset($messages['error']['source_id'])): ?><span class="help-inline"><?=$messages['error']['source_id']?></span><?php endif; ?>
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

