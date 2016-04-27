<?php

class AdderController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function addtagAction()
    {
        $http = new Zend_Controller_Request_Http();
        
        /*________JUST A TEST FOR METHODS TO RETRIEVE POST PARAMS_______*/
        /*//method 1
        if(($http->isPost()) AND ($nazwa = $http->getPost('nazwa'))){
            $this->view->params = array();
            $this->view->params[] = $nazwa;
        }
        //method2
        $this->view->params2 = $this->getRequest()->getPost();
        */
        /*_______________________________________________________________*/
        
        
        if($http->isPost()){
            
            try{
            
                $validator = new Jak_PCREValidator();
                $dummy = new Jak_DummyObj();
                $params = $this->getRequest()->getPost();
                
                if(!$dummy->array_keys_exists( $params, array('symbol','nazwa','opis'), true )){
                    throw new Exception('Błąd parametr&oacute;w żądania');
                }
                
                if(!$validator->validateTag($params['symbol'])){
                    throw new Exception('Nieprawidłowy symbol!');
                }
                
                $tags = new Application_Model_DbTable_Tags();
                $data = array(
                    'tags_id' => $params['symbol'],
                    'name' => $params['nazwa'],
                    'description' => $params['opis']
                );
                
                $tags->insert($data);
                
                $this->view->status = "Dodano kategorię tematyczną o tytule: \"" . $dummy->unhtml($params['nazwa']) . '"';
            }catch(Exception $ex){
            
                $this->view->status = $ex->getMessage();
            
            }
        }
    }

    public function addarticleAction()
    {
        // action body
    }


}




