<?php
	require_once("../includes/classMySQL.php");
	$mySQL = new MySQL;

	if ( isset( $_GET[ 'metodo' ] ) && $_GET[ 'metodo' ] == 'editar' ) {
		$rs_query_produto = $mySQL->executeQuery( "SELECT * FROM produto WHERE id='" . $_GET[ 'id' ] . "' ORDER BY id DESC LIMIT 1" );
		$rs_produto = mysql_fetch_object( $rs_query_produto );

		$texto 	= 'Editar Produto';
		$acao	= '?metodo=editar&acao=editar&id=' . $_GET[ 'id' ];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo isset( $texto ) ? $texto : 'Adicionar Produto'; ?></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<div class="container master-container">
			<?php require_once("../includes/menu.php"); ?>
			<div class="panel panel-primary">
				<div class="panel-heading"><?php echo isset( $texto ) ? $texto : 'Adicionar Produto'; ?></div>
				<div class="panel-body">
						<?php
							if ( isset( $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'add' ) {
								if ( $_POST[ 'nome' ] != '' ) {
									$rs_query_produto = $mySQL->executeQuery( "INSERT INTO produto VALUES( NULL, '" . $_POST[ 'nome' ] . "', '" . $_POST[ 'desc' ] . "', '"  . $_POST[ 'preco' ] . "' )" );

									if ( $rs_query_produto ) {
										echo '
											<div class="alert alert-success">
												Produto cadastrado com sucesso!
											</div>
										';
									} else {
										echo '
											<div class="alert alert-error">
												Não foi possível cadastrar o produto!
											</div>
										';
									}
								} else {
									echo '
										<div class="alert alert-error">
											O campo nome é obrigatório!
										</div>
									';
								}
							}

							if ( isset( $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'editar' ) {
								if ( $_POST[ 'nome' ] != '' ) {
									$rs_query_produto = $mySQL->executeQuery( "UPDATE produto SET nome='" . $_POST[ 'nome' ] . "', descricao='" . $_POST[ 'desc' ] . "', preco='" . $_POST[ 'preco' ] . "' WHERE id='" . $_GET[ 'id' ] . "'" );

									if ( $rs_query_produto ) {
										echo '
											<div class="alert alert-success">
												Produto editado com sucesso!
											</div>
										';
									} else {
										echo '
											<div class="alert alert-error">
												Não foi possível editar o produto!
											</div>
										';
									}
								} else {
									echo '
										<div class="alert alert-error">
											O campo nome é obrigatório!
										</div>
									';
								}
							}
						?>
						<form action="<?php echo isset( $acao ) ? $acao : '?acao=add'; ?>" class="simple_form" enctype="multipart/form-data" method="post">
						<div class="form-group required">
							<label class="required control-label" for="nome">Nome</label>
							<input class="string required form-control" id="nome" name="nome" placeholder="Nome do Produto" type="text" value="<?php echo isset( $rs_produto->nome ) ? $rs_produto->nome : ''; ?>">
						</div>
						<div class="form-group required">
							<label class="required control-label" for="desc">Descrição</label>
							<textarea class="string required form-control" id="desc" name="desc" placeholder="Descrição do Produto"><?php echo isset( $rs_produto->descricao ) ? $rs_produto->descricao : ''; ?></textarea>
						</div>
						<div class="form-group required">
							<label class="required control-label" for="preco">Preço</label>
							<input class="string required form-control" id="preco" name="preco" placeholder="R$" type="text" value="<?php echo isset( $rs_produto->preco ) ? $rs_produto->preco : ''; ?>">
						</div>
						<input class="btn btn-default" name="commit" value="<?php echo isset( $texto ) ? $texto : 'Adicionar Produto'; ?>" type="submit">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
