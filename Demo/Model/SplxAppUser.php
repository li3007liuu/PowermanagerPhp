<?php

class Model_SplxAppUser extends PhalApi_Model_NotORM {

    public function getByUserEmail($email) {
        return $this->getORM()
            ->select('id','name','tel','email')
            ->where('email', $email)
            ->fetch();
    }
	
    public function getByUserMobile($email) {
        return $this->getORM()
            ->select('id','name','tel','email')
            ->where('tel', $email)
            ->fetch();
    }
	
	public function getByUserName($name)
	{
		return $this->getORM()
            ->select('id','name','tel','email')
            ->where('name', $name)
            ->fetch();
	}
	
	public function getByUserId($userId) {
        return $this->getORM()
            ->select('*')
            ->where('id = ?', $userId)
            ->fetch();
    }
	
	public function setOnlineTrue($userId)
	{
		$data = array('online'=>true);
		return $this->getORM()
			->where('id',$userId)
			->update($data);
	}
	
	public function setOnlineFalse($userId)
	{
		$data = array('online'=>false);
		return $this->getORM()
			->where('id',$userId)
			->update($data);
	}
	
	public function setUserName($userId,$name)
	{
		$data = array('name'=>$name);
		return $this->getORM()
			->where('id',$userId)
			->update($data);
	}
	
	public function setUserEmail($userId,$name)
	{
		$data = array('email'=>$name);
		return $this->getORM()
			->where('id',$userId)
			->update($data);
	}
		
	public function setUserMobile($userId,$name)
	{
		$data = array('tel'=>$name);
		return $this->getORM()
			->where('id',$userId)
			->update($data);
	}
	
	public function setUserPass($userId,$pass)
	{
		$data = array('pass'=>$pass);
		return $this->getORM()
			->where('id',$userId)
			->update($data);
	}
	
	public function newUserName($userEmail)
	{
		$data = array('name'=>$userEmail);
		$this->getORM()
			->insert($data);
		return $this->getORM()
			->insert_id();
	}
		
    protected function getTableName($id) {
        return 'p_user';
    }
}