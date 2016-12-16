<?php
class MembreManager
{
	private $_bdd;

	public function __construct(PDO $bdd)
	{
		$this->setBdd($bdd);
	}

	public function setBdd($newBdd)
	{
		$this->_bdd	= $newBdd;
	}

	public function add(Membre $newMembre)
	{
		$req = $this->_bdd->prepare('INSERT INTO membre(pseudo, password, mail, register_date, cle, actif)
									VALUE(:pseudo, :password, :mail, CURDATE(), :cle, :actif)');
		$req->execute(array(
			'pseudo' => $newMembre->pseudo(),
			'password' => $newMembre->password(),
			'mail' => $newMembre->mail(),
			'cle' => $newMembre->cle(),
			'actif' => $newMembre->actif()));
	}

	public function delete(Membre $membre)
	{
		$this->_bdd->exec('DELETE FROM Membre WHERE id=' . $membre->id()); 
	}

	public function get($id)
	{
		$id = (int) $id;

		$req = $thisi->_bdd->prepare('SELECT id, pseudo, password, mail, register_date, cle, actif
						FROM membre
						WHERE id = :id');
		$req->execute(array('id' => $membre->id()));
		$result = $req->fetch(PDO::FETCH_ASSOC);
		return new Membre($result);
	}

	public function getList()
	{
		$list = [];

		$req = $this->_bdd->query('SELECT id, pseudo, password, mail, register_date, cle, actif
								FROM membre
								ORDER BY pseudo');
		while($result = $req->fetch(PDO::FETCH_ASSOC))
		{
			$list[] = new Membre($result);
		}
		return $list;
	}

	public function update(Membre $membre)
	{
		$req = $this->_bdd->prepare('UPDATE membre
			SET pseudo = :pseudo, password = :password, mail = :mail, register_date = :register_date, cle = :cle, actif = :actif
			WHERW id = :id');
		$req->execute(array(
			'pseudo' => $membre->pseudo(),
			'password' => $membre->password(),
			'mail' => $membre->mail(),
			'register_date' => $membre->register_date(),
			'cle' => $membre->cle(),
			'actif' => $membre->actif(),
			'id' => $membre->id()));
	}
}
?>
