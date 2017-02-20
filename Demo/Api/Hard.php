<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/11/24 0024
 * Time: 20:27
 */
class Api_Hard extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            //get
            'gethardlist'   =>array(
                'userId'     =>$this->getHardTableRules('userid',true),
            ),
            //post
            'addhardlist'   =>array(
                'userId'     =>$this->getHardTableRules('userid',true),
                'hardNetid'  =>$this->getHardTableRules('hardnetid',true),
                'hardName'   =>$this->getHardTableRules('hardname',true),
                'hardType'   =>$this->getHardTableRules('hardtype',true),
            ),
            //post
            'deletehardlist'=>array(
                'userId'     =>$this->getHardTableRules('userid',true),
                'deleteData'       =>$this->getHardTableRules('ddata',true),
            ),
            //post
            'updatehardlist'=>array(
                'hardId'     =>$this->getHardTableRules('hardid',true),
                'hardname'   =>$this->getHardTableRules('hardname',true),
            ),
        );
    }

    /**
     * 通过userid获取hardlist列表信息
     * @desc 用户获取绑定设备列表
     * @return int code 操作码，0表示成功， 1表示用户不存在  2表示hardid不存在
     * @return string msg 提示信息
     * @return array hardmsg array [{},{}]
     */
    public function gethardlist()
    {
        $domain = new Domain_Hard();
        return $domain->getHardlist($this->userId);
    }

    /**
     * 通过netid name type userid 进行设备新建与用户绑定
     * @desc 用户新增设备
     * @return int code 操作码，0表示成功， 1表示用户不存在  2表示netid错误
     * @return string msg 提示信息
     * @return int data 添加成功之后的hardid
     */
    public function addhardlist()
    {
        $idat = array('netid'=>$this->hardNetid,'name'=>$this->hardName,'type'=>$this->hardType);
        $domain = new Domain_Hard();
        return $domain->addHardlist($this->userId,$idat);
    }


    /**
     * 通过netid name type userid 进行设备新建与用户绑定
     * @desc 用户新增设备
     * @return int code 操作码，0表示成功， 1表示用户不存在  2表示netid错误
     * @return string msg 提示信息
     */
    public function updatehardlist()
    {
        $domain = new Domain_Hard();
        return $domain ->updatehardlist($this->hardId,$this->hardname);
    }


    /**
     * 通过userid与hardid删除bind表中数据项
     * @desc 设备绑定删除
     * @return int code 操作码，0表示成功， 1表示用户不存在
     * @return string msg 提示信息
     */
    public function deletehardlist()
    {
        $test = $this->deleteData;
        $str=stripslashes($test);
        $idat=json_decode($str, true);
        $domain = new Domain_Hard();
        return $domain->deletehardlist($this->userId,$idat);
    }

    /*
     * 获取hard表中参数规则数组
     * 包含 hardid hardname userid hardnetid hardtype
     *
     */
    private function getHardTableRules($ntable,$require)
    {
        if($ntable=='hardid')
        {
            return array(
                'name'          =>  'hard_id',
                'type'          =>  'int',
                'min'           =>  1,
                'require'       =>  $require,
                'desc'          =>  '硬件设备id'
            );
        }
        else if($ntable=='hardname')
        {
            return array(
                'name'          =>  'hard_name',
                'type'          =>  'string',
                'min'           =>  4,
                'require'       =>  $require,
                'desc'          =>  '硬件设备名'
            );
        }
        else if($ntable=='userid')
        {
            return array(
                'name'          =>  'user_id',
                'type'          =>  'int',
                'min'           =>  1,
                'require'       =>  $require,
                'desc'          =>  '用户表中用户ID'
            );
        }
        else if($ntable=='hardnetid')
        {
            return array(
                'name'          =>  'hard_netid',
                'type'          =>  'string',
                'min'           =>  12,
                'require'       =>  $require,
                'desc'          =>  '硬件设备的MAC'
            );
        }
        else if($ntable=='hardtype')
        {
            return array(
                'name'          =>  'hard_type',
                'type'          =>  'int',
                'min'           =>  1,
                'require'       =>  $require,
                'desc'          =>  '硬件设备的类型'
            );
        }
        else if($ntable=='ddata')
        {
            return array(
                'name'          =>  'hard_data',
                'type'          =>  'string',
                'min'           =>  1,
                'require'       =>  $require,
                'desc'          =>  '要删除的硬件设备的id,格式为Json。例如{"1":56}'
            );
        }
        else
        {
            return null;
        }
    }
}