<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/12/5 0005
 * Time: 11:21
 */
class Domain_Waste
{
    /*
    * 获取 applist
    * 1.查询hardid是否存在
    * 2.查询app表中获取全部数据
    */
    public function gettodaywaste($hardid)
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
                $retwaste = array();
                $index  = 0;
                foreach ($retapp as $value)
                {
                    $twaste = array();
                    $twaste['appid']=$value['appid'];
                    $twaste['waste']=0;
                    $retwaste[$index]=$twaste;
                    $index++;
                }
                $rs['code']=0;
                $rs['data']=$retwaste;
                $rs['msg']='';
                return $rs;
            }
        }
    }

    public function getdaywaste($appid)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        $year = date('Y');
        $days = date('z');
        $waste0 = array('appid'=>$appid,'waste'=>0,'wasteh1'=>0,'wasteh2'=>0,'wasteh3'=>0,'wasteh4'=>0,'wasteh5'=>0,'wasteh6'=>0,
            'wasteh7'=>0,'wasteh8'=>0,'wasteh9'=>0,'wasteh10'=>0,'wasteh11'=>0,'wasteh12'=>0);
        //添加从redis中获取的当日信息
        $towaste=$waste0;
        $towaste['date']=$year*1000 + $days;
        $ret = array();
        $ret[0]=$towaste;
        $modelwaste = new Model_StaticDay();
        for($i=1;$i<20;$i++)
        {
            if($days>$i)
            {
                $date = $year * 1000 + $days - $i;
            }
            else
            {
                $year2 = $year - 1;
                if (($year2 % 4 == 0) && ($year2 % 100 != 0) || ($year2 % 400 == 0)) {
                    $day2 = 366;
                } else {
                    $day2 = 365;
                }
                $date = $year2*1000 + $day2 + $days - $i;
            }
            $retdaywaste = $modelwaste->getWastes($appid,$date);
            if($retdaywaste==false)
            {
                $tmp=$waste0;
                $tmp['date']=$date;
                $ret[$i]=$tmp;
            }
            else
            {
                $ret[$i]=$retdaywaste;
            }
        }
        $rs['data']=$ret;
        return $rs;
    }

    public function getweekwaste($appid)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        $year = date('Y');
        $weeks = date('W');
        $waste0 = array('appid'=>$appid,'waste'=>0);
        //添加从redis中获取的当日信息
        $towaste=$waste0;
        $towaste['date']=$year*1000 + $weeks;
        $ret = array();
        $ret[0]=$towaste;
        $modelwaste = new Model_StaticWeek();
        for($i=1;$i<16;$i++)
        {
            if($weeks>$i)
            {
                $date = $year * 1000 + $weeks - $i;
            }
            else
            {
                $year2 = $year - 1;
                $weeks2 = date('W',mktime(0,0,0,12,31,$year2));
                $date = $year2*1000 + $weeks2 + $weeks - $i;
            }
            $retdaywaste = $modelwaste->getWastes($appid,$date);
            if($retdaywaste==false)
            {
                $tmp=$waste0;
                $tmp['date']=$date;
                $ret[$i]=$tmp;
            }
            else
            {
                $ret[$i]=$retdaywaste;
            }
        }
        $rs['data']=$ret;
        return $rs;
    }
    public function getmonthwaste($appid)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        $year = date('Y');
        $months = date('m');
        $waste0 = array('appid'=>$appid,'waste'=>0);
        //添加从redis中获取的当日信息
        $towaste=$waste0;
        $towaste['date']=$year*1000 + $months;
        $ret = array();
        $ret[0]=$towaste;
        $modelwaste = new Model_StaticWeek();
        for($i=1;$i<12;$i++)
        {
            if($months>$i)
            {
                $date = $year * 1000 + $months - $i;
            }
            else
            {
                $year2 = $year - 1;
                $months2 = 12;
                $date = $year2*1000 + $months2 + $months - $i;
            }
            $retdaywaste = $modelwaste->getWastes($appid,$date);
            if($retdaywaste==false)
            {
                $tmp=$waste0;
                $tmp['date']=$date;
                $ret[$i]=$tmp;
            }
            else
            {
                $ret[$i]=$retdaywaste;
            }
        }
        $rs['data']=$ret;
        return $rs;
    }
}