<?php
		function pr($array){
			echo "<pre>";
			print_r($array);
			echo "</pre>";
		}

		session_start();

		$agregados = array();
		if(isset($_SESSION['TERRESTRE'])){
			$agregados = $_SESSION['TERRESTRE'];
		}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>PHP!</title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<link type='text/css' rel='stylesheet' href='./css/bootstrap.min.css'/>
	<link type='text/css' rel='stylesheet' href='./css/jquery-ui.css'/>
	<link type='text/css' rel='stylesheet' href='./css/jquery-ui.structure.css'/>
	<link type='text/css' rel='stylesheet' href='./css/jquery-ui.theme.css'/>
	<link type='text/css' rel='stylesheet' href='./css/styles.css'/>
	<script type="text/javascript" src="./js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="./js/jquery-ui.js"></script>
	<script type="text/javascript" src="./js/global.js"></script>
	<script type="text/javascript" src="./js/validar.js"></script>
  </head>
  <body>
  	<div class="black-layer" style="display:none;"></div>
  	<header class="col-md-12 text-center mbot">
  		<h1>Sistema Terrestre</h1>
  	</header>
  	<div class="container-fluid">
  		<form action="./guardar.php" method="post" class="formulario">
		<div class="col-md-6 text-center">
				<div class="col-md-12 mbot row">
					<label for="codigo" class="col-md-4">Código</label>
					<div class="col-md-4">
						<input id="codigo" type="text" name="codigo" class="form-control">
					</div>
					<div class="col-md-4 error-container"></div>
				</div>
				
				<div class="col-md-12 mbot row">
					<label for="Monto" class="col-md-4">Monto</label>
					<div class="col-md-4">
						<input id="monto" type="text" name="monto" class="form-control">
					</div>
					<div class="col-md-4 error-container"></div>
				</div>
				
				<div class="col-md-12 mbot row">
					<label for="Fecha" class="col-md-4">Fecha</label>
					<div class="col-md-4">
						<input id="calendario" type="text" name="fecha" class="form-control" readonly>
						<span class="icono-calendario"></span>
					</div>
					<div class="col-md-4 error-container"></div>
				</div>
				
				<div class="col-md-12 mbot row">
					<label for="rut" class="col-md-4">Rut</label>
					<div class="col-md-4">
						<input id="rut" type="text" name="rut" class="form-control">
					</div>
					<div class="col-md-4 error-container"></div>
				</div>
				
				<div class="col-md-12 mbot row">
					<label for="Cantidad" class="col-md-4">Cantidad</label>
					<div class="col-md-4">
						<input id="cantidad" type="text" name="cantidad" class="form-control">
					</div>
					<div class="col-md-4 error-container"></div>
				</div>
				
				<div class="col-md-12 mbot row">
				<label for="pais_origen" class="col-md-4">Pais Origen</label>
					<div class="col-md-4">
						<input id="paisOrigen" type="text" name="pais_origen" class="form-control">
					</div>
					<div class="col-md-4 error-container"></div>
				</div>
				
				<div class="col-md-12 text-center">
					<div class="col-md-8">
						<input type="submit" value="Agregar" name="agregar" class="btn btn-success btn-default">
					</div>
				</div>
		</div>
		<div class="col-md-6">
			<?php
					if(!empty($agregados)){
						?>
  						<p>Últimos agregados:</p>
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Código</th>
									<th>Monto</th>
									<th>Fecha</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($agregados as $k => $terrestre){
										?>
										<tr>
											<td><?=$terrestre['codigo'];?></td>
											<td><?=$terrestre['monto'];?></td>
											<td><?=$terrestre['fecha'];?></td>
											<td>
												<span class="codigo hide"><?=$terrestre['codigo'];?></span>
												<span class="fecha hide"><?=$terrestre['fecha'];?></span>
												<span class="monto hide"><?=$terrestre['monto'];?></span>
												<span class="rut hide"><?=$terrestre['rut'];?></span>
												<span class="cantidad hide"><?=$terrestre['cantidad'];?></span>
												<span class="pais_origen hide"><?=$terrestre['pais_origen'];?></span>
												<a class="ver-detalles" href="#"></a>
											</td>
										</tr>
										<?php
									}
								?>
								<tr>
									<td colspan="4" class="text-center">
										<a class="btn btn-default btn-primary enviar">Enviar</a>
									</td>
								</tr>
							</tbody>
						</table>
						<?php
					}else{
						?>
						<p>--- No hay registros ---</p>
						<?php
					}
			?>
		</div>
		</form>
	</div>
	<footer class="text-center">
		Desarrollado por Lucero Quijano - Duoc UC 2015
	</footer>
	<?php
	require_once "detalles.php";
	?>
  </body>
</html>