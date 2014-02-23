<?php
namespace Mra;


/**
 * Description of ImageGrabber
 *
 * @author alextcy
 */
class ImageGrabber
{
    //путь к папке куда сохраняем картинку (если папки нет, создать)
    protected $uploadFolder;
    //url картинку которую будем грабить
    protected $imageUrl;
    
    public function setImageUrl($url)
    {
        $this->imageUrl = $url;
    }
    
    public function setUploadFolder($folder)
    {
        $this->uploadFolder = $folder;
    }
    
    public function grab()
    {
        $sourceHandler = @fopen($this->imageUrl, 'rb');
        if($sourceHandler === false){
            //return false;
            throw new \Exception('Unable open remote image: '.$this->imageUrl);
        }
        
        if(!file_exists($this->uploadFolder)) {
            mkdir($this->uploadFolder, 0777, true);
        }
        
        $fileNameUnique = $this->_getUniqueFileName(basename($this->imageUrl));
        
        $_buf = '';
        while (!feof($sourceHandler)) {
            $_buf = fread($sourceHandler, 1024);
            file_put_contents($this->uploadFolder.$fileNameUnique, $_buf, FILE_APPEND);
        }
        
        return $fileNameUnique;
    }
    
    private function _getUniqueFileName($originalName)
    {
        $pathInfo = pathinfo($originalName);
        $mirotimeStr = str_replace('.', '', (string)microtime(true));
        return $pathInfo['filename'] .'_'.$mirotimeStr.'.'.$pathInfo['extension'];
    }
}
