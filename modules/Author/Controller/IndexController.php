<?php
namespace Author\Controller;

use core\Controller;
use Mra\Pager;
use Author\Model\Authors;
use Review\Model\Reviews;

/**
 * Description of IndexController
 *
 * @author alextcy
 */
class IndexController extends Controller
{
    
    public function indexAction($id)
    {
        try {
            $page = (int)$this->Request->GET('page', 1);
            
            $AuthorsModel = new Authors();
            $ReviewsModel = new Reviews();
            
            /*$authorId = $AuthorsModel->getId($alias);
            if($authorId === false) {
                throw new \core\NotfoundException('Нет такой рецензии.');
            }*/
            
            $Author = $AuthorsModel->getData($id);
            if($Author === false) {
                throw new \core\NotfoundException('Нет такого рецензента.');
            }
            
            list($reviewsList, $reviewsCount) = $ReviewsModel->getList(false, $id, false, 1, \Config::REVIEWS_ON_PAGE*($page-1), \Config::REVIEWS_ON_PAGE);
            
            $this->View->setVar('Author', $Author);
            $this->View->setVar('reviewsList'  , $reviewsList);
            $this->View->setVar('reviewsCount' , $reviewsCount);
            $this->View->setVar('pager'        , $this->_getReviewPager($page, $reviewsCount, \Config::REVIEWS_ON_PAGE, '/author/'.$Author->id));
            
            return $this->View->fetch($this->templatePath. '/Index/index');
            
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
        
        $pageParamName = '?page=';
        
        $Pager = new Pager($records, $itemsOnPage);
        return $Pager->draw($page, $url, $pageParamName);
    }
}
