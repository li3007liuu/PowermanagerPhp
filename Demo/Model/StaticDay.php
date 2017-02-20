<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/11/25 0025
 * Time: 11:46
 */
class Model_StaticDay extends PhalApi_Model_NotORM
{

    //根据id删除对应表
    public function deleteday($id)
    {
        return $this->getORM()
            ->where('appid',$id)
            ->delete();
    }
    public function getWastes($appid,$date)
    {
        $tmp = array('appid'=>$appid,'date'=>$date);
        return $this->getORM()
            ->select('date','waste','wasteh1','wasteh2','wasteh3','wasteh4','wasteh5','wasteh6','wasteh7',
                'wasteh8','wasteh9','wasteh10','wasteh11','wasteh12','appid')
            ->where($tmp)
            ->fetch();
    }
    //指定表名
    protected function getTableName($id) {
        return 'p_appdaystatic';
    }
}