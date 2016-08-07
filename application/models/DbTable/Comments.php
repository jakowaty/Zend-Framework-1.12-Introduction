<?php

class Application_Model_DbTable_Comments extends Zend_Db_Table_Abstract
{

    protected $_name = 'comments';

    public function selectWhere()
    {
        
    }
    
    public function insertComment($id,$name,$text)
    {
        /*$data = array(
                'articles_id' => $id,
                'who'         => $name,
                'text'        => $text,
                'created'     => time()
            );*/
                
        return $this->insert([
            'articles_id' => $id,
            'who'         => $name,
            'text'        => $text,
            'created'     => time()            
        ]);        
    }    
}

