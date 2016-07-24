<?php

class Application_Model_DbTable_Token extends Zend_Db_Table_Abstract
{

    protected $_name = 'token';
    
    protected static function generateToken($v = 64)
    {
        if ($v%32 !== 0) {
            throw new Exception('Invalid byterange requested: ' . __FUNCTION__);
        }
        
        $t = '';
        $m = $v/32;
        
        while ($m > 0) {
            $t .= md5(openssl_random_pseudo_bytes(10));
            $m--;
        }
        
        return $t;
    }
    
    public function generateActivation(stdClass $t)
    {
        $tokKey     = self::generateToken();
        $t->token   = $tokKey;
        $t->type    = 'activate';
        $t->created = time();       //one day =]
        $t->expires = $t->created + 86400;
        
        if ($this->insert((array)$t)) {
            return $t->token;
        } else {
            return false;
        }
    }
    
    public function getActivateToken($token)
    {
        $db = $this->getAdapter();
        $select = $this->select()
                ->where('token = ?', $token)
                ->where('type = ?', 'activate');
        $select = $this->fetchAll($select);
        return $select;
    }
}

