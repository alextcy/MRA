<?php
namespace Mra;

use core\View;

class Pager
{
    /**
     * Записей на странице
     * @var int 
     */
    protected $limit;
    
    /**
     * Всего записей
     * @var int 
     */
    protected $records;
    
    //количество отображаемых страниц в блоке
    protected $pagesInBlock;


    protected $View;
    protected $templatePath;

    /**
     * Конструктор
     * @param int $records
     * @param int $limit 
     */
    public function __construct($records, $limit, $pagesInBlock=10)
    {
        $this->records      = $records;
        $this->limit        = $limit;
        $this->pagesInBlock = $pagesInBlock;
        
        $this->View = new View(/*DOCUMENT_ROOT. \Config::TEMPLATE_FOLDER, DOCUMENT_ROOT. \Config::TEMPLATE_FOLDER*/);
        $this->templatePath = DOCUMENT_ROOT. \Config::TEMPLATE_FOLDER;
    }
    
    
    public function draw($page, $url, $pageParamName='')
    {
        //общее количество страниц
        $pagesCount = (int)ceil($this->records / $this->limit);
        //номер текущешл блока отображаемых страниц навигации
        $blockNum = (int)ceil( $page / ( $this->pagesInBlock - 1 ) );
        //номер последнего блока
        $blockNumLast = (int)ceil( $pagesCount / ( $this->pagesInBlock - 1 ) );
        
        $pages = array();
        for($i=1; $i <= $this->pagesInBlock; $i++) {
            $pageNumber = $i + ($blockNum - 1) * ($this->pagesInBlock - 1);
            if($pageNumber > $pagesCount) { break; }
            
            $Paginator = new \stdClass;
            $Paginator->number = $pageNumber;
            $Paginator->url    = ($Paginator->number == 1) ? str_replace($pageParamName, '', $url) : $url. $pageParamName . $Paginator->number;
            
            $pages[] = $Paginator;
        }
        
        $pagePrev = $page > 1 ? $page - 1 : 1;
        $pageNext = $page < $pagesCount ? $page + 1 : $pagesCount;
        $pagePrevUrl  = $pages[$pagePrev-1]->url;
        $pageNextUrl  = $pages[$pageNext-1]->url;
        $pageFirstUrl = $url; 
        $pageLastUrl  = $url . $pagesCount;
        
        $this->View->setVar('pages'       , $pages);
        $this->View->setVar('pagePrevUrl' , $pagePrevUrl);
        $this->View->setVar('pageNextUrl' , $pageNextUrl);
        $this->View->setVar('pageFirstUrl', $pageFirstUrl);
        $this->View->setVar('pageLastUrl' , $pageLastUrl);
        
        $this->View->setVar('page'        , $page);
        $this->View->setVar('pagesCount'  , $pagesCount);
        $this->View->setVar('blockNum'    , $blockNum);
        $this->View->setVar('blockNumLast', $blockNumLast);
        $this->View->setVar('pagesInBlock', $this->pagesInBlock);
        
        return $this->View->fetch($this->templatePath. '/pager');
    }
    
    
}