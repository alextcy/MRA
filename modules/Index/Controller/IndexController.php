<?php
namespace Index\Controller;

use core\Controller;

class IndexController extends Controller
{
    
    public function indexAction()
    {
        echo 'index controller in test';
        
        //header('Location: /domains');
    }
}