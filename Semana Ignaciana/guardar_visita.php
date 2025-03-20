<?php
	//Recoge la información del formulario
		
		$ip=$_GET["lugar"];// Variable para guardar los datos del formulario
		$id=$_GET["id"];

	//Conecta con la base de datos ($conexión)     //incia sesion en la base de datos con el otro archivo de inicio de sesion
		include 'configdb.php'; //include del archivo con los datos de conexión
		$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
		$conexion->set_charset("utf8"); //Usa juego caracteres UTF8
		//Desactiva errores
		$controlador = new mysqli_driver();
		$controlador->report_mode = MYSQLI_REPORT_OFF;
		
	//Cadena de caracteres de la consulta sql	
		$sql="INSERT INTO visita (idJesuita,ip) VALUES('".$id."','"$ip");";  //completa lo que falta
		
	//Ejecuta la consulta
		$jesuita=$conexion->query($sql);
		if($conexion->affected_rows>0){	
// Cierra la conexión
				$conexion->close();
?>