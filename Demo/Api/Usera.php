<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/11/23 0023
 * Time: 20:04
 * Api:loginin loginout register getinfo updateinfo
 */
class Api_Usera extends PhalApi_Api
{
    public function getRules()
    {

        return array(
            //post
            'loginin'   =>array(
                'userEmail'     =>$this->getUserTableRules('email',false),
                'userPass'      =>$this->getUserTableRules('pass',true),
                'userTel'       =>$this->getUserTableRules('tel',false),
            ),
            //get
            'loginout'  =>array(
                'userId'        =>$this->getUserTableRules('id',true),
            ),
            //post
            'register'  =>array(
                'userEmail' =>$this->getUserTableRules('email',false),
                'userPass'  =>$this->getUserTableRules('pass',true),
                'userTel'   =>$this->getUserTableRules('tel',false),
            ),
            //get
            'getinfo'   =>array(
                'userEmail' =>$this->getUserTableRules('email',false),
                'userTel'   =>$this->getUserTableRules('tel',false),
            ),
            //post
            'updateinfo'=>array(
                'userId'    =>$this->getUserTableRules('id',true),
                'userData'  =>$this->getUserTableRules('data',true),
            ),
        );
    }

    /**
     * 通过email或tel进行账号登录
     * @desc 登录
     * @return int code 操作码，0表示成功， 1表示用户不存在  2表示密码错误
     * @return string msg 提示信息
     */
    public function loginin(){
        $domain = new Domain_Usera();
        return $domain->loginin($this->userEmail,$this->userTel,$this->userPass);
    }

    /**
     * 通过用户id登出
     * @desc 登出
     * @return int code 操作码，0表示成功， 1表示用户id不存在
     * @return string msg 提示信息
     */

    public function loginout(){
        $domain = new Domain_Usera();
        return $domain->loginout($this->userId);
    }

    /**
     * 用户通过email或tel进行注册
     * @desc 注册
     * @return int code 操作码，0表示用户不存在，注册成功， 1表示用户存在，且密码修改成功，2表示参数错误
     * @return string msg 提示信息
     * @return int data userid
     */
    public function register()
    {
        $domain = new Domain_Usera();
        return $domain->register($this->userEmail,$this->userTel,$this->userPass);
    }

    /**
     * 用户邮箱号或者手机号获取用户信息
     * @desc 获取信息
     * @return int code 操作码，0表示获取成功， 1表示用户不存在
     * @return string msg 提示信息
     * @return array data data为用户信息数组{"id",38}
     */
    public function getinfo()
    {
        $domain = new Domain_Usera();
        return $domain->getinfo($this->userEmail,$this->userTel);
    }

    /**
     * 通过用户id进行信息更新
     * @desc 更新信息
     * @return int code 操作码，0表示更新成功， 1表示无更新  ，2表示更新错误
     * @return string msg 提示信息
     */
    public function updateinfo()
    {
        //进行参数提炼
        $test = $this->userData;
        $str=stripslashes($test);
        $idat=json_decode($str, true);
        $domain = new Domain_Usera();
        return $domain->updateinfo($this->userId,$idat);
    }



    /*
     * 获取user表中参数规则数组
     * 包含 id name pass tel email face sex birthday
     *
     */
    private function getUserTableRules($ntable,$require)
    {
        if($ntable=='id')
        {
            return array(
                'name'          =>  'user_id',
                'type'          =>  'int',
                'min'           =>  1,
                'require'       =>  $require,
                'desc'          =>  '用户id'
            );
        }
        else if($ntable=='name')
        {
            return array(
                'name'          =>  'user_name',
                'type'          =>  'string',
                'min'           =>  4,
                'require'       =>  $require,
                'desc'          =>  '用户名'
            );
        }
        else if($ntable=='pass')
        {
            return array(
                'name'          =>  'user_pass',
                'type'          =>  'string',
                'min'           =>  6,
                'require'       =>  $require,
                'desc'          =>  '用户密码'
            );
        }
        else if($ntable=='tel')
        {
            return array(
                'name'          =>  'user_tel',
                'type'          =>  'string',
                'min'           =>  11,
                'require'       =>  $require,
                'desc'          =>  '用户手机号'
            );
        }
        else if($ntable=='email')
        {
            return array(
                'name'          =>  'user_email',
                'type'          =>  'string',
                'require'       =>  $require,
                'desc'          =>  '用户邮箱'
            );
        }
        else if($ntable=='face')
        {
            return array(
                'name'          =>  'user_face',
                'type'          =>  'string',
                'min'           =>  1,
                'require'       =>  $require,
                'desc'          =>  '用户头像存储路径'
            );
        }
        else if($ntable=='birthday')
        {
            return array(
                'name'          =>  'user_birthday',
                'type'          =>  'string',
                'min'           =>  1,
                'require'       =>  $require,
                'desc'          =>  '用户生日'
            );
        }
        else if($ntable=='sex')
        {
            return array(
                'name'          =>  'user_sex',
                'type'          =>  'boolean',
                'require'       =>  $require,
                'desc'          =>  '用户性别'
            );
        }
        else if($ntable=='data')
        {
            return array(
                'name'          =>  'data',
                'type'          =>  'string',
                'min'           =>  1,
                'require'       =>  $require,
                'desc'          =>  '要更新的用户信息,格式为Json。例如{"name":newname}'
            );
        }
        else
        {
            return null;
        }
    }
}