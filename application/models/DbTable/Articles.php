<?php

class Application_Model_DbTable_Articles extends Zend_Db_Table_Abstract
{

    protected $_name = 'articles';
    
    protected $referenceMap = array(
        'tags' => array(
            'columns'           => 'tags_id',
            'refTableClass'     => 'Application_Model_DbTable_Tags',
            'refTableColumns'   => 'tags_id'
        )
    );
    
    public function insertArticle(array $a)
    {
        $data = array(
            'articles_id'   => $a['id'],
            'title'         => $a['title'],
            'tags_id'       => $a['tags_id'],
            'autor'         => $a['autor'],
            'text'          => $a['text']
        );
                
        return $this->insert($data);        
    }

    public function selectColumns(array $columns, array $where = []){
        
        $db = $this->getAdapter();
        
        $select = (count($columns) === 0)?
            $db->select()->from($this->_name) :
            $db->select()->from($this->_name, $columns);
        
        if (!empty($where)) {
            $select = $select->where($where[0], $where[1]);
        }
        
        $result = $db->query($select);
        
        return $result;
    }
}

