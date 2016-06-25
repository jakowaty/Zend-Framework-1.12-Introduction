<?php

/**
 * 
 */
Class Plugin_ACL extends Zend_Controller_Plugin_Abstract
{

    protected $__acl;
    protected $__auth;
    protected $currentRole;
    
    const GUEST = 'guest';
    const USER  = 'user';
    const ADMIN = 'admin';
    
    public function __construct(){
        $this->__acl = new Zend_Acl();
        $this->__auth = Zend_Auth::getInstance();
    }
    
    public function getCurrentRole () {
        if (!$this->__auth->hasIdentity()) {
            $this->currentRole = self::GUEST; 
        } else {
            $user = $this->__auth->getStorage()->read();
        } 
    }
    
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        //$this->get
    }


}

?>
