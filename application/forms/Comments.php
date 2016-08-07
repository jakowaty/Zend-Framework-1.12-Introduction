<?php

class Application_Form_Comments extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAction("/zend_blog_learn/public/comments/dodaj/");
        $this->setAttrib('class', 'form');
        $this->setAttrib("id", "commentForm");
        
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
        
        $this->addElement(
            'hidden', 'articles_id', array(
                'required'      => true,
                'validators'    => array(
                    'alnum', 
                    new Zend_Validate_StringLength(array(
                        'min' => 40,
                        'max' => 40)),
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

