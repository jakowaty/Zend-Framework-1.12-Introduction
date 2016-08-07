<?php

/**
 * class Paginator
 * @author https://github.com/jakowaty
 * 
 * @property array $data Internal, Parsed result obtained from passed data
 * @property boolean $object Indicating wheter original data passed to paginator is object
 * @property boolean $array Indicating wheter original data passed to paginator is array
 * @property object | array $__d Original data passed to Paginator Object
 * 
 * @method public setupPaginator(Iterable | Array $data) function for object initialization
 * must be passed object to iterate or array. Redirects passed data for checks, sets internal variables;
 *
 * @method protected set__dField(data) sets original data field with given value
 *
 * @method public checkDataType(data) checks if passed data is in proper format for
 * Paginator and set state fields $object/$array
 */
class Jak_Paginator
{
   const ERROR_DATA_TYPE        = "Data must implement iterator or be type array";
   const ERROR_PAGE_TYPE        = "On Page must be Integer Type";
   const ERROR_DATA_COUNT_TYPE  = "Count must be inbteger type";
   const ERROR_NON_INIT         = "Its necesarry to run Paginator::setupPaginator() after construction";
   
   private $onPage      = false;
   private $data        = false;
   private $dataCount   = false;
   private $object      = false;
   private $array       = false;
   private $__d         = false;
   
   private $_pages_     = false;
   
   public function setupPaginator($data, $pageCount = 20)
   {
       if ($this->checkDataType($data)) {
           $this->set__dField($data);
       } else {
          throw new Exception(self::ERROR_DATA_TYPE);
       }
       
       $this->setOnPage($pageCount);
       $this->set__dataInternal();
       $this->init();
   }
   
   public function getPageCount(){
        return $this->_pages_;
   }
   
   public function getPage($nr)
   {
       if (!is_int($nr)) {
            throw new Exception(self::ERROR_DATA_COUNT_TYPE);                      
       }
       
       if(!$this->data) {
           throw new Exception(self::ERROR_NON_INIT);           
       }
       
       if ($nr > $this->getPageCount()) {
           $o = 1;
       } else {
           $o = ($nr * $this->onPage) - 1; 
       }
       
       return array_slice($this->data, $o, $this->getOnPage());
   }
   
   //_________________________________
   
   protected function init()
   {
        $pagesDouble    =  $this->dataCount/$this->onPage;
        $pagesRound     = (int)($pagesDouble);
        
        if ($pagesDouble > $pagesRound) {
            $pagesRound++; 
        }
        
        $this->_pages_ = $pagesRound;
   }
   
   protected function set__dataInternal(){
       
       if (!$this->checkDataType($this->__d,false)) {
           throw new Exception(self::ERROR_DATA_TYPE);
       }
       
       $this->data = [];
       
       foreach ($this->__d as $pageItem) {
           $this->data []= $pageItem;
       }
       
       $this->setDataCount(count($this->data));
   }
   
   public function getDataCount()
   {
       return $this->dataCount;
   }
   
   public function setDataCount($i)
   {
       if (is_int($i)) {
           $this->dataCount = $i;
       } else {
           throw new Exception(self::ERROR_DATA_COUNT_TYPE);           
       }       
   }
   
   public function setOnPage($i)
   {
       if (is_int($i)) {
           $this->onPage = $i;
       } else {
           throw new Exception(self::ERROR_PAGE_TYPE);           
       }
       
   }
   
   public function getOnPage()
   {
       return $this->onPage;
   }
   
   protected function set__dField($data)
   {
      $this->__d = $data;
   }
   
   public function checkDataType : bool($data, $setFlags = true)
   {   
       if (!is_bool($setFlags)) {
           throw new Exception("Invalid flags value");
       }
       
       if ((is_object($data) && instanceof Iterator)) {
           if($setFlags) {
               $this->setIsObject();
           }
           return true;
       }       
       
       if (is_array($data)) {
           if ($setFlags) {
               $this->setIsArray();
           }
           return true;
       }
       
       return false;
   }
   
   public function isArray()
   {
       return $this->array;
   }
   
   public function isObject()
   {
       return $this->object;
   }
   
   public function setIsObject(){
       $this->object = true;
       $this->unsetIsArray();
   }
   
   public function unsetIsObject(){
       $this->object = false;
   }  
   
   public function setIsArray(){
       $this->unsetIsObject();
       $this->array  = true;
   }
   
   public function unsetIsArray(){
       $this->array = false;
   }     
   //public function
}