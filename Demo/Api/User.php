<?php

class Api_User extends PhalApi_Api {

    public function getRules() {
        return array(
            'getBaseInfo' => array(
                'userId' => array('name' => 'user_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
            ),
            'getMultiBaseInfo' => array(
                'userIds' => array('name' => 'user_ids', 'type' => 'array', 'format' => 'explode', 'require' => true, 'desc' => '用户ID，多个以逗号分割'),
            ),
			'getEmailInfo' => array(
				'userEmail' => array('name'=>'user_email','type' => 'string','min'=>4,'require' =>true,'desc'=>'用户邮箱'),
			),
			'getMobileInfo' => array(
				'userMobile' => array('name'=>'user_mobile','type' => 'string','min'=>11,'require' =>true,'desc'=>'用户手机'),
			),
			'getLoginById' => array(
                'user2Id' => array('name' => 'user_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'user2Pass' => array('name'=>'user_pass','type' => 'string','min'=>6,'require' =>true,'desc'=>'用户手机'),
            ),
			'getLoginOutById' => array(
                'user3Id' => array('name' => 'user_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
            ),
			'setUserNameById' => array(
                'user4Id' => array('name' => 'user_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'user4Name' => array('name'=>'user_name','type' => 'string','min'=>6,'require' =>true,'desc'=>'用户名称'),
			),
			'setUserPassById' => array(
                'user5Id' => array('name' => 'user_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'user5Pass' => array('name'=>'user_pass','type' => 'string','min'=>6,'require' =>true,'desc'=>'用户名称'),
			),
			'getRegisterByEmail' => array(
                'user6Email'  => array('name'=>'user_email','type' => 'string','min'=>4,'require' =>true,'desc'=>'用户邮箱'),
				'user6Pass' => array('name'=>'user_pass','type' => 'string','min'=>6,'require' =>true,'desc'=>'用户名称'),
			),
			'getRegisterByMobile' => array(
                'user7Mobile'  =>array('name'=>'user_mobile','type' => 'string','min'=>11,'require' =>true,'desc'=>'用户手机'),
				'user7Pass' => array('name'=>'user_pass','type' => 'string','min'=>6,'require' =>true,'desc'=>'用户名称'),
			),
        );
    }

    /**
     * 获取用户基本信息
     * @desc 用于获取单个用户基本信息
     * @return int code 操作码，0表示成功， 1表示用户不存在
     * @return object info 用户信息对象
     * @return int info.id 用户ID
     * @return string info.name 用户名字
     * @return string info.note 用户来源
     * @return string msg 提示信息
     */
    public function getBaseInfo() {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_User();
        $info = $domain->getBaseInfo($this->userId);

        if (empty($info)) {
            DI()->logger->debug('user not found', $this->userId);

            $rs['code'] = 1;
            $rs['msg'] = T('user not exists');
            return $rs;
        }

        $rs['info'] = $info;

        return $rs;
    }

    /**
     * 批量获取用户基本信息
     * @desc 用于获取多个用户基本信息
     * @return int code 操作码，0表示成功
     * @return array list 用户列表
     * @return int list[].id 用户ID
     * @return string list[].name 用户名字
     * @return string list[].note 用户来源
     * @return string msg 提示信息
     */
    public function getMultiBaseInfo() {
        $rs = array('code' => 0, 'msg' => '', 'list' => array());

        $domain = new Domain_User();
        foreach ($this->userIds as $userId) {
            $rs['list'][] = $domain->getBaseInfo($userId);
        }

        return $rs;
    }
	
	 /**
     * 查询用户邮箱是否没注册
     * @desc 用于获取单个用户基本信息
     * @return int code 操作码，1表示成功， 0表示用户不存在
     * @return object info 用户信息对象
     * @return int info.id 用户昵称
     * @return string info.name 用户邮箱
     * @return string info.note 用户手机
     * @return string msg 提示信息
     */
    public function getEmailInfo() {
		//rs 为操作码 提示信息 用户信息的数组
        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_SplxAppUser();
        $info = $domain->getBaseInfoByEmail($this->userEmail);

        if (empty($info)) {
            DI()->logger->debug('user not found', $this->userEmail);

            $rs['code'] = 1;
            $rs['msg'] = T('user not exists');
            return $rs;
        }

        $rs['info'] = $info;

        return $rs;
    }
		 /**
     * 查询用户手机号是否注册
     * @desc 用于获取单个用户基本信息
     * @return int code 操作码，2表示成功， 0表示用户不存在
     * @return object info 用户信息对象
     * @return int info.id 用户昵称
     * @return string info.name 用户邮箱
     * @return string info.note 用户手机
     * @return string msg 提示信息
     */
    public function getMobileInfo() {
		//rs 为操作码 提示信息 用户信息的数组
        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_SplxAppUser();
        $info = $domain->getBaseInfoByMobile($this->userMobile);

        if (empty($info)) {
            DI()->logger->debug('user not found', $this->userMobile);

            $rs['code'] = 1;
            $rs['msg'] = T('user not exists');
            return $rs;
        }

        $rs['info'] = $info;

        return $rs;
    }
	
	public function getLoginById() {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_SplxAppUser();
        $info = $domain->getBaseInfoById($this->user2Id);
	
        if (empty($info)) {
            DI()->logger->debug('user not found', $this->user2Id);

            $rs['code'] = 1;
            $rs['msg'] = T('user not exists');
            return $rs;
        }
		else 
		{
			if($info['pass']==($this->user2Pass))
			{
				$rs['code'] = 0;
				$rs['info'] = $domain->setOnlineTrueD($this->user2Id);

			}
			else
			{
				$rs['code'] = 3;
			}
		}
        return $rs;
    }
	public function getLoginOutById() {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $domain = new Domain_SplxAppUser();
		$rs['info'] = $domain->setOnlineFalseD($this->user3Id);
		return $rs;
	}
	public function setUserNameById() {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $domain = new Domain_SplxAppUser();
		$rs['info'] = $domain->setUserNameD($this->user4Id,$this->user4Name);
		if($rs['info']==false)
		{
			//表示更新失败
			$rs['code']=1;
		}
		return $rs;
	}
	public function setUserPassById() {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $domain = new Domain_SplxAppUser();
		$rs['info'] = $domain->setUserPassD($this->user5Id,$this->user5Pass);
		if($rs['info']==false)
		{
			//表示更新失败
			$rs['code']=1;
		}
		return $rs;
	}
	public function getRegisterByEmail() {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $domain = new Domain_SplxAppUser();
		$emailIs = $domain->getBaseInfoByEmail($this->user6Email);
		$nameIs = $domain->getBaseInfoByName($this->user6Email);
		//查询是否有该用户存在
		if(empty($emailIs)&&empty($nameIs))
		{
			//用户不存在插入用户name
			$userId = $domain->newUserNameD($this->user6Email);
			$domain->setUserEmailD($userId,$this->user6Email);
			$domain->setUserPassD($userId,$this->user6Pass);
			$rs['info'] = $domain->getBaseInfoByEmail($this->user6Email);
		}
		else
		{
			//用户存在报错
			$rs['code']=1;
		}
		return $rs;
	}
	public function getRegisterByMobile() {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $domain = new Domain_SplxAppUser();
		//查询是否有该用户存在
		$mobileIs = $domain->getBaseInfoByMobile($this->user7Mobile);
		$nameIs = $domain->getBaseInfoByName($this->user7Mobile);
		if(empty($mobileIs)&&empty($nameIs))
		{
			$userId = $domain->newUserNameD($this->user7Mobile);
			$domain->setUserMobileD($userId,$this->user7Mobile);
			$domain->setUserPassD($userId,$this->user7Pass);
			$rs['info'] = $domain->getBaseInfoByMobile($this->user7Mobile);
		}
		else
		{
			//表示更新失败
			$rs['code']=1;
		}
		return $rs;
	}
}
