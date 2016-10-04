<?php
	require_once("../includes/classMySQL.php");
	$mySQL = new MySQL;

	if ( isset( $_GET[ 'metodo' ] ) && $_GET[ 'metodo' ] == 'editar' ) {
		$rs_query_pedido = $mySQL->executeQuery( "SELECT * FROM pedido WHERE id='" . $_GET[ 'id' ] . "' ORDER BY id DESC LIMIT 1" );
		$rs_pedido = mysql_fetch_object( $rs_query_pedido );

		$texto 	= 'Editar Pedido';
		$acao	= '?metodo=editar&acao=editar&id=' . $_GET[ 'id' ];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo isset( $texto ) ? $texto : 'Adicionar Pedido'; ?></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<div class="container master-container">
			<?php require_once("../includes/menu.php"); ?>
			<div class="panel panel-primary">
				<div class="panel-heading"><?php echo isset( $texto ) ? $texto : 'Adicionar Pedido'; ?></div>
				<div class="panel-body">
						<?php
							if ( isset( $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'add' ) {
								if ( $_POST[ 'produto' ] != '' ) {
									$rs_query_pedido = $mySQL->executeQuery( "INSERT INTO pedido VALUES( NULL, '" . $_POST[ 'produto' ] . "', '" . $_POST[ 'cliente' ] . "' )" );

									if ( $rs_query_pedido ) {
										echo '
											<div class="alert alert-success">
												Pedido cadastrado com sucesso!
											</div>
										';
									} else {
										echo '
											<div class="alert alert-error">
												Não foi possível cadastrar o pedido!
											</div>
										';
									}
								} else {
									echo '
										<div class="alert alert-error">
											O campo Produto é obrigatório!
										</div>
									';
								}
							}

							if ( isset( $_GET[ 'acao' ] ) && $_GET[ 'acao' ] == 'editar' ) {
								if ( $_POST[ 'produto' ] != '' ) {
									$rs_query_pedido = $mySQL->executeQuery( "UPDATE pedido SET id_produto='" . $_POST[ 'produto' ] . "', id_cliente='" . $_POST[ 'cliente' ] . "' WHERE id='" . $_GET[ 'id' ] . "'" );

									if ( $rs_query_pedido ) {
										echo '
											<div class="alert alert-success">
												Pedido editado com sucesso!
											</div>
										';
									} else {
										echo '
											<div class="alert alert-error">
												Não foi possível editar o pedido!
											</div>
										';
									}
								} else {
									echo '
										<div class="alert alert-error">
											O campo produto é obrigatório!
										</div>
									';
								}
							}
						?>
						<form action="<?php echo isset( $acao ) ? $acao : '?acao=add'; ?>" class="simple_form" enctype="multipart/form-data" method="post">
						<div class="form-group required">
							<label class="required control-label" for="produto">Produto</label>
							<select name="produto" class="selectpicker required form-control">
								<option>Selecione um Produto</option>
								<?php
									$rs_query_produto = $mySQL->executeQuery( "SELECT id, nome FROM produto ORDER BY id DESC" );
									while ( $rs_produto = mysql_fetch_object( $rs_query_produto ) ) {
										$selected = ( $rs_pedido->id_produto == $rs_produto->id ) ? 'selected="selected"' : '';
										echo '<option value="' . $rs_produto->id . '" ' . $selected . '>' . $rs_produto->nome . '</option>';
									}
								?>
							</select>
						</div>
						<div class="form-group required">
							<label class="required control-label" for="cliente">Cliente</label>
							<select name="cliente" class="selectpicker required form-control">
								<option>Selecione um Cliente</option>
								<?php
									$rs_query_cliente = $mySQL->executeQuery( "SELECT id, nome FROM cliente ORDER BY id DESC" );
									while ( $rs_cliente = mysql_fetch_object( $rs_query_cliente ) ) {
										$selected = ( $rs_pedido->id_cliente == $rs_cliente->id ) ? 'selected="selected"' : '';
										echo '<option value="' . $rs_cliente->id . '" ' . $selected . '>' . $rs_cliente->nome . '</option>';
									}
								?>
							</select>
						</div>
						<input class="btn btn-default" name="commit" value="<?php echo isset( $texto ) ? $texto : 'Adicionar Pedido'; ?>" type="submit">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
