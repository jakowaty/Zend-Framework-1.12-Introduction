<?php

class Application_Model_DbTable_Tags extends Zend_Db_Table_Abstract
{

    protected $_name = 'tags';
    protected $_dependentTables = array('Application_Model_DbTable_Articles');
    
    public function selectColumns(array $columns){
        
        $db = $this->getAdapter();
        
        $select = (count($columns) === 0)?
            $db->select()->from($this->_name) :
            $db->select()->from($this->_name, $columns);
        
        $result = $db->query($select);
        
        return $result;
    }
}

