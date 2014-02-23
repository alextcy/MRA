<?php
namespace core;

use core\AppController;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;

/**
 * Description of FrontController
 *
 * @author alextcy
 */
class FrontController
{
    private $_Request;

    private $_routeData = array(
        'module'              => null,
        'controller'          => null,
        'controller_filename' => null,
        'action'              => null,
        'params'              => null  
        
    );

    public function __construct(Request $Request)
    {
        $this->_Request = $Request;
        
        $this->_prepareRouteData();
    }

    public function execute()
    {
        try{
            if(!file_exists($this->_routeData['controller_filename'])) {
                throw new \Exception('Controller file not exist: '. $this->_routeData['controller_filename']);
            }
        
            $controllerAlias = $this->_routeData['module']."\\Controller\\".$this->_routeData['controller'];

            $AppController = new AppController($this->_Request);
            $AppController->setModuleName($this->_routeData['module'])
                          ->setControllerAlias($controllerAlias)
                          ->setMethodName($this->_routeData['action'])
                          ->setParams($this->_routeData['params'])   
                          ->execute();
            
        } catch (\Exception $ex) {
            $AppController = new AppController($this->_Request);
            $AppController->showError($ex->getMessage());
        }
    }

    /**
     * Формирует массив: имя сервиса, название контролера, действие, и путь к файлу запрашиваемого контроллера
     * 
     */
    private function _prepareRouteData()
    {
        try {
            $locator = new FileLocator(array(DOCUMENT_ROOT.'/config'));
            $requestContext = new RequestContext($this->_Request->getBaseUrl(), $_SERVER['REQUEST_METHOD'], $_SERVER['HTTP_HOST'],'http',80,443, $this->_Request->getBaseUrl(), $this->_Request->getQueryString());
            $router = new Router(
                new YamlFileLoader($locator),
                'routes.yml',
                array('cache_dir' => DOCUMENT_ROOT.'/cache'),
                $requestContext
            );
            $parameters =  $router->match($this->_Request->getBaseUrl());
            $_chunk = explode(':', $parameters['_controller']); 
            $this->_routeData['module']     = ucfirst($_chunk[0]);
            $this->_routeData['controller'] = ucfirst($_chunk[1]) . 'Controller';
            $this->_routeData['controller_filename'] = DOCUMENT_ROOT.'/modules/'. $this->_routeData['module'] .'/Controller/'.$this->_routeData['controller'].'.php';
            $this->_routeData['action']     = $_chunk[2] . 'Action';
            $this->_routeData['params']     = $parameters;
            unset($this->_routeData['params']['_controller']);
            
        } catch (\Symfony\Component\Routing\Exception\ResourceNotFoundException $ex) {
            $AppController = new AppController($this->_Request);
            $AppController->showError('Page not found.',404);
        } catch (\Exception $ex) {
            $AppController = new AppController($this->_Request);
            $AppController->showError($ex->getMessage());
        }
    }

    
    
}


