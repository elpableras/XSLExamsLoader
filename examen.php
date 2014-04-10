<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<link href="estilo/estilo.css" rel="stylesheet" type="text/css">
		<title>Examn Quiz</title>		
	</head>
	
	<body>
		<header>
				<h1>Examen</h1>
		</header>
		<section>
			<headers>
				<h2>Seleccionar examen:</h2>
			</headers>
			
			<?php
				if ($dir = @opendir("examenes")){
					while (($file = readdir($dir)) !== false){
						if($file != ".." && $file != "." ){
							$filelist[] = $file;
						}
					}
					closedir($dir);
				}
			?>
			
			<form method="POST" action="procesaXSL.php">
				<select name="nombreExamen">
					<?php
						asort($filelist);
						while (list ($key, $val) = each ($filelist))
						{
							echo "<option value=examenes/$val>$val</option>";
						}
					?>
				</select>				
				<input type="submit" value="realizar examen" name="botonRealiza"/>
			</form>
		</section>
		
		<section>
			<headers>
				<h2>Cargar nuevo examen de fichero local:</h2>
			</headers>
			
			<form enctype="multipart/form-data" action="upload.php" method="POST">
				Fichero: <input name="archivo" type="file" /> 
				<br/>
				<input type="submit" value="Enviar" />                            
			</form>
		</section>
		
	</body>
</html>
