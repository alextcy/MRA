<?php
namespace core;

/**
 * Description of GException
 *
 * @author alextcy
 */
class GException extends \Exception
{
    public function __construct($message, $code=0)
    {
        $this->log($message);
        
        parent::__construct($message, $code);
    }
    
    protected function log($message)
    {
        $dirpath = DOCUMENT_ROOT.'/upload';
        if(!is_dir($dirpath) or !is_writable($dirpath)) {
            throw new \Exception('Log error. Directory not exist or not writable: '.$dirpath);
        }
        
        if($this->isHttpRequest()) {
            $logFile = $dirpath.'/log-'.date('Y-d-m').'.txt';
        } else {
            $logFile = $dirpath.'/log-cli-'.date('Y-d-m').'.txt';
        }
        
        /*if(!is_writable($logFile)) {
            throw new \Exception('Log error. Log file not writable: '.$logFile);
        }*/
        
        $data = $message ."\r\n" . "FILE:\t" . $this->file . "\r\n" . "LINE:\t".  $this->line;
        file_put_contents($logFile, date('H:i:s')."\t".$data."\r\n"."\r\n", FILE_APPEND);
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
}


