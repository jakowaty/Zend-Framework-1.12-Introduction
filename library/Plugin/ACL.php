<?php

/**
 * Description of ACL
 *
 * @author jak_sieciowyaty
 */
Class Plugin_ACL extends Zend_Controller_Plugin_Abstract
{

    protected $__acl;
    protected $__auth;
    protected $currentRole;
    
    public function __construct(){
        $this->__acl = new Zend_Acl();
        $this->__auth = Zend_Auth::getInstance();
    }
    
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        
    }


}

?>
