<?php

class WebUser extends CWebUser
{
	
	public function getIsAdmin()
	{
		return true === $this->getState('_is_admin', false);
	}
	
	public function getPresence()
	{
		return $this->getState('_presence', null);
	}
	
	public function setPresence($presence)
	{
		return $this->setState('_presence', $presence, null);
	}
}
