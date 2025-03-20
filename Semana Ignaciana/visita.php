<?php
	//Recoge la información del formulario
		
		$nombre=$_GET["nombre"];// Variable para guardar los datos del formulario
		$codigo=$_GET["codigo"];

	//Conecta con la base de datos ($conexión)     //incia sesion en la base de datos con el otro archivo de inicio de sesion
		include 'configdb.php'; //include del archivo con los datos de conexión
		$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
		$conexion->set_charset("utf8"); //Usa juego caracteres UTF8
		//Desactiva errores
		$controlador = new mysqli_driver();
		$controlador->report_mode = MYSQLI_REPORT_OFF;
		
	//Cadena de caracteres de la consulta sql	
		$sql="SELECT *FROM jesuita WHERE nombre='$nombre' AND codigo='$codigo';";  //completa lo que falta
		
	//Ejecuta la consulta
		$jesuita=$conexion->query($sql);
		
		if($conexion->affected_rows>0){
		$fila=$jesuita->fetch_array();
		$id=$fila["idJesuita"];
	?>
<!doctype HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="Author" content="Samuel Sánchez Ponce">
        <link rel="stylesheet" href="caminocss.css">
    </head>
    <body>
		
		<form method="GET" action="guardar_visita.php?id=<?php$id?>"> 
			<h1>Hola, <?php echo$nombre;?></h1>		
			<label for="lugar">Lugar:</label>
			<select name="lugar">
			<?php
				$sqlLugar="SELECT * FROM lugar";
				$resultado=$conexion->query($sqlLugar);
				// Bucle para crear las opciones del 'select'
				while ($fila=$resultado->fetch_array()) {
					echo "<option value=".$fila["ip"].">".$fila["lugar"]."</option>";
				}
				// Cierra la conexión
				$conexion->close();
			?>
			</select>
			<br><br>
			<input type="submit" value="Enviar">
		</form>  		
    </body>
</html>
<?php
	}else{
		echo "<h2>Jesuita o Codigo erroneo</h2>";
		echo '<h3><a href="jesuita.html"> Vuelve a intentarlo</a></h3>';
	}	
	//Cierra la conexión
?>