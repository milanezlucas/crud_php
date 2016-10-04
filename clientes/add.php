<?php
	require_once("../includes/classMySQL.php");
	$mySQL = new MySQL;

	if ( isset( $_GET[ 'metodo' ] ) && $_GET[ 'metodo' ] == 'editar' ) {
		$rs_query_cliente = $mySQL->executeQuery( "SELECT * FROM cliente WHERE id='" . $_GET[ 'id' ] . "' ORDER BY id DESC LIMIT 1" );
		$rs_cliente = mysql_fetch_object( $rs_query_cliente );

		$texto 	= 'Editar Cliente';
		$acao	= '?metodo=editar&acao=editar&id=' . $_GET[ 'id' ];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo isset( $texto ) ? $texto : 'Adicionar Cliente'; ?></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<div class="container master-container">
			<?php require_once("../includes/menu.php"); ?>
			<div class="panel panel-primary">
				<div class="panel-heading"><?php echo isset( $texto ) ? $texto : 'Adicionar Cliente'; ?></div>
				<div class="panel-body">
						<?php
							if ( isset( $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'add' ) {
								if ( $_POST[ 'nome' ] != '' ) {
									$rs_query_cliente = $mySQL->executeQuery( "INSERT INTO cliente VALUES( NULL, '" . $_POST[ 'nome' ] . "', '" . $_POST[ 'email' ] . "', '"  . $_POST[ 'fone' ] . "' )" );

									if ( $rs_query_cliente ) {
										echo '
											<div class="alert alert-success">
												Cliente cadastrado com sucesso!
											</div>
										';
									} else {
										echo '
											<div class="alert alert-error">
												Não foi possível cadastrar o cliente!
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
									$rs_query_cliente = $mySQL->executeQuery( "UPDATE cliente SET nome='" . $_POST[ 'nome' ] . "', email='" . $_POST[ 'email' ] . "', telefone='" . $_POST[ 'fone' ] . "' WHERE id='" . $_GET[ 'id' ] . "'" );

									if ( $rs_query_cliente ) {
										echo '
											<div class="alert alert-success">
												Cliente editado com sucesso!
											</div>
										';
									} else {
										echo '
											<div class="alert alert-error">
												Não foi possível editar o cliente!
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
							<input class="string required form-control" id="nome" name="nome" placeholder="Nome do Cliente" type="text" value="<?php echo isset( $rs_cliente->nome ) ? $rs_cliente->nome : ''; ?>">
						</div>
						<div class="form-group required">
							<label class="required control-label" for="email">E-mail</label>
							<input class="string required form-control" id="email" name="email" placeholder="E-mail do Cliente" type="email" value="<?php echo isset( $rs_cliente->email ) ? $rs_cliente->email : ''; ?>">
						</div>
						<div class="form-group required">
							<label class="required control-label" for="fone">Telefone</label>
							<input class="string required form-control" id="fone" name="fone" placeholder="Telefone do Cliente" type="text" value="<?php echo isset( $rs_cliente->telefone ) ? $rs_cliente->telefone : ''; ?>">
						</div>
						<input class="btn btn-default" name="commit" value="<?php echo isset( $texto ) ? $texto : 'Adicionar Cliente'; ?>" type="submit">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
