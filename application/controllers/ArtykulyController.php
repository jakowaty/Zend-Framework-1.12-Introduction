<?php

class ArtykulyController extends Zend_Controller_Action
{
    
    public function listaKategoriiAction()
    {
        $tags = new Application_Model_DbTable_Tags();
        $this->view->listTags = $tags->fetchAll(); 
    }

    public function najnowszeArtykulyAction()
    {

    }


}







