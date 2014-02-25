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
    );
    
}
