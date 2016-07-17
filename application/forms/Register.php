<?php

class Application_Form_Register extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAction('register');
        $this->setAttrib('id', 'register_form');
        $this->setAttrib('class', 'form');

        $this->addElement(
            'text', 'username', array(
                'label'         => 'Username:',
                'required'      => true,
                'validators'    => array(
                    'alnum', 
                    new Zend_Validate_StringLength(array(
                        'min' => 3,
                        'max' => 20)),
                    new Zend_Validate_Db_NoRecordExists([
                        'table' => 'user',
                        'field' => 'name'
                    ])
                )
            ));

        $this->addElement(
            'text', 'mail', array(
                'label'         => 'Email:',
                'required'      => true,
                'validators'    => array(
                    'alnum', 
                    new Zend_Validate_StringLength(array(
                        'min' => 17,
                        'max' => 90)),
                    new Zend_Validate_Db_NoRecordExists([
                        'table' => 'user',
                        'field' => 'mail'
                    ]),
                    new Zend_Validate_EmailAddress()
                )
            ));        
        
        $this->addElement('password', 'password', array(
            'label'     => 'Password:',
            'required'  => true,
            'validators'=> array(
                new Zend_Validate_Regex(
                    [
                        //omg, hitting desk with my head
                        'pattern' => '~\w*(?=[a-z]+)\w*(?=[A-Z]+)\w*~'
                    ]
                )
            ) 
            ));

        $this->addElement('password', 'password2', array(
            'label'     => 'Repeat password:',
            'required'  => true,
            'validators'=> array(
                new Zend_Validate_Identical(['token' => 'password'])
            ) 
            )
        );        
        
        
        $captchaAdapter = new Zend_Captcha_Image();
        $captchaAdapter->setFont('/var/www/zend_blog_learn/public/captcha/cz1.ttf');
        $captchaAdapter->setImgDir('/var/www/zend_blog_learn/public/captcha/');
        $captchaAdapter->setImgUrl('/zend_blog_learn/public/captcha/');
        $captchaAdapter->setFontSize(30);
        $captchaAdapter->setExpiration(300);
        $captchaAdapter->setGcFreq(50);
        $captchaAdapter->setWordLen(6);
        $captcha        = new Zend_Form_Element_Captcha('captcha',['captcha' => $captchaAdapter]);
        $this->addElement($captcha, 'captcha');
        
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Zarejestruj się',
            ));        
    }


}

