<?php

	class DbOperations{
		private $con;
		
		function __construct(){
			require_once dirname(__FILE__).'/DbConnect.php';

			$db = new DbConnect();

			$this->con = $db->connect();
		}

		public function createUser($nome, $email, $senha){
			if ($this->isUserExist($nome, $email)) {
				return 0;
			} else {
				$stmt = $this->con->prepare("INSERT INTO usuarios ('nome', 'email', 'senha') VALUES (NULL, ?, ?, ?) ");
				$stmt->bind_param("sss", $nome, $email, $senha);

				if ($stmt->execute()) {
					return 1;
				} else {
					return 2;
				}
				
			}
			
		}

		public function userLogin($email, $senha){
			$stmt = $this->con->prepare("SELECT id FROM usuarios WHERE email = ? AND senha = ?");
			$stmt->bind_param("ss", $email, $senha);
			$stmt->execute();
			$stmt->store_result();

			return $stmt->num_rows > 0;
		}
		
		public function getUserByEmail($email){
		 	$stmt = $this->con->prepare("SELECT id FROM usuarios WHERE email = ?");
		 	$stmt->bind_param("s", $email);
		 	$stmt->execute();

		 	return $stmt->get_result()->fetch_assoc();
		}

		private function isUserExist($nome, $email){
			$stmt = $this->con->prepare("SELECT id FROM usuarios WHERE nome = ? AND email = ?");
			$stmt->bind_param("ss", $nome, $email);
			$stmt->execute();
			$stmt->store_result();

			return $stmt->num_rows > 0;
		}
	}

?>