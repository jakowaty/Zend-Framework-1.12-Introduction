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

}

