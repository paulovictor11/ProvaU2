<?php

	require_once '../_includes/DbOperations.php';

	$response = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['email']) and isset($_POST['senha'])) {
			$db = new DbOperations();
		 	
		 	if ($db->userLogin($_POST['email'], $_POST['senha'])) {
		 		$email = $db->getUserByEmail($_POST['email']);

		 		$response['error'] = false;
		 		$response['nome'] = $email['nome'];
                $response['email'] = $email['email'];
		 	} else {
		 		$response['error'] = true;
				$response['message'] = "Email ou Senha inválidos";
		 	}
		} else {
			$response['error'] = true;
			$response['message'] = "Os campos obrigatórios estão em branco";
		}
		
	}

	function utf8ize($d){
		if (is_array($d)) {
			foreach ($d as $key => $value) {
				$d[$key] = utf8ize($value);
			}
		} elseif (is_string($d)) {
			return utf8_encode($d);
		}

		return $d;
	}

	echo json_encode(utf8ize($response), JSON_PRETTY_PRINT);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Technology S/A</title>
    <link rel="icon" href="_images/favicon.ico">
</head>
<body>

</body>
</html>
