<?php
namespace core;


/**
 * Description of Controller
 *
 * @author alextcy
 */
abstract class Controller
{
    /**
     * @var \core\Request
     */
    protected $Request;
    
    /**
     * @var View
     */
    protected $View;

    protected $moduleName;
    protected $templatePath;



    /**
     * @param string $moduleName
     * @param Request $Request
     * @param View $View
     */
    public function __construct($moduleName, $Request, $View)
    {
        $this->moduleName   = $moduleName;
        $this->templatePath = DOCUMENT_ROOT .'/modules/'. $moduleName . '/Templates';
        $this->Request      = $Request;
        $this->View         = $View;
        
        $this->View->setVar('templateFolder'    , str_replace(DOCUMENT_ROOT, '', $this->templatePath));
    }
    
    //setHeadTitle($title, $append=true)
    
    public function sendAjaxError($errorText)
    {
        $response = array();
        $response['result'] = false;
        $response['error']  = $errorText;
        
        echo json_encode($response); 
        exit();
    }


    public function sendAjaxResponse(array $data=array())
    {
        $response = array();
        $response['result'] = true;
        $response['error']  = '';
        
        if(count($data)) {
            $response = array_merge($response, $data);
        }
        
        echo json_encode($response); 
        exit();
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
        
        return $this->View->fetch(DOCUMENT_ROOT . '/templates/error');
    }
}
