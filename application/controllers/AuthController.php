<?php

/**
 * @class Auth
 */



class AuthController extends Zend_Controller_Action
{    
    protected $_auth;
    protected $_authAdapter;
    protected $redirector;
    
    //not sure if Ishould do this through constructor
    public function init(){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $this->_auth = Zend_Auth::getInstance();
        $this->_authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        $this->_authAdapter->setTableName('user');
        $this->_authAdapter->setIdentityColumn('name');
        $this->_authAdapter->setCredentialColumn('hash');        
    }
    
    public function loginAction()
    {
        $form = new Jak_loginForm();
        $this->view->form = $form;
        
        if($this->getRequest()->isPost()){
            if(!$form->isValid($_POST)){
                $this->view->error = $form->getMessages();
            }else{
                $vals = $form->getValues();
                $this->_authAdapter->setIdentity($vals['username']);
                //I know this above isn't apropriate
                //but this is about mvc/zend learn
                $this->_authAdapter->setCredential(md5($vals['password']));
                $result = $this->_auth->authenticate($this->_authAdapter);
                
                
                if($result->isValid()){
                    $this->view->success = 'Zalogowano';
                    //$storage = $this->_auth->getStorage();
                    //$storage->write($this->_authAdapter->getResultRowObject(null,'hash'));
                    $user = $this->_authAdapter->getResultRowObject();
                    $Zend_Auth = new Zend_Session_Namespace('Zend_Auth');
                    $Zend_Auth->role = $user->role;
                    
                    //die;
                }
                
            }
        }
    }

    public function registerAction()
    {
        // action body
    }

    public function logoutAction(){
        if($this->_auth->hasIdentity()){
            $this->_auth->clearIdentity();
        }
        $this->_redirect('auth/login');
        die;
    }
}

