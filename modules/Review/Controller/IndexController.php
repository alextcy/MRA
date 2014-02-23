<?php
namespace Review\Controller;

use core\Controller;
use Review\Model\Reviews;

/**
 * Description of IndexController
 *
 * @author alextcy
 */
class IndexController extends Controller
{
    //просмотр полного текста рецензии
    public function indexAction($id)
    {
        try {
            
            $ReviewsModel = new Reviews();
            $Review = $ReviewsModel->getReview($id);
            
            if($Review === false) {
                throw new \core\NotfoundException('Нет такой рецензии.');
            }
            
            $this->View->setVar('Review', $Review);
            
            return $this->View->fetch($this->templatePath. '/Index/index');
        } catch (\core\NotfoundException $ex) {
            return $this->showError($ex->getMessage(), 404);
        } catch (\core\GException $ex) {
            return $this->showError($ex->getMessage());    
        }
    }        
            
    
}
