<?php

class ArtykulyController extends Zend_Controller_Action
{

    public function listaKategoriiAction()
    {
        $tags = new Application_Model_DbTable_Tags();
        $this->view->listTags = $tags->fetchAll(); 
    }

    public function najnowszeartykulyAction()
    {
        $articles = new Application_Model_DbTable_Articles();
        $this->view->listArt = $articles->fetchAll();
        $this->_helper->viewRenderer('najnowsze-artykuly');
    }

    public function najnowszeAction()
    {
        
        $this->_helper->viewRenderer('art');
        $this->view->param = $this->getParam('art_id');
    }
    
    public function artykulShowAction()
    {
        $this->_helper->viewRenderer('art');
        $this->view->param = 'b';
    }


}









