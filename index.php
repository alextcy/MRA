<?php
//ini_set('max_execution_time', 3600);
//ini_set('max_input_time', 300);

ini_set("display_errors", 'On');
//ini_set("error_reporting", E_ALL | E_PARSE | E_ERROR | E_NOTICE || ~E_STRICT);

error_reporting(E_ERROR | E_NOTICE | E_WARNING | E_PARSE | E_DEPRECATED);


define('DOCUMENT_ROOT' ,  __DIR__);

/*function checkLocalDomain($domain)
{
    $localsDomainZone = array('local','dev','localhost');
    
    $domainZone = end(explode('.', $domain));
    
    if(in_array($domainZone, $localsDomainZone)) {
        return true;
    }
    return false;
}*/
function isProdEnv()
{
    if(array_key_exists('APP_ENV', $_SERVER) and $_SERVER['APP_ENV'] == 'dev') {
        return false;
    }
    return true;
}

function vardump()
{
    echo '<pre>';
    foreach (func_get_args() as $argument) {
      var_dump($argument);
    }
    echo '</pre>';
    exit();
}

require DOCUMENT_ROOT . '/autoload.php';

if(isProdEnv()) {
    require DOCUMENT_ROOT . '/config/config.php';
} else {
    require DOCUMENT_ROOT . '/config/local/config.php';
}

/*if(false === checkLocalDomain($_SERVER['HTTP_HOST'])) {
    require DOCUMENT_ROOT . '/config/config.php';
} else {
    require DOCUMENT_ROOT . '/config/local/config.php';
}*/



$FrontController = new core\FrontController(new \core\Request());
$FrontController->execute();

