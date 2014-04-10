<html>
	<head>
		<meta charset="UTF-8">
		<title>Procesa XML con XSL</title>
	</head>
	<body>
		<?php
			
			function captura_exception_XML(){
				throw new Exception("No se puede cargar el archivo XML");
			}
			
			function captura_exception_validate(){
				throw new Exception("No se puede validar el XML");
			}
			
			function captura_exception_XSL(){
				throw new Exception("No se puede cargar el XSL");
			}
			
			function captura_exception_validate_XSL(){
				throw new Exception("No se puede cargar el XSL");
			}
		
			if ($_SERVER['REQUEST_METHOD']=='POST') {								
				$fileName   = $_POST['nombreExamen'];
			}else{
				$fileName   = $_GET['nombreExamen'];
			}
				$schemaFile = "schemaFile/QuizXML.xsd"; 
				
				$doc = new DomDocument();
				set_error_handler("captura_exception_XML");
				try{
					$doc->load($fileName);
					set_error_handler("captura_exception_XML");
					try{
						$doc->schemaValidate($schemaFile);
						$stylesheet = "stylesheet/QuizXML.xsl"; 
						$doc = new DOMDocument();
						$doc->load($fileName);
																							
						$xsl = new DOMDocument();
						set_error_handler("captura_exception_XSL");
						try{
							$xsl->load($stylesheet);
							$xslProc = new XSLTProcessor();
							$xslProc->importStylesheet($xsl);
							set_error_handler("captura_exception_validate_XSL"); 
							try{
								$newDoc = $xslProc->transformToDoc($doc);
								echo $newDoc->saveHTML();
							}catch(Exception $excp){  
								echo 'Se ha producido un error: ', $excp->getMessage(), "\n";
							}		
						}catch(Exception $exc){  
							echo 'Se ha producido un error: ', $exc->getMessage(), "\n";
						}	
					}catch(Exception $ex){  
						echo 'Se ha producido un error: ', $ex->getMessage(), "\n";
					}
				}catch(Exception $e){
					echo 'Se ha producido un error: ', $e->getMessage(), "\n";
				}
		?>
	</body>
</html>