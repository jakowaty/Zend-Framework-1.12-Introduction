<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ACL
 *
 * @author jak_sieciowyaty
 */
Class Plugin_ACL extends Zend_Controller_Plugin_Abstract
{
    public function routeStartup(Zend_Controller_Request_Abstract $request)
    {
        $this->getResponse()
             ->appendBody("<p>routeStartup() called</p>\n");
    }
 
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        $this->getResponse()
             ->appendBody("<p>routeShutdown() called</p>\n");
    }
 
    public function dispatchLoopStartup(
        Zend_Controller_Request_Abstract $request)
    {
        $this->getResponse()
             ->appendBody("<p>dispatchLoopStartup() called</p>\n");
    }
 
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $this->getResponse()
             ->appendBody("<p>preDispatch() called</p>\n");
    }
 
    public function postDispatch(Zend_Controller_Request_Abstract $request)
    {
        $this->getResponse()
             ->appendBody("<p>postDispatch() called</p>\n");
    }
 
    public function dispatchLoopShutdown()
    {
        $this->getResponse()
             ->appendBody("<p>dispatchLoopShutdown() called</p>\n");
    }
}

?>
