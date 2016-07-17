<?php

/**
 * @class Auth
 */
class AuthController extends Zend_Controller_Action
{    
    protected $_auth;
    protected $_authAdapter;
    
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
                //I know about salting and f.ex. Blowfish
                //however this code is not about proper storing creds
                //but about practicing frameworks
                $this->_authAdapter->setCredential(md5($vals['password']));
                $result = $this->_auth->authenticate($this->_authAdapter);
                
                if($result->isValid()){
                    $this->_auth
                            ->getStorage()
                            ->write($this->_authAdapter->getResultRowObject(['name', 'role']));
                    $this->view->success = 'Zalogowano';
                }
            }
        }
    }

    public function registerAction()
    {
        $form = new Application_Form_Register();
        if ($this->getRequest()->isGet()) {
            $this->view->form = $form;
        } elseif ($this->getRequest->isPost()) {
            if (!$form->isValid($_POST)) {
                $this->view->error = $form->getMessages();
            } else {
                $name = $this->getRequest()->getParam('username');
                $mail = $this->getRequest()->getParam('mail');
                $pass = $this->getRequest()->getParam('password');
                $result = $this->registerUser($name, $mail, $pass);
                if ($result === true) {
                    $this->view->success = 'Utworzyłeś konto: ' . $name; 
                } else {
                    $this->view->error = $result;
                }
            }
        }
    }

    public function logoutAction(){
        if($this->_auth->hasIdentity()){
            $this->_auth->clearIdentity();
        }
        $this->_redirect('auth/login');
        die;
    }
    
    protected function registerUser(array $v)
    {
        
    }
}

