<?php
namespace Review\Controller;

use core\Controller;
use Review\Model\Reviews;
use Review\Model\ReviewQueue;
use Review\Model\Search;


/**
 * Description of QueueController
 *
 * @author alextcy
 */
class QueueController extends Controller
{
    protected $messages = array(
        'error' => array()
    );
    
    public function addAction()
    {
        try {
            $ReviewsModel     = new Reviews();
            $ReviewQueueModel = new ReviewQueue();
            
            if(isset($_POST['save'])) {
                $this->add($ReviewsModel, $ReviewQueueModel);
            }
            
            $this->View->setVar('movie_id'    , (int)$this->Request->formGet('movie_id'));
            $this->View->setVar('movie_name'  , $this->Request->formGet('movie_name'));
            
            $this->View->setVar('author_id'   , (int)$this->Request->formGet('author_id'));
            $this->View->setVar('author_name' , $this->Request->formGet('author_name'));
            
            $this->View->setVar('source_id'   , (int)$this->Request->formGet('source_id'));
            $this->View->setVar('source_name' , $this->Request->formGet('source_name'));
            
            $this->View->setVar('original_date', $this->Request->formGet('original_date'));
            $this->View->setVar('original_url', $this->Request->formGet('original_url'));
            
        } catch (\core\GException $ex) {
            $this->messages['error']['exception'] = $ex->getMessage();
            $this->View->setVar('messages'    , $this->messages );
        }
        
        return $this->View->fetch($this->templatePath. '/Queue/add');
    }
    
    
    public function searchAction()
    {
        try {
            $type    = $this->Request->POST('type'); // movie|author|source
            $keyword = $this->Request->POST('keyword');
            
            $SearchModel = new Search();
            $movies = $SearchModel->find($type, $keyword);
            
            $this->sendAjaxResponse(array('list'=>$movies));
        } catch (\Exception $ex) {
            $this->sendAjaxError($ex->getMessage());
        }
    }
    
    /**
     * 
     * @param Reviews $ReviewsModel
     * @param ReviewQueue $ReviewQueueModel
     * @return boolean
     */
    private function add($ReviewsModel, $ReviewQueueModel)
    {
        $movieId  = (int)$this->Request->POST('movie_id');
        $authorId = (int)$this->Request->POST('author_id');
        $sourceId = (int)$this->Request->POST('source_id');
        $originalDate = trim((string)$this->Request->POST('original_date'));
        $originalUrl = trim((string)$this->Request->POST('original_url'));
        
        $this->_validatePostData($movieId, $authorId, $sourceId, $originalDate, $originalUrl);
        if(count($this->messages['error'])){
            $this->View->setVar('messages', $this->messages);
            return false;
        }

        //добавили данные по рецензии (со статусом скрыто)
        $Review = $ReviewsModel->create();
        $Review->set('author_id', $authorId);
        $Review->set('movie_id', $movieId);
        $Review->set('source_id', $sourceId);
        $Review->set('original_url', $originalUrl);
        $Review->set('original_date', $originalDate);
        $Review->save();
        $reviewId = $Review->id();
        
        //добавили в очередь на парсинг
        $ReviewQueueModel->addToQueue($reviewId);
        
        //просто кудато его нужно перенаправить
        header('Location: /author/'.$authorId);
    }
    
    private function _validatePostData($movieId, $authorId, $sourceId, $originalDate, $originalUrl)
    {
        if($movieId == 0) {
            $this->messages['error']['movie_id'] = 'Не указан фильм!';
        }
        
        if($authorId == 0) {
            $this->messages['error']['author_id'] = 'Не указан автор!';
        }
        
        if($sourceId == 0) {
            $this->messages['error']['source_id'] = 'Не указан источник!';
        }
        
        if($originalDate === '') {
            $this->messages['error']['original_date'] = 'Не верно указана дата!';
        }
        
        if($originalUrl === '') {
            $this->messages['error']['original_url'] = 'Не указана рецензия!';
        }
    }
}
