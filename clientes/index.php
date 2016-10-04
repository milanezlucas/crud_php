<?php
	require_once("../includes/classMySQL.php");
	$mySQL = new MySQL;

	if ( isset( $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'excluir' ) {
		$rs_query_cliente = $mySQL->executeQuery("DELETE FROM cliente WHERE id='" . $_GET[ 'id' ] . "'" );
		echo '<meta http-equiv="refresh" content="0;URL=index.php" />';
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Clientes</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>

		<div class="container master-container">

			<?php require_once("../includes/menu.php"); ?>

			<h2 class="sub-header">Clientes</h2>
			<a href="add.php"><button type="button" class="btn btn-info">Adicionar</button></a>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Nome</th>
							<th>E-mail</th>
							<th>Telefone</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$rs_query_cliente = $mySQL->executeQuery( "SELECT * FROM cliente ORDER BY id DESC" );
							while ( $rs_cliente = mysql_fetch_object( $rs_query_cliente ) ) {
						?>
						<tr>
							<td><?php echo $rs_cliente->id; ?></td>
							<td><?php echo $rs_cliente->nome; ?></td>
							<td><?php echo $rs_cliente->email; ?></td>
							<td><?php echo $rs_cliente->telefone; ?></td>
							<td><a href="add.php?metodo=editar&id=<?php echo $rs_cliente->id; ?>"><button type="button" class="btn btn-warning">Alterar</button></a></td>
  							<td><a href="?acao=excluir&id=<?php echo $rs_cliente->id; ?>"><button type="button" class="btn btn-danger">Excluir</button></a></td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>

		</div>
	</body>
</html>
