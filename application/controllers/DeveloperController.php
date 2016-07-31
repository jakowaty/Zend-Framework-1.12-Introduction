<?php

class DeveloperController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function deltestAction()
    {
        print __FUNCTION__ . '()';
        $dbToken = new Application_Model_DbTable_Token();   
        //$db      = $dbToken->getAdapter();
        /*$where  = [];
        $where  []= $db->quoteInto('token = ?', $token);
        $where  []= $db->quoteInto('user =?', $user);
        $delete = $this->delete($where);*/
        $user  = 'jakuserii';
        $token = 'dfddffddfdf';
        $select = $dbToken->select()
                ->where('token = ?', $token)
                ->where('user = ?', $user);
        $row    = $dbToken->fetchRow($select);
        if ($row !== null) {
            $r = $row->delete();
            if ($r) {
                print 'success';
            } else {
                print 'i dont want';
            }
            
        }else{
            print 'Invalid param values';
        }
        die;
    }


}



