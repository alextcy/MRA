<?php
namespace Movie\Controller;

use core\Controller;
use Mra\Pager;
use Movie\Model\Movies;
//use Review\Model\Reviews;

/**
 * Список фильмов
 *
 * @author alextcy
 */
class MoviesController extends Controller
{
    public function indexAction()
    {
        $page = (int)$this->Request->GET('page', 1);
        
        $MoviesModel = new Movies();
        list($Movies, $MoviesCount) = $MoviesModel->getList(0, 10);
        
        $this->View->setVar('Movies', $Movies);
        $this->View->setVar('pager'        , $this->_getPager($page, $MoviesCount, \Config::MOVIES_ON_PAGE, '/movies'));
        
        return $this->View->fetch($this->templatePath. '/Movies/index');
    }

    
    private function _getPager($page, $records, $itemsOnPage, $url)
    {
        if(!(int)$records) {
            return '';
        }

        $pageParamName = '?page=';
        
        $Pager = new Pager($records, $itemsOnPage);
        return $Pager->draw($page, $url, $pageParamName);
    }
}
