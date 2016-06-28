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
    
    protected function init(){
        $this->__acl->addRole(new Zend_Acl_Role(self::GUEST));
        $this->__acl->addRole(new Zend_Acl_Role(self::USER), self::GUEST);
        $this->__acl->addRole(new Zend_Acl_Role(self::ADMIN));
        $this->__acl->addResource(new Zend_Acl_Resource('adder'));
        $this->__acl->deny(null, 'adder');
        $this->__acl->allow(self::ADMIN, 'adder');
    }
    
    public function __construct(){
        $this->__acl = new Zend_Acl();
        $this->__auth = Zend_Auth::getInstance();
        $this->init();
        $this->setCurrentRole();
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
    
/*    public function populateCurrentRole () {
        $this->setCurrentRole();
        
        if(!$this->currentRole){
            return false;
        }
        
        $user = new Zend_Session_Namespace('Zend_Auth');
        if ($user->role) {
            $this->currentRole = $user->role;
        }
    }
 */   
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $ctrl = $this->getRequest()->getControllerName();
        
        $allowed = $this->__acl->isAllowed($this->currentRole, 'adder');
        die("controler: $ctrl ; ROLE: $this->currentRole");
    }


}

?>
