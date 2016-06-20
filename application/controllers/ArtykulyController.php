<?php

class ArtykulyController extends Zend_Controller_Action implements Jak_IAcl,Zend_Acl_Resource_Interface
{

    public static $_aclLevel = null;
    public static function _hasPriviledge(){
        return self::$_aclLevel;
    } 

    public function getResourceId(){
        return self::$_aclLevel;
    }
    
    public function listaKategoriiAction()
    {
        $tags = new Application_Model_DbTable_Tags();
        $this->view->listTags = $tags->fetchAll(); 
    }

    public function najnowszeArtykulyAction()
    {

    }


}







