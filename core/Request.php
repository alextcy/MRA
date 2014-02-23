<?php
namespace core;

/**
 * Description of Request
 *
 * @author alextcy
 */
class Request
{
    //private $_uri;
    
    //private $_uriSegments;
    
    protected $_baseUrl;
    protected $_queryString;
    private   $_queryParams = array();


    //private $_paramNames;
    private $POST   = array();
    private $PUT    = array();
    private $DELETE = array();


    public function __construct()
    {
        $urlData = parse_url($_SERVER["REQUEST_URI"]);
        
        $this->_baseUrl     = $urlData['path'];
        $this->_queryString = array_key_exists('query', $urlData) ? $urlData['query'] : null;
        if(!is_null($this->_queryString)) {
            parse_str($urlData['query'],  $this->_queryParams);
        }
        
        $this->_processRequestData();
    }
    
    public static function _()
    {
        return new self();
    }
    
    

    public function POST($paramName=null, $defaultValue=null)
    {
        if(!is_null($paramName)) {
            return isset($this->POST[$paramName]) ? $this->POST[$paramName] : $defaultValue;
        }
        
        return $this->POST;
    }
    
    public function PUT($paramName=null, $defaultValue=null)
    {
        if(!is_null($paramName)) {
            return isset($this->PUT[$paramName]) ? $this->PUT[$paramName] : $defaultValue;
        }
        
        return $this->PUT;
    }
    
    public function DELETE($paramName=null, $defaultValue=null)
    {
        if(!is_null($paramName)) {
            return isset($this->DELETE[$paramName]) ? $this->DELETE[$paramName] : $defaultValue;
        }
        
        return $this->DELETE;
    }

    public function GET($paramName=null, $defaultValue=null) 
    {
        if(!is_null($paramName)) {
            return isset($this->_queryParams[$paramName]) ? rawurldecode($this->_queryParams[$paramName]) : $defaultValue;
        }
        return $this->_queryParams;
        
        /*if(!is_null($paramName)) {
            return isset($_GET[$paramName]) ? $_GET[$paramName] : $defaultValue;
        }
        return $_GET;*/
    }
    

    //Получение значений именных параметров /name-value/
    /*public function getParamByName($name, $default=null)
    {
        if(array_key_exists($name, $this->_paramNames)) {
            return $this->_paramNames[$name];
        } 
        
        return $default;
    }*/
    
    /**
     * Получить значение по ключу из массива или объекта
     * При перезагрузке формы нужно получить значения которые постили, чтобы снова отобразить в форме
     * @param string $key
     * @param array|object $data
     * @return mixed|null
     */
    public function formGet($key, $data=null)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }
        
        if(is_object($data) and isset($data->$key)){
            return $data->$key;
        } else if(isset($data[$key])) {
            return $data[$key];
        }
        
        return null;
    }
    
    //
    public function getMethod()
    {
      return $_SERVER['REQUEST_METHOD'];
    }

    public function getBaseUrl()
    {
        return $this->_baseUrl;
    }
    
    public function getQueryString()
    {
        return $this->_queryString;
    }

    public function getIp()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) and !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        
        if (isset($_SERVER['HTTP_CLIENT_IP']) and !empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        
        return $_SERVER['REMOTE_ADDR'];
    }

    //скрипт запущен в браузере или в консоли
    public function isHttpRequest()
    {
        if(PHP_SAPI === 'cli') {
            return false;
        }
        return true;
        
        /*if(array_key_exists('HTTP_HOST', $_SERVER) or ($_SERVER['USER'] == 'www-data') ) {
            return true;
        } else {
            return false;
        }*/
    }
    
    public function isProdEnv()
    {
        if(array_key_exists('APP_ENV', $_SERVER) and $_SERVER['APP_ENV'] == 'dev') {
            return false;
        }
        return true;
    }
    
    /**
     * Формируем массивы пришедших данных в зависимости от типа запроса (POST, PUT, DELETE)
     * @return boolean
     */
    private function _processRequestData()
    {
        $putdata  = file_get_contents('php://input'); 
        parse_str($putdata, $data);
        
        switch ($this->getMethod()) {
            case 'POST':
                $this->POST   = $data;
                $this->PUT    = array();
                $this->DELETE = array();
                break;
            case 'PUT':
                $this->PUT    = $data;
                $this->POST   = array();
                $this->DELETE = array();
                break;
            case 'DELETE':
                $this->DELETE = $data;
                $this->POST   = array();
                $this->PUT    = array(); 
                break;            
        }
        return true;
    }
    
}


