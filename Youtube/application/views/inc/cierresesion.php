<!--Mensaje cierre de sesión -->
<div id="divmensajelogout"
		 style="position:fixed; text-align:center; width:400px; margin-left: 35%; margin-top: 15px; z-index:1;" class="mensajeoculto">
	<div class="alert alert-success" id="mensajelogout"></div>
</div>

<script type="text/javascript">
	var showMessage = function(msg) {
		var mensaje = document.getElementById("mensajelogout");
		var divmensaje = document.getElementById("divmensajelogout");
		mensaje.className = "alert alert-success";
		mensaje.innerHTML = msg;
		divmensaje.className = "mensajevisible";


		//Vamos a logout para cerrar la sesión
		setTimeout(function(){
			divmensaje.className = "mensajeoculto";
		}, 2000);
	}

	<?php
		if(isset($msg)){
			echo 'var msg = "' . $msg . '";';
		}
	?>
	if(msg !== ''){
		showMessage(msg);
	}
</script>
