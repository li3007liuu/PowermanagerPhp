<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/11/30 0030
 * Time: 17:19
 */
class Domain_App
{
    /*
     * 获取 applist
     * 1.查询hardid是否存在
     * 2.查询app表中获取全部数据
     */
    public function getapplist($hardid)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        $modelhard = new Model_Hard();
        $rethard = $modelhard ->getHardInfo($hardid);
        if($rethard==false)
        {
            $rs['code']=1;
            $rs['msg']='hardid not exit!';
            return $rs;
        }
        else
        {
            $modelapp = new Model_App();
            $retapp = $modelapp ->getapplist($hardid);
            if($retapp==false)
            {
                $rs['code']=2;
                $rs['msg']='selete hardid fail!';
                return $rs;
            }
            else
            {
                $rs['code']=0;
                $rs['data']=$retapp;
                $rs['msg']='';
                return $rs;
            }
        }
    }

    /*
     * 新增电器信息至applist
     * 1.查询hardid是否存在
     * 2.添加信息至applist表中，并返回新增的id
     */
    public function addapplist($hardid,$data)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        $modelhard = new Model_Hard();
        $rethard = $modelhard ->getHardInfo($hardid);
        if($rethard==false)
        {
            $rs['code']=1;
            $rs['msg']='hardid not exit!';
            return $rs;
        }
        else
        {
            $modelapp = new Model_App();
            $retapp = $modelapp->addapplist($data);
            if($retapp==false)
            {
                $rs['code']=2;
                $rs['msg']='add applist add fail ';
                return $rs;
            }
            else
            {
                $rs['code']=0;
                $rs['msg']='';
                $rs['data']=$retapp;
                return $rs;
            }
        }
    }

    public function updateapplist($id,$idat)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        $modelapp = new Model_App();
        $ret=$modelapp ->updateapplist($id,$idat);
        if($ret==false)
        {
            $rs['code']=1;
            $rs['msg']='update fail!';
            return $rs;
        }
        else
        {
            $rs['code']=0;
            $rs['msg']='update sucess!';
            return $rs;
        }
    }
    public function deleteapplist($id,$data)
    {
        $rs = array('code' => 0, 'msg' => '', 'data' => array());
        $modelapp = new Model_App();
        $modelday = new Model_StaticDay();
        $modelweek = new Model_StaticWeek();
        $modelmonth = new Model_StaticMonth();
        $modelapp->deleteapplist($id);
        $modelday->deleteday($id);
        $modelweek->deleteweek($id);
        $modelmonth->deletemonth($id);
        foreach ($data as $index=>$value)
        {
            $itmp = substr($index, 5, strlen($index));
            $tmp = array('appid'=>(int)$itmp);
            $modelapp->updateapplist($value,$tmp);
        }
        return $rs;
    }

    public function deleteallapplist($hardid)
    {
        $rs = array('code' => 0, 'msg' => '', 'data' => array());
        $modelhard = new Model_Hard();
        $rethard = $modelhard->getHardInfo($hardid);
        if ($rethard == false)
        {
            $rs['code'] = 1;
            $rs['msg'] = 'hardid not exit!';
            return $rs;
        }
        else
        {
            $modelapp = new Model_App();
            $modelday = new Model_StaticDay();
            $modelweek = new Model_StaticWeek();
            $modelmonth = new Model_StaticMonth();
            $retapp = $modelapp ->getapplist($hardid);
            //var_dump($retapp);
            foreach ($retapp as $index=>$value)
            {
                //var_dump($value);
                echo $value['id'];
                if($value['appid']>0)
                {
                    //$modelapp->deleteapplist($value['id']);
                    $modelday->deleteday($value['id']);
                    $modelweek->deleteweek($value['id']);
                    $modelmonth->deletemonth($value['id']);
                    $modelapp->deleteapplist($value['id']);
                }
            }
            $rs['code'] = 0;
            $rs['msg'] = 'delete all finish!';
            return $rs;
        }
    }
}