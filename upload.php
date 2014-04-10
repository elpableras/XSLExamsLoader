<?php
	function comprobar($nombreNuevo,$nombre_tmp){
		if( file_exists( 'examenes/'.$nombreNuevo) ){
			$nombre = rand(0, 20) . $nombreNuevo;
			comprobar($nombre);
		}else{
			move_uploaded_file($nombre_tmp,
			  "examenes/" . $nombreNuevo);
			//echo "alert('Guardado en: examenes/" . $nombreNuevo ."')";
			echo "<script language='javascript'>window.location='http://156.35.98.12/lew/procesaXSL.php?nombreExamen=examenes/" . $nombreNuevo . "'</script>"; 
			//echo "'http://156.35.98.12/lew/procesaXSL.php?nombreExamen=examenes/" . $nombreNuevo . "'";
		}
	}

	if( !isset($_FILES['archivo']) ){
		echo '<h1 style="position: absolute; 
		left: 50%; top: 50%; margin-left: -320px; margin-top: -225px;">Ha habido un error, tienes que elegir un archivo</h1><br/>';
	  echo '<img src="img/404.jpg" 
	  alt="Error en la página (404)." style="position: absolute; 
	  left: 50%; top: 50%; margin-left: -285px; margin-top: -190px;"><br/>';
	  echo '<h2 style="position: absolute; 
		left: 70%; top: 90%; margin-left: -130px; margin-top: 180px;"><a href="examen.php">Subir de nuevo un archivo</a></h2>';
	}else{

	  $nombre = $_FILES['archivo']['name'];
	  $nombre_tmp = $_FILES['archivo']['tmp_name'];
	  $tipo = $_FILES['archivo']['type'];
	  $tamano = $_FILES['archivo']['size'];

	  // Extensiones admitidas
	  $ext_permitidas = array('xml');
	  // Dividir nombre
	  $partes_nombre = explode('.', $nombre);
	  // Coger la extensión del nombre
	  $extension = end( $partes_nombre );
	  // Ver que la extensión coincide con la permitida
	  $ext_correcta = in_array($extension, $ext_permitidas);

	  // Limite de 500 kb
	  $limite = 500 * 1024;
	  
	  if( $ext_correcta && $tamano <= $limite ){		
		if( $_FILES['archivo']['error'] > 0 ){
			//Error
		  echo '<p style="position: absolute; 
		left: 50%; top: 50%; margin-left: -130px; margin-top: 180px;>Error: ' . $_FILES['archivo']['error'] . '</p><br/>';
		  echo '<img src="img/404.jpg" 
		alt="Error en la página (404)." style="position: absolute; 
		left: 50%; top: 50%; margin-left: -285px; margin-top: -190px;"><br/>';
		}else{
		  //Correcto

		  if( file_exists( 'examenes/'.$nombre) ){
			//print "alert('El archivo " . $nombre ." ya existe, se le añade un digito, para diferenciarlo.')";
			$nombreNuevo = rand(0, 20) . $nombre;
			comprobar($nombreNuevo,$nombre_tmp);
		  }else{
			move_uploaded_file($nombre_tmp,
			  "examenes/" . $nombre);
			//echo "alert('Guardado en: examenes/" . $nombre ."')";
			//include "'http://156.35.98.12/lew/procesaXSL.php?nombreExamen=examenes/" . $nombre . "'";
			echo "<script language='javascript'>window.location='http://156.35.98.12/lew/procesaXSL.php?nombreExamen=examenes/" . $nombre . "'</script>"; 
		  }
		}
	  }else{
		echo '<h1 style="position: absolute; 
		left: 50%; top: 50%; margin-left: -115px; margin-top: -225px;">Archivo incorrecto</h1><br/>';
		echo '<img src="img/404.jpg" 
		alt="Error en la página (404)." style="position: absolute; 
		left: 50%; top: 50%; margin-left: -285px; margin-top: -190px;"><br/>';
		echo '<h2 style="position: absolute; 
		left: 50%; top: 50%; margin-left: -130px; margin-top: 180px;"><a href="examen.php">Subir de nuevo un archivo</a></h2>';
	  }
	}
?>
