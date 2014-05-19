<?php


/**
 * Description of ConfigParse
 *
 * @author alextcy
 */
class ConfigParse
{
    public static $reviewSources = array(
        'kinoart.ru' => array(
            'xpath'    => "//article[@class='item-page']/div[@class='img-fulltext-left']/img | //article[@class='item-page']//p | //article[@class='item-page']//p//img",
            'encoding' => 'UTF-8'
        ),
        'www.kinokadr.ru' => array(
            'xpath'    => "//div[@class='hreview']/p[@class='art'] | //div[@class='hreview']/div[@class='img']//img",
            'encoding' => 'WINDOWS-1251'
        ),
        'kinodom.org' => array(
            'xpath'    => "//div[@class='full_recenz']//img | //div[@class='full_recenz']//div[@class='full_rec1']", //текст сплошным куском
            'encoding' => 'WINDOWS-1251'
        ),
        'kino-teatr.ru' => array(
            'xpath'    => "//div[@class='art']//p | //div[@class='art']/center/img", 
            'encoding' => 'WINDOWS-1251'
        ),
        
        'kinotom.org' => array(
            'xpath'    => "//div[@id='singe-content']/p | //div[@id='singe-content']/p//img", 
            'encoding' => 'UTF-8'
        ),
        
        'www.kino-govno.com' => array(
            'xpath'    => "//div[@id='div_text1']//div | //div[@id='div_text2']//div | //table[@class='gall']//img", //маленькие картинки
            'encoding' => 'UTF-8'
        ),
        'weburg.net' => array(
            'xpath'    => "//div[@id='show_news']//div[@class='description']//p[not(@class = 'newsauthor news_public_date')] | //div[@id='show_news']//div[@class='description']//p//img | //div[@id='show_news']//div[@class='preview']//img",
            'encoding' => 'WINDOWS-1251'
        ),
        'ovideo.ru' => array(
            'xpath'    => "//div[@class='text']//p | //div[@class='rev-image']//img",
            'encoding' => 'UTF-8'
        ),
        'www.exler.ru' => array(
            'xpath'    => "//div[@id='article']//p[not(@align = 'center')] | //div[@id='article']//p[not(@align = 'center')]//img",
            'encoding' => 'WINDOWS-1251'
        ),
        'kino.open.ua' => array(
            'xpath'    => "//div[@id='text_body']/p[not(@align='right')] | //div[@id='text_body']/p[not(@align='right')]//img",
            'encoding' => 'WINDOWS-1251'
        ),
        'open.ua' => array(
            'xpath'    => "//div[@class='item']/div[@class='body']/div//p | //div[@class='item']/div[@class='body']/div//p//img",
            'encoding' => 'UTF-8'
        ),
        'www.filmz.ru' => array(
            'xpath'    => "//div[@class='main-block']/div[@class='content br5']//div[@class='text'][1]//p | //div[@class='main-block']/div[@class='content br5']//img[@class='maximgwidth br5']",
            'encoding' => 'WINDOWS-1251'
        ),
        //текст сплошным куском
        'www.kinonews.ru' => array(
            'xpath'    => "//div[@class='textart'] | //div[@class='block-main']/div[@class='block-page']//div[@style='float:left;width:190px;']/img",
            'encoding' => 'WINDOWS-1251'
        ),
        //нет даты публикации
        'critic.by' => array(
            'xpath'    => "//div[@class='recenz']/p | //div[@class='tizer'][1]//div[@class='block_tizer_full']/img[not(@alt='')]",
            'encoding' => 'UTF-8'
        ),
        'www.film.ru' => array(
            'xpath'    => "//div[@class='text']/div[@id='selectable-content']/p |  //div[@class='text']/div[@id='selectable-content']/div[@class='photo']//img",
            'encoding' => 'UTF-8'
        ),
        //(дата в анонсе стоит)
        'www.kinoafisha.info' => array(
            'xpath'    => "//div[@class='review-text']/p[not(@class='attention')] | //div[@class='description']/a[@id='poster']/img",
            'encoding' => 'WINDOWS-1251'
        ),
        'meownauts.com' => array(
            'xpath'    => "//div[@class='entry clearfix']//p |  //div[@class='entry clearfix']/p//img",
            'encoding' => 'UTF-8'
        ),
        'www.uralweb.ru' => array(
            'xpath'    => "//div[@id='article_body']/p | //div[@id='article_body']/p//img",
            'encoding' => 'UTF-8'
        ),
        'www.vedomosti.ru' => array(
            'xpath'    => "//div[@class='article_text']//p | //div[@class='article_gallery']/img",
            'encoding' => 'WINDOWS-1251'
        ),
        'www.thr.ru' => array(
            'xpath'    => "//main/section[@class='content']//p | //main/section[@class='content']//figure//img",
            'encoding' => 'WINDOWS-1251'
        ),
        'www.pravda.ru' => array(
            'xpath'    => "//div[@id='article']//p | //div[@id='article']//div/img[@class='article_image']",
            'encoding' => 'UTF-8'
        ),
        
        
        # 
        
        #  25-k.com только в ручном режиме (две рецензии сразу и невозможно парсить)
        #  
        
        #www.tramvision.ru - все на таблицах нерелаьно парсить
        #www.timeout.ru - очень краткие зарисовки
        #www.rg.ru - нихрена найти нельзя
    );
    
}
