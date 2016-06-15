<?php
/**
 * @class loginForm
 */
class Jak_loginForm extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setAction('login');
        $this->setAttrib('id', 'login_form');
        $this->setAttrib('class', 'form');
        
        $this->addElement(
            'text', 'username', array(
                'label'         => 'Username:',
                'required'      => true,
                'validators'    => array(
                    'alnum', 
                    new Zend_Validate_StringLength(array(
                        'min' => 3,
                        'max' => 20))
                )
            ));
 
        $this->addElement('password', 'password', array(
            'label'     => 'Password:',
            'required'  => true,
            'validators'=> array(
                new Zend_Validate_Regex(
                        array(
                            'pattern' => '~[\w[:punct:]]{4,50}~'
                        )
                )
            ) 
            ));
 
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Login',
            ));
 
    }
}

?>
