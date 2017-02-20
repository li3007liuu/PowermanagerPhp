<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/11/25 0025
 * Time: 11:44
 */
/*
define("SQLTBID","id");
define("SQLTBNAME","name");
define("SQLTBAPPID","appid");
define("SQLTBHARDTOAPP","hardwareid");
define("SQLTBAPPIMAGE1","imageid1");
define("SQLTBAPPIMAGE2","imageid2");
define("SQLTBAPPMODENUM","modenum");*/



class Model_App extends PhalApi_Model_NotORM
{
    public function getapplist($hardid)
    {
        return $this->getORM()
            ->select('id','name','appid','hardwareid','imageid1','imageid2','modenum')
            ->where('hardwareid',$hardid)
            ->fetchAll();
    }

    public function addapplist($data)
    {
        $this->getORM()
            ->insert($data);
        return $this->getORM()
            ->insert_id();
    }
    //根据id删除对应表
    public function deleteapplist($id)
    {
        return $this->getORM()
            ->where('id',$id)
            ->delete();
    }

    public function updateapplist($id,$idat)
    {
        return $this->getORM()
            ->where('id',$id)
            ->update($idat);
    }

    //指定表名
    protected function getTableName($id) {
        return 'p_appliance';
    }
}