<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/11/25 0025
 * Time: 12:23
 */
class Domain_Hard
{
    //获取hard列表
    //1.通过用户名查找绑定硬件id
    //2.通过硬件id获取hard表中其他信息并返回
    //@return int code 操作码，0表示成功， 1表示用户不存在  2表示hardid不存在
    public function getHardlist($userid)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        $modelbind = new Model_Bind();
        $modelhard = new Model_Hard();
        $retBind=$modelbind->getHardlist($userid);
        if($retBind==false)
        {
            $rs['code']=1;
            $rs['msg']='user id not exit!';
            return $rs;
        }
        else
        {
            $index = 0;
            $arrdata = array();
            foreach ($retBind as $value)
            {
                $retHard = $modelhard->getHardInfo($value['hardwareid']);
                if($retHard==false)
                {
                    $rs['code']=2;
                    $rs['msg']='hardware id is error!';
                    return $rs;
                }
                else
                {
                    $arrdata[$index] = $retHard;
                    $index++;
                }
            }
            $rs['code']=0;
            $rs['msg']='';
            $rs['data']=$arrdata;
            return $rs;
        }
    }

    public function addHardlist($userid,$idat)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        //查找userid是否存在
        $modeluser = new Model_Usera();
        $retuser = $modeluser->getInfoById($userid);
        if($retuser==false)
        {
            $rs['code']=1;
            $rs['msg']='user id not exit!';
            return $rs;
        }
        else
        {
            $modelhard = new Model_Hard();
            $rethard1 = $modelhard->getIdByNetid($idat['netid']);
            $hardwareid = 0;
            if($rethard1==false)
            {
                $hardwareid = $modelhard->addHardRetid($idat);
                $tmp = array('appid'=>0,'hardwareid'=>$hardwareid);
                $modelapp = new Model_App();
                $modelapp->addapplist($tmp);
            }
            else
            {
                $hardwareid = $rethard1['id'];
            }
            if($hardwareid==0)
            {
                $rs['code']=2;
                $rs['msg']='hardware add fail!';
                return $rs;
            }
            else
            {
                $modelbind = new Model_Bind();
                if($modelbind->getIdbyUserHard($userid,$hardwareid)==false)
                {
                    $modelbind->addHardlist($userid,$hardwareid);
                }
                $rs['code']=0;
                $rs['msg']='';
                $rs['data']=$hardwareid;
                return $rs;
            }
        }
    }


    //更新name
    //1.通过hardwareid进行name更新
    //@return int code 操作码，0表示成功， 1表示更新失败
    public function updatehardlist($hardid,$name)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        $model = new Model_Hard();
        $ret = $model->updateHard($hardid,$name);
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

    public function deletehardlist($userid,$idat)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        //查找userid是否存在
        $modeluser = new Model_Usera();
        $retuser = $modeluser->getInfoById($userid);
        if($retuser==false)
        {
            $rs['code']=1;
            $rs['msg']='user id not exit!';
            return $rs;
        }
        else
        {
            $modelbind = new Model_Bind();
            $modelbind->deleteHardlist($userid,$idat);
            $rs['code']=0;
            $rs['msg']='delete ok!';
            return $rs;
        }
    }


}