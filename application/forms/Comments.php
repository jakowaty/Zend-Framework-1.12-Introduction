<?php

class Application_Form_Comments extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAction('dodaj');
    }


}

