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
    
    public function setCurrentRole () {
        
        if (!$this->__auth->hasIdentity()) {
            
            $this->currentRole = self::GUEST; 
        
        } else {
            
            $user = new Zend_Session_Namespace('Zend_Auth');
            $role = $user->role;
            
            if (
               ($role === self::GUEST) xor
               ($role === self::USER) xor
               ($role === self::ADMIN)
               ) {
                $this->currentRole = $role;
            } else {
                $this->currentRole = self::GUEST;
            }
            
        } 
    }
    
    public function populateCurrentRole () {
        $this->setCurrentRole();
        
        if(!$this->currentRole){
            return false;
        }
        
        $user = new Zend_Session_Namespace('Zend_Auth');
        $user->role = $this->currentRole;
    }
    
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $this->populateCurrentRole();
    }


}

?>
