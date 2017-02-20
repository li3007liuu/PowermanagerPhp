<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/11/25 0025
 * Time: 11:35
 */
/*
define("SQLTBID","id");
define("SQLTBNAME","name");
define("SQLTBNETID","netid");
define("SQLTBTYPE","type");*/

class Model_Hard extends PhalApi_Model_NotORM
{
    public function getHardInfo($hardid)
    {
        return $this->getORM()->select('id','name','netid','type')
            ->where('id',$hardid)
            ->fetch();
    }
    public function getIdByNetid($netid)
    {
        return $this->getORM()->select('id')
            ->where('netid',$netid)
            ->fetch();
    }
    public function addHardRetid($idat)
    {
        $this->getORM()
            ->insert($idat);
        return $this->getORM()
            ->insert_id();
    }
    public function updateHard($id,$name)
    {
        $tmp = array('name'=>$name);
        return $this->getORM()
            ->where('id',$id)
            ->update($tmp);
    }
    //指定表名
    protected function getTableName($id) {
        return 'p_hardware';
    }
}