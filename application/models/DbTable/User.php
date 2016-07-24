<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';

    public function createUser(stdClass $v)
    {
        $v->role = Plugin_ACL::GUEST;
        return $this->insert((array)$v);
    }
    
    public function roleUser($user)
    {

    }
}

