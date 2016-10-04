<?php
	require_once("../includes/classMySQL.php");
	$mySQL = new MySQL;

	if ( isset( $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'excluir' ) {
		$rs_query_produto = $mySQL->executeQuery("DELETE FROM produto WHERE id='" . $_GET[ 'id' ] . "'" );
		echo '<meta http-equiv="refresh" content="0;URL=index.php" />';
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Produtos</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>

		<div class="container master-container">

			<?php require_once("../includes/menu.php"); ?>

			<h2 class="sub-header">Produtos</h2>
			<a href="add.php"><button type="button" class="btn btn-info">Adicionar</button></a>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Nome</th>
							<th>Descrição</th>
							<th>Preço</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$rs_query_produto = $mySQL->executeQuery( "SELECT * FROM produto ORDER BY id DESC" );
							while ( $rs_produto = mysql_fetch_object( $rs_query_produto ) ) {
						?>
						<tr>
							<td><?php echo $rs_produto->id; ?></td>
							<td><?php echo $rs_produto->nome; ?></td>
							<td><?php echo $rs_produto->descricao; ?></td>
							<td>R$ <?php echo $rs_produto->preco; ?></td>
							<td><a href="add.php?metodo=editar&id=<?php echo $rs_produto->id; ?>"><button type="button" class="btn btn-warning">Alterar</button></a></td>
  							<td><a href="?acao=excluir&id=<?php echo $rs_produto->id; ?>"><button type="button" class="btn btn-danger">Excluir</button></a></td>
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
