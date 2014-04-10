<html>
	<head>
		<meta charset="UTF-8">
		<title>Puntuación Examen XSL</title>
	</head>
	<body>
		<?php	
			$r1 = 0;
			$r2 = 0;
			$r3 = 0;
			
			if ($_SERVER['REQUEST_METHOD']=='POST') {			
				if(isset($_POST['EspacioNombres'])){
					$p1 = $_POST['EspacioNombres'];
					$r1 = $_POST['EspacioNombres'.$p1];
					echo "La respuesta marcada para EspacioNombres es la: $p1 y la puntuación es de: $r1<br/>";
				}else{
					echo "No se ha marcado ningúna respuesta para EspacioNombres.<br/>";
				}if(isset($_POST['preguntaXMLValido'])){
					$p2 = $_POST['preguntaXMLValido'];
					$r2 = $_POST['preguntaXMLValido'.$p2];
					echo "La respuesta marcada para preguntaXMLValido es la: $p2 y la puntuación es de: $r2<br/>";
				}else{
					echo "No se ha marcado ningúna respuesta para preguntaXMLValido.<br/>";
				}if(isset($_POST['PreguntaXPath'])){
					$p3 = $_POST['PreguntaXPath'];
					$r3 = $_POST['PreguntaXPath'.$p3];
					echo "La respuesta marcada para PreguntaXPath es la: $p3 y la puntuación es de: $r3<br/>";
				}else{
					echo "No se ha marcado ningúna respuesta para PreguntaXPath.<br/>";
				}
			}
			$rt = $r1 + $r2 + $r3;			
			echo "La puntuación total ha sido de $rt <br/>";
		?>
	</body>
</html>