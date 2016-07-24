<?php

/**
 * @class Auth
 */

class AuthController extends Zend_Controller_Action
{

    protected $_auth = null;

    protected $_authAdapter = null;

    public function init()
    {
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
                } else {
                    $this->view->error = 'Niezalogowano';
                }
            }
        }
    }

    public function registerAction()
    {
        $form = new Application_Form_Register();
        if ($this->getRequest()->isGet()) {
            $this->view->form = $form;
        } elseif ($this->getRequest()->isPost()) {
            if (!$form->isValid($_POST)) {
                $this->view->error = $form->getMessages();
            } else {
                $name = $this->getRequest()->getParam('username');
                $mail = $this->getRequest()->getParam('mail');
                $pass = $this->getRequest()->getParam('password');
                $result = $this->registerUser(['name' => $name, 'mail' => $mail, 'pass' => $pass]);
                if ($result === true) {
                    $this->view->success = 'Utworzyłeś konto: ' . $name; 
                } else {
                    $this->view->error = $result;
                }
            }
        }
    }

    public function logoutAction()
    {
        if($this->_auth->hasIdentity()){
            $this->_auth->clearIdentity();
        }
        $this->_redirect('auth/login');
        die;
    }

    protected function registerUser(array $v)
    {
        $tableUser      = new Application_Model_DbTable_User(); 
        $tableToken     = new Application_Model_DbTable_Token();
        
        $user           = new stdClass();
        $user->name     = $v['name'];
        $user->mail     = $v['mail'];
        $user->hash     = md5($v['pass']);
        
        if ($tableUser->createUser($user)) {
            $token          = new stdClass();
            $token->user    = $v['name'];
            $r              = $tableToken->generateActivation($token);
            if ($r) {
                $config     = [
                    'ssl'       => 'ssl',
                    'port'      => 465,
                    'auth'      => 'login',
                    'username'  => 'account@gmail.com',
                    'password'  => 'verrySecureAndStealthPassword'
                ];

                $link       = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/auth/activate?t=' . $r;
                $transport  = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
                $mail       = new Zend_Mail();
                $mail->setBodyText($link);
                $mail->setFrom('learn-zend@penrist.com', 'Learn Support');
                $mail->addTo($user->mail, $user->name);
                $mail->setSubject('Activation link from Learn-Zend-Blog');
                $mail->send($transport);
            } else {
                return ['Coulden\'t create user Activation Token! Im so sorry :( . Please something something.'];
            }
        } else {
            return ['Coulden\'t create user record! Im so sorry :( . Please something something.'];
        }
    }

    public function activateuserAction()
    {
        $t  = $this->getParam('t');
        if (!$t){
            throw new Exception('No $_GET[t]');
        }
        
        $db         = new Application_Model_DbTable_Token();
        $resToken   = $db->getActivateToken($t)->toArray();
        $resToken   = $resToken[0];
        if (empty($resToken)) {
            throw new Exception('Invalid activation token requested.');
        }
      
      
        if (time() > intval($resToken['expires'])) {
            throw new Exception('Requested token expired');
        }
        
        if ($resToken['type'] !== 'activate') {
            throw new Exception('Requested token invalid type');
        }
        $this->view->result = gettype($resToken['expires']);
        //die;
    }


}