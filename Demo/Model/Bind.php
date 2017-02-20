<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/11/25 0025
 * Time: 11:43
 */

class Model_Bind extends PhalApi_Model_NotORM
{
    public function getHardlist($userid)
    {
        return $this->getORM()->select('hardwareid','id')
            ->where('userid',$userid)
            ->fetchAll();
    }

    public function getIdbyUserHard($userid,$hardid)
    {
        $arrtemp = array('userid'=>$userid,'hardwareid'=>$hardid);
        return $this->getORM()->select('id')
            ->where($arrtemp)
            ->fetch();
    }

    public function addHardlist($userid,$hardid)
    {
        $arrtemp = array('userid'=>$userid,'hardwareid'=>$hardid);
        $this->getORM()
            ->insert($arrtemp);
        return $this->getORM()
            ->insert_id();
    }

    public function deleteHardlist($userid,$idat)
    {
        foreach ($idat as $index=>$value)
        {
            $tmp = array('userid'=>$userid,'hardwareid'=>$value);
            $this->getORM()
                ->where($tmp)
                ->delete();
        }
    }


    //指定表名
    protected function getTableName($id) {
        return 'p_userhardware';
    }
}