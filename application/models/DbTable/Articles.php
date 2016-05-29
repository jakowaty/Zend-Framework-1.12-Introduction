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

}

