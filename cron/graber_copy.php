<?php
ini_set("display_errors", 'On');
ini_set("error_reporting", E_ALL | E_ERROR | E_NOTICE || ~E_STRICT);

$chunkPath = explode(DIRECTORY_SEPARATOR, __DIR__);
array_pop($chunkPath);

define('DOCUMENT_ROOT' , implode(DIRECTORY_SEPARATOR, $chunkPath));
define('PROD', isProdEnv());

require DOCUMENT_ROOT . '/autoload.php';

if(PROD) {
    require DOCUMENT_ROOT . '/config/config.php';
} else {
    require DOCUMENT_ROOT . '/config/local/config.php';
}

function isProdEnv()
{
    if(array_key_exists('APP_ENV', $_SERVER) and $_SERVER['APP_ENV'] == 'dev') {
        return false;
    }
    return true;
}
//----------------------------------------------------------------------
use RollingCurl\RollingCurl;
use Symfony\Component\DomCrawler\Crawler;
use Mra\ImageGrabber;

/*$ImageGrabber = new ImageGrabber();
$ImageGrabber->setImageUrl('http://www.kritikanstvo.ru/movies/m/monumentsmen/posters/monumentsmen_3.jpg');
$ImageGrabber->setUploadFolder(DOCUMENT_ROOT . '/upload/reviews/'.  date('Y', time()) .'/'. date('m', time()) .'/'. date('d', time()).'/robocop/');
$res = $ImageGrabber->grab();
var_dump($res);exit;*/

$RollingCurl = new RollingCurl();

//$urlReview = 'http://kinoart.ru/ru/blogs/volk-iz-dzhunglej'; //utf-8
//$urlReview = 'http://kinodom.org/recenzii/3802-recenziya-na-film-robokop.html'; //windows-1251
//$urlReview = 'http://www.kino-govno.com/movies/thatakwardmoment/reviews/reira';
//$urlReview = 'http://weburg.net/news/49175';
$urlReview = 'http://www.ovideo.ru/%D0%A0%D0%B5%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_%D0%BD%D0%B0_%D1%84%D0%B8%D0%BB%D1%8C%D0%BC_%D0%9B%D1%8E%D0%B1%D0%BE%D0%B2%D1%8C_%D1%81%D0%BA%D0%B2%D0%BE%D0%B7%D1%8C_%D0%B2%D1%80%D0%B5%D0%BC%D1%8F_1';

$xpathRules = array(
    'kinoart.ru'  => "//article[@class='item-page']/div[@class='img-fulltext-left']/img | //article[@class='item-page']//p | //article[@class='item-page']//p//img",
    'kinodom.org' => "//div[@class='full_recenz']//img | //div[@class='full_recenz']//div[@class='full_rec1']", //текст сплошным куском
    'www.kino-govno.com' => "//div[@id='div_text1']//div | //div[@id='div_text2']//div | //table[@class='gall']//img", //маленькие картинки
    'weburg.net' => "//div[@id='show_news']//div[@class='description']//p[not(@class = 'newsauthor news_public_date')] | //div[@id='show_news']//div[@class='description']//p//img",
    'ovideo.ru' => "//div[@class='text']//p | //div[@class='rev-image']//img",
    
);
$encodingSources = array(
    'kinoart.ru'  => 'UTF-8',
    'kinodom.org' => 'WINDOWS-1251',
    'www.kino-govno.com' => 'UTF-8',
    'weburg.net' => 'WINDOWS-1251',
    'ovideo.ru' => 'UTF-8'
);

$RollingCurl->get($urlReview);
$response = $RollingCurl->execute();

$response['output'] = iconv($encodingSources['ovideo.ru'], 'UTF-8', $response['output']);
//var_dump($response['output']);exit;
$htmlContent = mb_convert_encoding($response['output'], 'HTML-ENTITIES', 'UTF-8');

$Crawler = new Crawler($htmlContent);

$NodesList = $Crawler->filterXPath($xpathRules['ovideo.ru']);

$ImageGrabber = new ImageGrabber();

//var_dump($NodesList);exit;
$reviewContent = '';
foreach($NodesList as $NodeElem) {
    
    if($NodeElem->nodeName == 'img') {
        
        $movie = 'robocop';
        $uploadFolder = '/upload/reviews/'.  date('Y', time()) .'/'. date('m', time()) .'/'. date('d', time()).'/'.$movie.'/';
        
        $ImageGrabber->setImageUrl('http://ovideo.ru'. $NodeElem->getAttribute('src'));
        $ImageGrabber->setUploadFolder(DOCUMENT_ROOT.$uploadFolder);
        $fileNameDownloaded = $ImageGrabber->grab();
        
        //basename и свой путь (после грабинга) /upload/2012/03/12/{movieName}/basename({img})
        $reviewContent .= '<p><img src="'. $uploadFolder. $fileNameDownloaded.'"></p>';
    }else {
        $reviewContent .= '<p>'.$NodeElem->textContent.'</p>';
    }
}

var_dump($reviewContent);