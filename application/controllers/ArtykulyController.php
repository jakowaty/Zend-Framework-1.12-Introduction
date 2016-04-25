<?php

class ArtykulyController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function listaKategoriiAction()
    {
        // action body
        $this->view->penis = 'listaKategoriiAction';
    }

    public function najnowszeArtykulyAction()
    {
        // action body
       // $this->view->penis = 'najnowszeArtykulyAction';
        $this->view->penis = new Jak_DummyObj();
    }


}







