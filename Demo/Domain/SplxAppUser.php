<?php

class Domain_SplxAppUser {

    public function getBaseInfoByEmail($userEmail) {
        $rs = array();

		// 版本1：简单的获取
        $model = new Model_SplxAppUser();
        $rs = $model->getByUserEmail($userEmail);

		// 版本2：使用单点缓存/多级缓存 (应该移至Model层中)
		/**
        $model = new Model_User();
        $rs = $model->getByUserIdWithCache($userId);
		*/

		// 版本3：缓存 + 代理
		/**
		$query = new PhalApi_ModelQuery();
		$query->id = $userId;
		$modelProxy = new ModelProxy_UserBaseInfo();
		$rs = $modelProxy->getData($query);
		*/

        return $rs;
    }
	
	public function getBaseInfoByMobile($userEmail) {
        $rs = array();

        $model = new Model_SplxAppUser();
        $rs = $model->getByUserMobile($userEmail);

        return $rs;
    }
	
	public function getBaseInfoByName($userEmail) {
        $rs = array();

        $model = new Model_SplxAppUser();
        $rs = $model->getByUserName($userEmail);

        return $rs;
    }
	
	
	public function getBaseInfoById($userId) {
        $rs = array();

        $userId = intval($userId);
        if ($userId <= 0) {
            return $rs;
        }
		
        $model = new Model_SplxAppUser();
        $rs = $model->getByUserId($userId);
        return $rs;
    }
	public function setOnlineTrueD($userId) {
        $rs = array();

        $userId = intval($userId);
        if ($userId <= 0) {
            return $rs;
        }
		
        $model = new Model_SplxAppUser();
        $rs = $model->setOnlineTrue($userId);
        return $rs;
    }
	public function setOnlineFalseD($userId) {
        $rs = array();

        $userId = intval($userId);
        if ($userId <= 0) {
            return $rs;
        }
		
        $model = new Model_SplxAppUser();
        $rs = $model->setOnlineFalse($userId);
        return $rs;
    }
	public function setUserNameD($userId,$name) {
        $rs = array();

        $userId = intval($userId);
        if ($userId <= 0) {
            return $rs;
        }
		
        $model = new Model_SplxAppUser();
        $rs = $model->setUserName($userId,$name);
        return $rs;
    }
	public function setUserPassD($userId,$pass) {
        $rs = array();

        $userId = intval($userId);
        if ($userId <= 0) {
            return $rs;
        }
		
        $model = new Model_SplxAppUser();
        $rs = $model->setUserPass($userId,$pass);
        return $rs;
    }
	
	public function setUserEmailD($userId,$pass) {
        $rs = array();

        $userId = intval($userId);
        if ($userId <= 0) {
            return $rs;
        }
		
        $model = new Model_SplxAppUser();
        $rs = $model->setUserEmail($userId,$pass);
        return $rs;
    }
	
	public function setUserMobileD($userId,$pass) {
        $rs = array();

        $userId = intval($userId);
        if ($userId <= 0) {
            return $rs;
        }
		
        $model = new Model_SplxAppUser();
        $rs = $model->setUserMobile($userId,$pass);
        return $rs;
    }
	
	public function newUserNameD($userEmail) {
        $rs = array();

        $model = new Model_SplxAppUser();
        $rs = $model->newUserName($userEmail);

        return $rs;
    }
}
