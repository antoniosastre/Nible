<?php
include 'db.php';

if($_POST['contrasena'] == contrasenade($_POST['nombre'])){
$expire=time()+60*60*12;
setcookie("usuario-notas", $_POST['nombre'], $expire);
	}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Tunel</title>
<?php
if($_POST['contrasena'] != contrasenade($_POST['nombre'])){
	echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"1; url=index.php\">";
}
?>
</head>

<body>
<?php
if($_POST['contrasena'] == contrasenade($_POST['nombre'])){
?>

<br />
<a href="programa.php"><button>Continuar</button></a>

<?php
}else{
	echo "Contraseña incorrecta. Volviendo...";
}
?>
</body>
</html>