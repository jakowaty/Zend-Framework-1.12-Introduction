<?php

/**
 * Description of ACL
 *
 * @author jak_sieciowyaty
 */
Class Plugin_ACL extends Zend_Controller_Plugin_Abstract
{
    public function routeStartup(Zend_Controller_Request_Abstract $request)
    {
        
    }
 
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {

    }
 
    public function dispatchLoopStartup(
        Zend_Controller_Request_Abstract $request)
    {
        
    }
 
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        
    }
 
    public function postDispatch(Zend_Controller_Request_Abstract $request)
    {
        //this is just idea not implementation
        $ctrl           = $request->getControllerName();
        $ctrl           = ucfirst($ctrl) . 'Controller';
        $aclLvl         = $ctrl::_hasPriviledge();
        if(!is_null($aclLvl)){
            $a = Zend_Auth::getInstance();
            if(!$a->hasIdentity()){
                die('Sorry Sir you must be logged.');
            }
        }        
    }
 
    public function dispatchLoopShutdown()
    {
        
    }
}

?>
