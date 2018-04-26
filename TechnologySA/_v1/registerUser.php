<?php

	require_once '../_includes/DbOperations.php';

	$response = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['nome']) and isset($_POST['email']) and isset($_POST['senha'])) {
			
			$db = new DbOperations();

			$result = $db->createUser($_POST['nome'], $_POST['email'], $_POST['senha']);

			if ($result == 1) {
				$response['error'] = false;
				$response['message'] = "Usuario registrado com sucesso";
			} else if ($result == 2){
				$response['error'] = true;
				$response['message'] = "Ocorreu algum erro, tente novamente";
			} elseif ($result == 0) {
				$response['error'] = true;
				$response['message'] = "Parece que você esta registrado, escolha um e-mail diferente e um nome de usuario";
			}
			
		} else {
			$response['error'] = true;
			$response['message'] = "Os campos obrigatorios estao em branco";
		}
	} else {
		$response['error'] = true;
		$response['message'] = "Pedido invalido";
	}

	echo json_encode($response, JSON_PRETTY_PRINT);
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
