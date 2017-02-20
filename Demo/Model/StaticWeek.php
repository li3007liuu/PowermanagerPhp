<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/11/25 0025
 * Time: 11:47
 */
class Model_StaticWeek extends PhalApi_Model_NotORM
{

    //根据id删除对应表
    public function deleteweek($id)
    {
        return $this->getORM()
            ->where('appid',$id)
            ->delete();
    }

    public function getWastes($appid,$date)
    {
        $tmp = array('appid'=>$appid,'date'=>$date);
        return $this->getORM()
            ->select('date','waste','appid')
            ->where($tmp)
            ->fetch();
    }

    //指定表名
    protected function getTableName($id)
    {
        return 'p_appweekstatic';
    }
}