<?php

/**
 * Created by PhpStorm.
 * User: li300
 * Date: 2016/12/5 0005
 * Time: 11:07
 */
class Api_Waste extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            //get
            'gettodaywaste'   =>array(
                'hardId'     =>$this->getWasteTableRules('hardid',true),
            ),
            //get
            'getdaywaste'   =>array(
                'appId'     =>$this->getWasteTableRules('appid',true),
            ),
            //get
            'getweekwaste'   =>array(
                'appId'     =>$this->getWasteTableRules('appid',true),
            ),
            //get
            'getmonthwaste'   =>array(
                'appId'     =>$this->getWasteTableRules('appid',true),
            ),
        );
    }
    /**
     * 通过hardid获取applist列表下的功耗信息
     * @desc 用户获取设备下的电器列表的功耗信息
     * @return int code 操作码，0表示成功， 1表示设备不存在
     * @return string msg 提示信息
     * @return array data [{"appid":"1","waste":"33"}]
     */
    public function gettodaywaste()
    {
        $domain = new Domain_Waste();
        return $domain->gettodaywaste($this->hardId);
    }

    /**
     * 通过appid获取前20 days 功耗信息
     * @desc 用户获取设备下的电器列表的功耗信息
     * @return int code 操作码，0表示成功， 1表示设备不存在
     * @return string msg 提示信息
     * @return array data [{"appid":"1","waste":"33"}]
     */
    public function getdaywaste()
    {
        $domain = new Domain_Waste();
        return $domain->getdaywaste($this->appId);
    }
    /**
     * 通过appid获取前16 weeks 功耗信息
     * @desc 用户获取设备下的电器列表的功耗信息
     * @return int code 操作码，0表示成功， 1表示设备不存在
     * @return string msg 提示信息
     * @return array data [{"appid":"1","waste":"33"}]
     */
    public function getweekwaste()
    {
        $domain = new Domain_Waste();
        return $domain->getweekwaste($this->appId);
    }

    /**
     * 通过appid获取前12 months 功耗信息
     * @desc 用户获取设备下的电器列表的功耗信息
     * @return int code 操作码，0表示成功， 1表示设备不存在
     * @return string msg 提示信息
     * @return array data [{"appid":"1","waste":"33"}]
     */
    public function getmonthwaste()
    {
        $domain = new Domain_Waste();
        return $domain->getmonthwaste($this->appId);
    }





    private function getWasteTableRules($ntable,$require)
    {
        if ($ntable == 'appid') {
            return array(
                'name' => 'app_id',
                'type' => 'int',
                'min' => 1,
                'require' => $require,
                'desc' => '电器表中的电器外键id'
            );
        }
        else if($ntable=='hardid')
        {
            return array(
                'name'          =>  'hard_id',
                'type'          =>  'int',
                'min'           =>  1,
                'require'       =>  $require,
                'desc'          =>  '设备表中的设备外键id'
            );
        }
        else
        {
            return null;
        }
    }
}