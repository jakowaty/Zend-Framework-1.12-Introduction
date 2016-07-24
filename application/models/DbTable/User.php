<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';

    public function createUser(stdClass $v)
    {
        $v->role = Plugin_ACL::GUEST;
        return $this->insert((array)$v);
    }
    
    public function getUserData($name)
    {
        $select = $this
                ->select()
                ->where('name = ?', $name);
        return $this->fetchAll($select)->toArray();
    }
    
    public function roleUser($name)
    {
        $data = [
           'role' => Plugin_ACL::USER
        ];
        $where = $this->quoteInto('name = ?', $name);
        $self = new Application_Model_DbTable_User();
        return $self->update($data, $where);
    }
}

