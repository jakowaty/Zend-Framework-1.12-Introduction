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

    public function artykulAction()
    {
        $param      = $this->getParam('pokaz');
        $articlesDB = new Application_Model_DbTable_Articles();
        $select     = $articlesDB->select()->where('articles_id = ?', $param);
        $res        = $articlesDB->fetchRow($select);
        $this->view-> article = $res;
    }

    public function kategoriaAction()
    {
        $param      = $this->getParam('id');
        $articlesDB = new Application_Model_DbTable_Articles();
        $tagsDB     = new Application_Model_DbTable_Tags();
        
        $select     = $tagsDB->select()->where('tags_id = ?', $param);
        $tag        = $tagsDB->fetchRow($select);
        
        if (!$tag) {
            throw new Exception('Invalid tags id');
        }
        
        $articles = $articlesDB->selectColumns(['articles_id', 'title'], ['tags_id = ?', $param]);
        
        $this->view->param    = $param;
        $this->view->tag      = $tag;
        $this->view->articles = $articles;
    }


}













