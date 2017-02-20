<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/11/30 0030
 * Time: 15:57
 */
class Api_App extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            //get
            'getapplist'   =>array(
                'hardId'     =>$this->getAppTableRules('hardid',true),
            ),
            'addapplist'  =>array(
                'hardId'    =>$this->getAppTableRules('hardid',true),
                'appId'     =>$this->getAppTableRules('appid',true),
                'appName'   =>$this->getAppTableRules('appname',true),
                'appImg1'   =>$this->getAppTableRules('appimg1',true),
                'appImg2'   =>$this->getAppTableRules('appimg2',true),
                'appModelnum'=>$this->getAppTableRules('modenum',true),
            ),
            'updateapplist'=>array(
                'apId'      =>$this->getAppTableRules('id',true),
                'apData'    =>$this->getAppTableRules('data',true),
            ),
            'deleteapplist' =>array(
                'apId'      =>$this->getAppTableRules('id',true),
                'apData'    =>$this->getAppTableRules('data',true),
            ),
            'deleteallapplist'=>array(
                'hardId'    =>$this->getAppTableRules('hardid',true),
            ),
        );
    }


    /**
     * 通过hardid获取applist列表信息
     * @desc 用户获取设备下的电器列表
     * @return int code 操作码，0表示成功， 1表示设备不存在
     * @return string msg 提示信息
     * @return array data [{"id":"1","name":"","appid":"0","hardwareid":"50","imageid1":"0","imageid2":"0","modenum":"0"}]
     */
    public function getapplist()
    {
        $domain = new Domain_App();
        return $domain->getapplist($this->hardId);
    }
    /**
     * 通过hardid与appInfo将新增电器信息添加至数据表app中
     * @desc 用户新增电器信息
     * @return int code 操作码，0表示成功， 1表示设备不存在
     * @return string msg 提示信息
     * @return int data 新增之后的id
     */
    public function addapplist()
    {
        $tmp = array('appid'=>$this->appId,'hardwareid'=>$this->hardId,
            'name'=>$this->appName,'imageid1'=>$this->appImg1,
            'imageid2'=>$this->appImg2,'modenum'=>$this->appModelnum);
        $domain = new Domain_App();
        return $domain->addapplist($this->hardId,$tmp);
    }

    /**
     * 通过appId进行电器其他信息更新
     * @desc 用户更新电器信息
     * @return int code 操作码，0表示成功， 1表示电器id不存在
     * @return string msg 提示信息
     */
    public function updateapplist()
    {
        $test = $this->apData;
        $str=stripslashes($test);
        $idat=json_decode($str, true);
        $domain = new Domain_App();
        return $domain->updateapplist($this->apId,$idat);
    }

    /**
     * 通过appId进行电器删除，删除对应的day、week、month统计表，更新其他appid列表
     * @desc 用户delete电器
     * @return int code 操作码，0表示成功， 1表示电器id不存在
     * @return string msg 提示信息
     */

    public function deleteapplist()
    {
        $test = $this->apData;
        $str=stripslashes($test);
        $idat=json_decode($str, true);
        $domain = new Domain_App();
        return $domain->deleteapplist($this->apId,$idat);
    }

    /**
     * 通过hardId进行电器删除，删除对应的day、week、month统计表
     * @desc 用户delete电器
     * @return int code 操作码，0表示成功， 1表示电器id不存在
     * @return string msg 提示信息
     */
    public function deleteallapplist()
    {
        $domain = new Domain_App();
        return $domain->deleteallapplist($this->hardId);
    }
    /*
     * 获取hard表中参数规则数组
     * 包含 hardid hardname userid hardnetid hardtype
     *
     */
    private function getAppTableRules($ntable,$require)
    {
        if($ntable=='appid')
        {
            return array(
                'name'          =>  'app_id',
                'type'          =>  'int',
                'min'           =>  0,
                'require'       =>  $require,
                'desc'          =>  '电器在设备中的id'
            );
        }
        else if($ntable=='appname')
        {
            return array(
                'name'          =>  'app_name',
                'type'          =>  'string',
                'min'           =>  4,
                'require'       =>  $require,
                'desc'          =>  '电器在设备中的名称'
            );
        }
        else if($ntable=='hardid')
        {
            return array(
                'name'          =>  'hard_id',
                'type'          =>  'int',
                'min'           =>  1,
                'require'       =>  $require,
                'desc'          =>  '电器对应在设备的id'
            );
        }
        else if($ntable=='appimg1')
        {
            return array(
                'name'          =>  'app_img1',
                'type'          =>  'int',
                'min'           =>  0,
                'require'       =>  $require,
                'desc'          =>  '电器图标1'
            );
        }
        else if($ntable=='appimg2')
        {
            return array(
                'name'          =>  'app_img2',
                'type'          =>  'int',
                'min'           =>  0,
                'require'       =>  $require,
                'desc'          =>  '电器图标2'
            );
        }
        else if($ntable=='modenum')
        {
            return array(
                'name'          =>  'app_modenum',
                'type'          =>  'int',
                'min'           =>  0,
                'require'       =>  $require,
                'desc'          =>  '电器模式数'
            );
        }
        else if($ntable=='id')
        {
            return array(
                'name'          =>  'id',
                'type'          =>  'int',
                'min'           =>  0,
                'require'       =>  $require,
                'desc'          =>  '电器表外键id'
            );
        }
        else if($ntable=='data')
        {
            return array(
                'name'          =>  'data',
                'type'          =>  'string',
                'min'           =>  1,
                'require'       =>  $require,
                'desc'          =>  '更新时内容，删除单个时appid:{ "appid1":13, "appid2":25, "appid3":26, "appid4":27 }'
            );
        }
        else
        {
            return null;
        }
    }
}