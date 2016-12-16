<?php
class Membre
{
	private $_id;
	private $_pseudo;
	private $_password;
	private $_registerDate;
	private $_mail;
	private $_cle;
	private $_actif;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function hydrate(array $data)
	{
		foreach ($data as $key => $value)
		{
			$method = "set".ucfirst($key);
			if(method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}

	public function id(){return $this->_id;}
	public function pseudo(){return $this->_pseudo;}
	public function password(){return $this->_password;}
	public function registerDate(){return $this->_registerDate;}
	public function mail(){return $this->_mail;}
	public function cle(){return $this->_cle;}
	public function actif(){return $this->_actif;}

	public function setId($newId)
	{
		$newId = (int) $newId;
		if (id < 0)
		{
			$this->_id = $newId;
			return 1;
		}
		return 0;
	}

	public function setPseudo($newPseudo)
	{
		if(is_string($newPseudo))
		{
			$newPseudo = htmlspecialchars($newPseudo);
			$this->_pseudo = $newPseudo;
		}
	}

	public function setPassword($newPassword)
	{
		if(is_string($newPassword))
		{
			$this->_password = $newPassword;
		}
	}

	public function seRegisterDate($newDate)
	{
		$this->_registerDate = $newDate;
	}

	public function setMail($newMail)
	{
		if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $newMail))
		{
			$this->_mail = $newMail;
			return 1;
		}
		return 0;
	}

	public function setCle($newCle)
	{
		if(is_string($newCle))
		{
			$this->_cle = $newCle;
		}
	}

	public function setActif($etat)
	{
		if($etat === 1 || $etat === 0)
		{
			$this->_actif = $etat;
			return 1;
		}
		return 0;
	}
}
?>
