<?php
namespace core;

use core\View;
/**
 * Description of AppController
 *
 * @author alextcy
 */
class AppController
{
    protected $Request;
    /**
     * @var View 
     */
    protected $View;


    private $_moduleName;
    private $_controllerAlias;
    private $_methodName;
    private $_params;

    private $_templatePath;

    public function __construct($Request)
    {
        $this->Request = $Request;
        $this->_templatePath = DOCUMENT_ROOT. \Config::TEMPLATE_FOLDER;
        $this->View = new View();
    }

    public function setModuleName($moduleName)
    {
        $this->_moduleName = $moduleName;
        return $this;
    }
    
    public function setControllerAlias($controllerAlias)
    {
        $this->_controllerAlias = $controllerAlias;
        return $this;
    }
    
    public function setMethodName($methodName)
    {
        $this->_methodName = $methodName;
        return $this;
    }
    
    public function setParams($params)
    {
        $this->_params = $params;
        return $this;
    }

    public function execute()
    {
        //глобальные переменные для всех шаблонов
        $this->View->setVar('headTitle', 'Mra');
        $this->View->setVar('templateMainFolder', '/templates');
        
        $Controller = new $this->_controllerAlias( $this->_moduleName, $this->Request, $this->View);
        $Reflection = new \ReflectionMethod($Controller, $this->_methodName); 
        $ControllerResponse = $Reflection->invokeArgs($Controller, $this->_getArgumentsValueForMethod($Reflection, $this->_params));
        
        //рендеринг всей страницы
        $this->render($ControllerResponse);
    }
    
    /**
     * @param string $content
     */
    private function render($content)
    {
        $this->View->setVar('content', $content);
        $this->View->display($this->_templatePath . '/layout-'. $this->View->layout() );
    }
    
    
    public function showError($message='', $statusCode=null)
    {
        $statusText = array(
            404 => 'Not Found',
        );
        
        if(!is_null($statusCode)) {
            $msg = array_key_exists($statusCode, $statusText) ? $statusText[$statusCode] : '';
            header("Status: $statusCode".' '.$msg);
        }
        
        $this->View->setVar('headTitle', 'Mra::Ошибка');
        $this->View->layout('blank');
        $this->View->setVar('message', $message);
        $content = $this->View->fetch($this->_templatePath . '/error');
        $this->render($content);
        exit;
    }

    /**
     * Массив [имя аргумента метода]=значение
     * не важно в каком порядке идут параметры в методе, главное чтобы совпадали их имена
     *  
     * @param ReflectionMethod $ReflectionMethod
     * @param array $args
     * @return array - асоц массив ключи это аргументы метода контроллера. Порядок ключей соответствует порядку аргументов метода
     */
    private function _getArgumentsValueForMethod($ReflectionMethod, $args)
    {
        $pass = array();
        //проход по именам параметров в методе контролера
        foreach($ReflectionMethod->getParameters() as $param)
        {
          /* @var $param ReflectionParameter */
          if(isset($args[$param->getName()]))
          {
            $pass[] = $args[$param->getName()];
          }
          else
          {
            $pass[] = $param->getDefaultValue();
          }
        }

        return $pass;
    }
}
