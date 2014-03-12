<?php
namespace Review\Controller;

use core\Controller;
use Review\Model\Reviews;
use Review\Model\Search;


/**
 * Description of QueueController
 *
 * @author alextcy
 */
class QueueController extends Controller
{
    
    public function addAction()
    {
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
}
