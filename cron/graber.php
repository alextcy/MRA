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

require DOCUMENT_ROOT . '/config/ConfigParse.php';

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
use Review\Model\ReviewQueue;
use Review\Model\Reviews;
use Movie\Model\Movies;

//var_dump( ConfigParse::$reviewSources ); exit;

try {
    $ReviewsModel = new Reviews();
    $ReviewQueue = new ReviewQueue();
    $MoviesModel = new Movies();

    $RollingCurl = new RollingCurl();

    $reviewId = $ReviewQueue->getReviewIdFromQueue();
    if($reviewId===false) {
        throw new \core\GException('Нет рецензий в очереди.');
    }
    $reviewData = $ReviewsModel->getData($reviewId);
    $Movie = $MoviesModel->getMovie($reviewData->movie_id);

    $ReviewQueue->setStatusQueueInProgress($reviewId);

    $domain = parse_url($reviewData->original_url)['host']; 

    //получение содержимого страницы с рецензией
    $RollingCurl->get($reviewData->original_url);
    $response = $RollingCurl->execute();

    //преобразование кодировок
    $response['output'] = iconv(ConfigParse::$reviewSources[$domain]['encoding'], 'UTF-8', $response['output']);
    $htmlContent = mb_convert_encoding($response['output'], 'HTML-ENTITIES', 'UTF-8');
    
    //var_dump($response);exit;
       
    $Crawler = new Crawler($htmlContent);
    $NodesList = $Crawler->filterXPath(ConfigParse::$reviewSources[$domain]['xpath']);
    $ImageGrabber = new ImageGrabber();


    $reviewContent = '';
    foreach($NodesList as $NodeElem) {
        if($NodeElem->nodeName == 'img') {

            $uploadFolder = '/upload/reviews/'.  date('Y', time()) .'/'. date('m', time()) .'/'. date('d', time()).'/'.$Movie->alias.'/';

            $imageUrlData = parse_url($NodeElem->getAttribute('src'));
            if(!array_key_exists('host', $imageUrlData)) {
                if($domain == 'www.exler.ru') {
                    $imageUrl = 'http://'.$domain. '/films/'. $NodeElem->getAttribute('src');
                } else {
                    $imageUrl = 'http://'.$domain. $NodeElem->getAttribute('src');
                }
                
            } else {
                $imageUrl = $NodeElem->getAttribute('src');
            }
            
            $ImageGrabber->setImageUrl($imageUrl);
            //$ImageGrabber->setImageUrl('http://'.$domain. $NodeElem->getAttribute('src'));
            $ImageGrabber->setUploadFolder(DOCUMENT_ROOT.$uploadFolder);
            $fileNameDownloaded = $ImageGrabber->grab();

            //basename и свой путь (после грабинга) /upload/2012/03/12/{movieName}/basename({img})
            $reviewContent .= '<p><img src="'. $uploadFolder. $fileNameDownloaded.'"></p>';
        }else {
            $reviewContent .= '<p>'.$NodeElem->textContent.'</p>';
        }
    }


    //сохранить текст рецензии, visible, date_add
    /*$ReviewsModel->edit($reviewId)->set('content', $reviewContent)
                                  ->set('visible', 1)
                                  ->set('date_add', time())
                                  ->save();*/
    
    $Review = $ReviewsModel->edit($reviewId);
    $Review->set('content', $reviewContent);
    $Review->set('visible', 1);
    $Review->set('date_add', time());
    $Review->save();

    //убрать очередь
    $ReviewQueue->removeFromQueue($reviewId);
    exit(0);
} catch (\Exception $ex) {
    if(is_null($reviewId) or !$reviewId) { exit($ex->getMessage()); }
    $ReviewQueue->setStatusQueueError($reviewId, $ex->getMessage());
    
    echo $ex->getMessage()."\n".$ex->getFile()."\n".$ex->getLine();
    exit(1);
}


