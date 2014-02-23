<?php
namespace core;

/**
 * Description of View
 *
 * @author alextcy
 */
class View
{
    private $_layoutName = 'default';
    private $_templateVars = array();

    //private $_templateFolder;
    
    public function layout($layoutName=null)
    {
        if(!is_null($layoutName)) {
            $this->_layoutName = $layoutName;
            return $this;
        }
        
        return $this->_layoutName;
    }

    //подключить файл шаблона и передать в него переменные
    public function fetch($templateName, $templateVarsLocal=null)
    {
        if(!is_null($templateVarsLocal)) {
            return $this->_fetch($templateName, $templateVarsLocal);
        }
        
        return $this->_fetch($templateName, $this->_templateVars);
    }
    
    
    public function display($templateName)
    {
        echo $this->_fetch($templateName, $this->_templateVars);
    }
    
    
    //переменные для каркасного шаблона
    function setVar($varName, $value = null) 
    {
        //if(is_string($varName) && !is_null($value)) {
        if(is_string($varName)) {
            $this->_templateVars[$varName] = $value;
        } elseif(is_array($varName)) {
            foreach ($varName as $k => $v) {
                if($k) { $this->_templateVars[$k] = $v; }
            }
        }
        return $this;
    }
    
    
    /**
     * @param string $templateFile
     * @param array $templateVars
     * @return string
     * @throws \Exception
     */
    private function _fetch($templateFile, $templateVars)
    {
        $templateFile .= '.php';
        if (!file_exists($templateFile)) { 
            throw new \Exception('Unable to load template file: '.$templateFile); 
        }
        
        if(is_array($templateVars)) { 
            extract($templateVars); 
        }

        ob_start();
            include $templateFile;
            $template_content = ob_get_contents();
        ob_end_clean();

        return $template_content;
    }
}


