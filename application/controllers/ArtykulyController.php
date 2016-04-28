<?php

class ArtykulyController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function listaKategoriiAction()
    {
        $tags = new Application_Model_DbTable_Tags();
        $this->view->listTags = $tags->fetchAll(); 
    }

    public function najnowszeArtykulyAction()
    {
        // action body
       // $this->view->penis = 'najnowszeArtykulyAction';
        $this->view->penis = new Jak_DummyObj();
    }


}







