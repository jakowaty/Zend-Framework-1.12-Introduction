<?php
class Jak_PCREValidator extends Zend_Application_Resource_ResourceAbstract
{
    protected $pattern;
    
    protected function setPattern($p){
        
        $this->pattern = $p;
        
    }
    
    public function getPattern(){
        return $this->pattern;
    }
    
    public function init(){        
    }
    
    protected function validate($string){
        
        if(!is_string($string)){
            return false;
        }
        
        if(preg_match($this->pattern,$string)){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function validateTag($tag){
        
        $regX = '~^[a-z0-9_\-]{3,50}$~';
        $this->setPattern($regX);
        return $this->validate($tag);
        
    }
    
    public function validateArticleTitle($title){
        
        $regX = '~^[\w0-9_\-!?,. ]{1,80}$~';
        $this->setPattern($regX);
        return $this->validate($title);
        
    }
}
?>
