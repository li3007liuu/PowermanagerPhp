<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/11/23 0023
 * Time: 22:03
 */

class Model_Usera extends PhalApi_Model_NotORM
{
    //获取NotORM表实例方式为 $this->getORM();
    public function loginin($useremail,$usertel,$userpass)
    {
        //通过where or 查询 email 与 tel 获取密码
        if($usertel==null)
        {
            $retselete = $this->getORM()
                ->select('pass','id')
                ->where('email',$useremail)
                ->fetchOne();
        }
        else if($useremail==null)
        {
            $retselete = $this->getORM()
                ->select('pass','id')
                ->where('tel',$usertel)
                ->fetchOne();
        }
        else
        {
            $retselete = $this->getORM()
                ->select('pass','id')
                ->or('email',$useremail)
                ->or('tel',$usertel)
                ->fetchOne();
        }
        if($retselete==false)
        {
            return 1;
        }
        else if($retselete['pass']==$userpass)
        {
            //更新online状态为1
            $this->getORM()
                ->where('id',$retselete['id'])
                ->update(array('online'=>true));
            return 0;
        }
        else
        {
            return 2;
        }
    }
    public function loginout($userId)
    {
        //查询用户id是否存在
        $retselet = $this->getORM()
            ->select('online')
            ->where('id',$userId)
            ->fetchOne();
        if($retselet==false)
        {
            return 1;
        }
        else if($retselet['online']==false)
        {
            return 2;
        }
        else
        {
            //更新online状态为0
            $this->getORM()
                ->where('id',$userId)
                ->update(array('online'=>false));
            return 0;
        }
    }
    //返回数组 code 为 0~2 data 为 id
    public function register($useremail,$usertel,$userpass)
    {

        //通过where or 查询 email 与 tel 获取密码
        if($usertel==null)
        {
            $retselete = $this->getORM()
                ->select('id')
                ->where('email',$useremail)
                ->fetchOne();
            if($retselete==null)
            {
                //表示用户名未注册
                $idat = array('email'=>$useremail,'pass'=>$userpass);
                $this->getORM()
                    ->insert($idat);
                $iid = $this->getORM()
                            ->insert_id();
                return array('code'=>0,'data'=>$iid);
            }
            else
            {
                //表示用户已经注册过，进行密码更新
                $this->getORM()
                    ->where('id',$retselete['id'])
                    ->update(array('pass'=>$userpass));
                return array('code'=>1,'data'=>$retselete['id']);
            }
        }
        else if($useremail==null)
        {
            $retselete = $this->getORM()
                ->select('id')
                ->where('tel',$usertel)
                ->fetchOne();
            if($retselete==null)
            {
                //表示用户名未注册
                $idat = array('tel'=>$usertel,'pass'=>$userpass);
                $this->getORM()
                    ->insert($idat);
                $iid = $this->getORM()
                    ->insert_id();
                return array('code'=>0,'data'=>$iid);
            }
            else
            {
                //表示用户已经注册过，进行密码更新
                $this->getORM()
                    ->where('id',$retselete['id'])
                    ->update(array('pass'=>$userpass));
                return array('code'=>1,'data'=>$retselete['id']);
            }
        }
        else
        {
            return array('code'=>2,'data'=>'');
        }
    }

    public function getinfo($useremail,$usertel)
    {
        //通过where or 查询 email 与 tel 获取信息
        $retselete = $this->getORM()
            ->select('id','name','tel','email','face','birthday','sex')
            ->or('email',$useremail)
            ->or('tel',$usertel)
            ->fetchOne();
        if($retselete==false)
        {
            return array('code'=>1,'data'=>'');
        }
        else
        {
            return array('code'=>0,'data'=>$retselete);
        }
    }

    public function updateinfo($id,$data)
    {
        $retup = $this->getORM()
            ->where('id',$id)
            ->update($data);
        //更新失败
        if($retup==false)
        {
            return 2;
        }
        //更新成功
        else if($retup==1)
        {
            return 0;
        }
        //无更新
        else if($retup==0)
        {
            return 1;
        }
        //其他错误
        else
        {
            return 3;
        }
    }


    public function getInfoById($id)
    {
        return $this->getORM()->select('name')
            ->where('id',$id)
            ->fetch();
    }

    //指定表名
    protected function getTableName($id) {
        return 'p_user';
    }
}