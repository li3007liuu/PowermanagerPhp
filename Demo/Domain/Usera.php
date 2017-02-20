<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/11/24 0024
 * Time: 11:54
 */
class Domain_Usera
{
    public function loginin($useremail,$usertel,$userpass)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        $model = new Model_Usera();
        $rs['code']=$model->loginin($useremail,$usertel,$userpass);
        if($rs['code']==0)
        {
            $rs['msg']='login in sucess!';
        }
        else if($rs['code']==1)
        {
            $rs['msg']='user not exit!';
        }
        else if($rs['code']==2)
        {
            $rs['msg']='user pass error!';
        }
        return $rs;

    }

    public function loginout($userId)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        $model = new Model_Usera();
        $ret = $model->loginout($userId);
        if($ret==2)
        {
            $rs['code']=0;
            $rs['msg']='user have login out!';
        }
        else if($ret==1)
        {
            $rs['code']=1;
            $rs['msg']='user id is not exit!';
        }
        else
        {
            $rs['code']=0;
            $rs['msg']='login out sucess !';
        }
        return $rs;
    }

    public function register($useremail,$usertel,$userpass)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        $model = new Model_Usera();
        $ret = $model->register($useremail,$usertel,$userpass);
        $rs['code']=$ret['code'];
        $rs['data']=$ret['data'];
        return $rs;
    }

    public function getinfo($useremail,$usertel)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        $model = new Model_Usera();
        $ret = $model->getinfo($useremail,$usertel);
        $rs['code']=$ret['code'];
        $rs['data']=$ret['data'];
        return $rs;
    }

    public function updateinfo($id,$data)
    {
        $rs = array('code'=>0,'msg'=>'','data'=>array());
        $model = new Model_Usera();
        $ret=$model->updateinfo($id,$data);
        if($ret==2)
        {
            $rs['code']=1;
            $rs['msg']='update fail!';
        }
        else
        {
            $rs['code']=0;
            $rs['msg']='update sucess!';
        }
        return $rs;
    }
}