<?php

class Application_Form_Comments extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAction('dodaj');
        $this->setAttrib('class', 'form');
        
        $this->addElement(
            'textarea', 'comment', array(
                'label'         => 'Comment:',
                'required'      => true,
                'validators'    => array(
                    new Zend_Validate_StringLength(array(
                        'min' => 3,
                        'max' => 254)),
                )
            )
        );

        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Skomentuj wpis',
            )
        );        
    }

}

