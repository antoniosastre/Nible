<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Notas</title>
<?php
if (isset($_COOKIE["usuario-notas"]))
echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"1; url=programa.php\">";
?>
</head>

<body>
<?php
if (isset($_COOKIE["usuario-notas"])){
echo "Usuario reconocido. Redirigiendo...";
}else{
	
echo "<form action=\"tunel.php\" method=\"post\">
Nombre: <input type=\"text\" name=\"nombre\" />
Contraseña: <input type=\"password\" name=\"contrasena\" />
<input type=\"submit\" name=\"mandar\" value=\"Mandar\" />

</form>";
	
}

?>
</body>
</html>