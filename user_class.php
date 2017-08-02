<?php

class user
{
//comentario teste;
	private $name;
	private $registration;
	private $password;
	private $birth;
	private $complains;
	private $email;

	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getName()
	{
			return $this->name;
	}
	
	public function setRegistration($registration);
	{
			$this->registration = $registration;
	}
	
	public function getRegistration();
	{
		return $this->registration;
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setBirth($birth)
	{
		$this->birth = $birth;
	}

	public function getBirth()
	{
		return $this->birth;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}
	public function getEmail()
	{
		return $this->email;
	}
?>
