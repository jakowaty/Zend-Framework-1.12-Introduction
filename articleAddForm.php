<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of articleAdd
 *
 * @author jak_sieciowyaty
 */
class JAK_articleAddForm {
    
    public function init()
    {
        $this->setMethod('post');
 
        $this->addElement(
            'text', 'username', array(
                'label' => 'Username:',
                'required' => true,
                'filters'    => array('StringTrim'),
            ));
 
        $this->addElement('password', 'password', array(
            'label' => 'Password:',
            'required' => true,
            ));
 
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Login',
            ));
 
    }
    
}

?>
