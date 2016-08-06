<?php

class CommentsController extends Zend_Controller_Action
{

    public function init(){}

    public function dodajAction()
    {
        if ($this->isPost()) {
            $commentsDB = new Application_Model_DbTable_Comments();
            
            $auth = Zend_Auth::getInstance();
            $text = $this->getParam('text');
            $id   = $this->getParam('articles_id');
            $name = $auth->getIdentity();
            
            if (!$text or !$id) {
                print 'Invalid params';
                return null;
            }
            
            $data = [
                'articles_id' => $id,
                'who'         => $name,
                'text'        => $text,
                'created'     => time()
            ];
            
            if ($commentsDB->insert($data)) {
                //
            } else {
                //
            }
        }
    }
}

