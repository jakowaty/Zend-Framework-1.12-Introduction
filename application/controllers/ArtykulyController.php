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
        $articlesDB = new Application_Model_DbTable_Articles();
        $commentsDB = new Application_Model_DbTable_Comments();
        
        $param      = $this->getParam('pokaz');
        $select     = $articlesDB->select()->where('articles_id = ?', $param);
        $res        = $articlesDB->fetchRow($select);
        
        $selectCom  = $commentsDB->select()->where('articles_id = ?', $param);
        
        $this->view->article      = $res;
        $this->view->commentForm  = new Application_Form_Comments();
        $this->view->identity     = Plugin_User::isUser();
        $this->view->comments     = $commentsDB->fetchAll($selectCom);
        
        
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













