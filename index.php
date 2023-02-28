<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ordenar Resultado</title>

	<link rel="stylesheet" href="assets\bootstrap\css\bootstrap.min">

	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/navbar-animation-fix.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

</body>

</html>

<?php

try {
	$pdo = new PDO("mysql:dbname=controledeusuarios;host=localhost", "root", "");
} catch (PDOException $e) {
	echo "ERRO " . $e->getMessage();
	exit;
}

if (isset($_GET['ordem']) && empty($_GET['ordem']) == false) {
	$ordem = addslashes($_GET['ordem']);
	$sql = "SELECT * FROM usuarios ORDER BY " . $ordem;
} else {
	$ordem = '';
	$sql = "SELECT * FROM usuarios";
}

//<?php echo ($ordem=="nome")?'selected="selected"':''; 
?>

<div class="container">
</br>
	<form method="GET">
		<div class="form-group col-md-2">
		<select class="form-control" name="ordem" onchange="this.form.submit()">
			<option></option>
			<option value="nome" <?php echo ($ordem == "nome") ? 'selected="selected"' : ''; ?>>Pelo Nome</option>
			<option value="idade" <?php echo ($ordem == "idade") ? 'selected="selected"' : ''; ?>>Pela Idade</option>
			<option value="email" <?php echo ($ordem == "email") ? 'selected="selected"' : ''; ?>>Pela E-mail</option>
		</select>
		</div>
	</form>
	</br>
	<table class="table" border="1" width="400">
		<tr>
			<th>Nome</th>
			<th>Idade</th>
			<th>E-mail</th>
		</tr>
		<?php
		$sql = $pdo->query($sql);
		if ($sql->rowCount() > 0) {
			foreach ($sql->fetchAll() as $usuario) :
		?>

				<tr>
					<td><?php echo $usuario['nome']; ?></td>
					<td><?php echo $usuario['idade']; ?></td>
					<td><?php echo $usuario['email']; ?></td>
				</tr>

		<?php
			endforeach;
		}
		?>


	</table>
</div>