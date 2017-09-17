<?php

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;
	private $id;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($value){
		$this->idusuario = $value;
	}

	// deslogin
	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($value){
		$this->deslogin = $value;
	}

	// dessenha
	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($value){
		$this->dessenha = $value;
	}

	// dtcadastro
	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	public function loadById($id){

		$sql =  new Sql();

		$results =  $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id
		));


		if (count($results) > 0) {

			$this->setData($results[0]);

		}

	}

	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	public static function busca($login){
		
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :BUSCAR ORDER BY deslogin", array(
							":BUSCAR"=>"%".$login."%"
		));
	}

	public function login($login, $pass){

		$sql =  new Sql();

		$results =  $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASS", array(
			":LOGIN"=>$login,
			":PASS"=>$pass
		));


		if (count($results) > 0) {

			$this->setData($results[0]);

		} else {

			throw new Exception("Login ou Senha inválidos.", 1);
			
		}

	}

	public function setData($data){

		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));

		if (count($results) > 0) {

			$this->setData($results[0]);

		}


	}

	public function insert(){

		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASS)", array(
			":LOGIN"=>$this->getDeslogin(),
			":PASS"=>$this->getDessenha()
			));

		if (count($results) > 0) {
			$this->setData($results[0]);
		}

	}

	public function update($login, $pass){

		// coloca na memoria para pegar no get logo abaixo
		$this->setDeslogin($login);
		$this->setDessenha($pass);


		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASS WHERE idusuario = :ID", array(
			":LOGIN"=>$this->getDeslogin(),
			":PASS"=>$this->getDessenha(),
			":ID"=>$this->getIdusuario()
			));

	}

	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$this->getIdusuario()
			));

		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());


	}




	public function __construct($login = "", $pass = ""){

		$this->setDeslogin($login);
		$this->setDessenha($pass);

	}

	public function __toString(){

		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
// 			"dtcadastro"=>$this->getDtcadastro()
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));

	}

}

?>
