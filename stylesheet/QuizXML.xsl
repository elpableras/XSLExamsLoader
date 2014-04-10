<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" omit-xml-declaration="no" indent="yes" />
<xsl:template match="/">
		
<html>
	<head>
		<xsl:for-each select="quiz/question/category">
			<title>
				<xsl:value-of select="text"/>
			</title>
		</xsl:for-each>
	</head>
	<body>
		<form method="POST" action="puntuaXSL.php">
			<h1>QuizXML</h1>
        
			<xsl:for-each select="quiz/question">
		  
				<xsl:variable name="nombreP" select="name/text" />
				<h2><xsl:value-of select="name/text"/></h2>		
				<h3><xsl:value-of select="questiontext" disable-output-escaping="yes"/></h3>
				
				<xsl:for-each select="answer">
					<label>
						<xsl:variable name="i" select="position()" />
	
						<xsl:value-of select="text" disable-output-escaping="yes"/>
						
						<input type="radio">
						<xsl:attribute name="name">
							<xsl:value-of select="$nombreP"/>
						</xsl:attribute>
						<xsl:attribute name="value">
							<xsl:value-of select="$i"/>
						</xsl:attribute>
						</input>
						
						<input type="hidden" value="{@fraction}">
						<xsl:attribute name="name">
							<xsl:value-of select="concat($nombreP,$i)"/>
						</xsl:attribute>
						</input>
						
					</label>	
				</xsl:for-each>
				
			</xsl:for-each>
			<br/><br/>
			<input type="submit" value="Evaluar Examen" />
        </form>
	</body>
</html>

</xsl:template>
</xsl:stylesheet>