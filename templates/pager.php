
<?php if($pagesCount > 1): ?>
<div class="pagination">
    <ul>
        <li <?php if($page==1): ?>class="disabled"<?php endif; ?>><a href="<?=htmlentities($pagePrevUrl)?>">«</a></li>
        
        <?php if($blockNum > 1): ?>
        <li><a href="<?=$pageFirstUrl?>">1</a></li>
        <li><span>...</span></li>
        <?php endif; ?>
        
        <?php foreach($pages as $Paginator): ?>
        <li <?php if($Paginator->number == $page): ?>class="active"<?php endif; ?>><a href="<?=htmlentities($Paginator->url)?>"><?=$Paginator->number?></a></li>
        <?php endforeach; ?>
        
        
        <?php if($blockNum < $blockNumLast): ?>
        <li><span>...</span></li>
        <li><a href="<?=htmlentities($pageLastUrl)?>"><?=$pagesCount?></a></li>
        <?php endif; ?>
        
        <li <?php if($page==$pagesCount): ?>class="disabled"<?php endif; ?>><a href="<?=htmlentities($pageNextUrl)?>">»</a></li>
    </ul>
</div>
<?php endif; ?>