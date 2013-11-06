<?php

class LoginForm extends CFormModel
{
	
	public $username;
	public $password;
	
	private $_identity;
	
	public function rules()
	{
		return array(
			array('username, password', 'required'),
			array('password', 'authenticate', 'skipOnError'=>true),
		);
	}
	
	public function authenticate($attribute, $params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity = new UserIdentity($this->username, $this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password', "Nom d'utilisateur ou mot de passe invalide");
		}
	}
	
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity = new UserIdentity($this->username, $this->password);
			$this->_identity->authenticate();
		}
		
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity);
			return true;
		}
		else
			return false;
	}
	
	public function attributeLabels()
	{
		return array(
			'username'=>"Nom d'utilisateur",
			'password'=>"Password",
		);
	}
}