<?php
	$this->load->view('inc/cabecera');
?>

<main class="container">
	<h2><?php echo $titulo; ?></h2>

	<form name="formulario" action="" method="POST" class="divcamposlogin">
		<label>Email:</label>
		<input type="text" name="email" id="email" class="form-control"> </input>
		<label>Password:</label>
		<input type="password" name="password" id="password" class="form-control"> </input>
	 	<input class="btn btn-primary botonlogin" value="Iniciar sesión" type="submit" name="submit"/>
	</form>
	<div class=" divcamposlogin center">O regístrate <a href="<?=site_url('registro')?>">aquí</a></div>
	<div id="mensajeerror"></div>

	<?php
	if(isset($_POST["submit"])){
		$existeusuario=false;
		$camposvacios=false;
		$uid = "";
		$response = "";
		$uemail = $_POST['email'];
		$upass = $_POST['password'];

		/* Comprobamos si el usuario existe en la BD o si los campos están en vacio */
		foreach ($usuarios as $usuario) {
			if($usuario->email==$uemail && $usuario->password==$upass) {
				$existeusuario=true;
				$uid = $usuario->id;
				$uadmin = $usuario->admin;
			}
			if($uemail=="" || $upass=="")
				$camposvacios=true;
		}

		/* Mostramos el error específico */
		if($camposvacios==true)
			$response = "Debes completar todos los campos";
		else if($existeusuario==false && $camposvacios==false)
			$response = "El usuario introducido no existe";
		/* Mostramos mensajes informando y si es correcto redireccionamos y guardamos sesión */
		if($response=="" || $response==null) {
			if (session_status() == PHP_SESSION_NONE)
				session_start([
						'cookie_lifetime' => 86400,
				]);
			$_SESSION["email"] = $uemail;
			$_SESSION["password"] = $upass;
			$_SESSION["id"] = $uid;
			$_SESSION["admin"] = $uadmin;

			//Mostramos el mensaje de correcto inicio de sesión
			echo '<div id="divmensajelogin" style="width:500px; margin-left: 250px; margin-top: 15px;" class="mensajeoculto">'.
				'<div class="alert alert-success" id="mensajelogin">Inicio de sesión correcto</div></div>';
			//Le asignamos una transición CSS
			echo '<script>'.
						'setTimeout(function(){'.
							'var mensajeLogin = document.getElementById("mensajelogin");'.
							'var divmensajeLogin = document.getElementById("divmensajelogin");'.
							'mensajeLogin.className = "alert alert-success";'.
							'divmensajeLogin.className = "mensajevisible";'.
						'}, 1);'.
						'</script>';
			$urlredireccion='inicio';
			//Redireccionamos
			if(isset($_GET['redirect']))
					$urlredireccion=$_GET['redirect'];

			echo '<script>setTimeout(function(){window.location="'.$urlredireccion.'"}, 2000);</script>';
		} else {
			echo '<div class="alert alert-danger errorlogin">Error: '.$response.'</div>';
		}
	}
	?>
</main>

<?php
	$this->load->view('inc/pie.php');
?>
