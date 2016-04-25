<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initPage(){
	
		$this->bootstrap(array('layout','view','frontController'));
		
		$front = $this->getResource('frontController');
		$layout = $this->getResource('layout');
		$view = $this->getResource('view');
		
		$request = new Zend_Controller_Request_Http();
		$front->setRequest($request);
		$baseUrl = $request->getBaseUrl();
		
		$defaultsArray = array(
			'page' => array(
				'title' => array(
							'separator' => '',
							'content' => '',
							'defaultAttachOrder' => '',
				)
			)
		);
		
		$defaults = new Zend_Config($defaultsArray,true);
		$cfg = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'production');
		$cfg = $defaults->merge($cfg);
		$view->headTitle()
			->setDefaultAttachOrder($cfg->page->title->defaultAttachOrder)
			->setSeparator($cfg->page->title->separator)
			->headTitle($cfg->page->title->content);
	}
	
}

