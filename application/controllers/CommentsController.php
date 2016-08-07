<?php

class CommentsController extends Zend_Controller_Action
{

    public function init(){}

    public function dodajAction()
    {
        if ($this->getRequest()->isPost()) {
            
            $articlesDB = new Application_Model_DbTable_Articles();
            $commentsDB = new Application_Model_DbTable_Comments();
            $paginator  = new Jak_Paginator();
            
            $ids  = $articlesDB->selectColumns(['articles_id']);
            $art_ids = [];
            foreach ($ids as $id) {
                $art_ids []= $id['articles_id'];
            }

            $auth = Zend_Auth::getInstance();
            $text = $this->getRequest()->getParam('comment');
            $id   = $this->getRequest()->getParam('articles_id');
            $name = $auth->getIdentity()->name;
            
            if (!$text or !$id or !$name) {
                print json_encode(["error" => 'Invalid params']);
                return null;
            }

            if (!in_array($id, $art_ids)) {
                print json_encode(["error" => 'Invalid params']);
                return false;
            }           

            
            if ($commentsDB->insertComment($id,$name,$text)) {
                print json_encode(["success" => 1]);
            } else {
                print json_encode(["error" => 1]);
            }
            
            die;
        }
    }
}

