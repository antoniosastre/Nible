<?php
$conexion = mysql_connect("hostingmysql213.nominalia.com", "DSR31_notas", "Sherlock1887-");
mysql_select_db("papeldeaguas_com_notas", $conexion);

$queUsu = "SELECT * FROM usuarios ORDER BY nombre ASC";
$resUsu = mysql_query($queUsu, $conexion) or die(mysql_error());
$totUsu = mysql_num_rows($resUsu);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin título</title>
</head>

<body>

<?php
if ($totUsu> 0) {
   while ($rowUsu = mysql_fetch_assoc($resUsu)) {
      echo "<strong>".$rowUsu['nombre']."</strong><br>";
      echo "Direccion: ".$rowUsu['usuario']."<br>";
      echo "Telefono: ".$rowUsu['email']."<br><br>";
   }
}
?>
</body>
</html>
