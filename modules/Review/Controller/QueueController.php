<?php
namespace Review\Controller;

use core\Controller;
use Review\Model\Reviews;


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
    
    
    
}
