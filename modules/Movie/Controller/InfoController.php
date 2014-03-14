<?php
namespace Movie\Controller;

use core\Controller;
use Mra\Pager;
use Movie\Model\Movies;
use Review\Model\Reviews;

class InfoController extends Controller
{

    /**
     * страница с инфой о фильме 
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public function indexAction($alias)
    {
        try {
            $page = (int)$this->Request->GET('page', 1);

            $MoviesModel = new Movies();
            $ReviewsModel = new Reviews();

            $movieId = $MoviesModel->getId($alias);
            if($movieId === false) {
                throw new \core\NotfoundException('Нет такого фильма');
            }

            $Movie = $MoviesModel->getMovie($movieId);


            list($reviewsList, $reviewsCount) = $ReviewsModel->getList($movieId, false, false, 1, \Config::REVIEWS_ON_PAGE*($page-1), \Config::REVIEWS_ON_PAGE);

            //vardump(\idiorm\ORM::get_last_query());

            $this->View->setVar('Movie'        , $Movie);
            $this->View->setVar('reviewsList'  , $reviewsList);
            $this->View->setVar('reviewsCount' , $reviewsCount);
            $this->View->setVar('pager'        , $this->_getReviewPager($page, $reviewsCount, \Config::REVIEWS_ON_PAGE, '/movie/'.$Movie->alias));

            return $this->View->fetch($this->templatePath. '/Info/index');

        } catch (\core\NotfoundException $ex) {
            return $this->showError($ex->getMessage(), 404);
        } catch (\core\GException $ex) {
            return $this->showError($ex->getMessage());    
        }
    }    


    private function _getReviewPager($page, $records, $itemsOnPage, $url)
    {
        if(!(int)$records) {
            return '';
        }
        
        //$url  = '/movie/';
        /*$_url = array();
        if($subjectId !== false) {
            $_url[] = 'subject_id=' . $subjectId;
        }
        if($regStatus !== false) {
            $_url[] = 'reg_status=' . $regStatus;
        }
        if($satelliteAttached !== 0) {
            $_url[] = 'sat_attached=' . $satelliteAttached;
        }
        
        if(count($_url)) {
            $url .= '?' . implode('&', $_url);
        }
        
        $pageParamName = (count($_url)) ? '&page=' : '?page=';
        */
        $pageParamName = '?page=';
        
        $Pager = new Pager($records, $itemsOnPage);
        return $Pager->draw($page, $url, $pageParamName);
    }
}