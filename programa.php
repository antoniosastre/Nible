<?php require 'db.php';

function compurle($num){
	if($num == -1){
		return "?p=vistanotas&a=t&e=t";
	}	
		return "?p=vistanotas&a=".$num."&e=t";
}

function compurla($num){
	if($num == -1){
			if($_GET['a']){
		return "?p=vistanotas&a=".$_GET['a']."&e=t";
	}
		return "?p=vistanotas&e=t";
	}
	if($_GET['a']){
		return "?p=vistanotas&a=".$_GET['a']."&e=".$num;
	}
		return "?p=vistanotas&e=".$num;
}

function compurlc($num){
	
		return "?p=vistanotas&a=".$_GET['a']."&e=".$_GET['e']."&c=".$num;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Notas - Papel de Aguas</title>
<style type="text/css">
.principal {
	border: 1px solid #000;
}

.bototitu {
	-moz-box-shadow:inset 0px 1px 0px 0px #d197fe;
	-webkit-box-shadow:inset 0px 1px 0px 0px #d197fe;
	box-shadow:inset 0px 1px 0px 0px #d197fe;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #a53df6), color-stop(1, #7c16cb) );
	background:-moz-linear-gradient( center top, #a53df6 5%, #7c16cb 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#a53df6', endColorstr='#7c16cb');
	background-color:#a53df6;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #9c33ed;
	display:inline-block;
	color:#ffffff;
	font-family:Arial;
	font-size:30px;
	font-weight:bold;
	padding:10px 20px;
	text-decoration:none;
	text-shadow:13px 10px 7px #7d15cd;
}.bototitu:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #7c16cb), color-stop(1, #a53df6) );
	background:-moz-linear-gradient( center top, #7c16cb 5%, #a53df6 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#7c16cb', endColorstr='#a53df6');
	background-color:#7c16cb;
}.bototitu:active {
	position:relative;
	top:1px;
}


</style>
</head>

<body>
<?php
if (isset($_COOKIE["usuario-notas"])){
?>

<table width="100%" border="0">
	<tr>
    <td width="200" height="40" align="center" valign="middle" class="principal">
    Notas
    </td>
    <td align="left" valign="middle"  class="principal">
<a href="?p=vistanotas&a=t&e=t"><button>Todas las Notas</button></a>
<a href="?p=crearnota"><button>Crear Nota</button></a>
</td>
<td class="principal" align="center" valign="middle" width="200px">
<a href="?p=perfil"><button><?php echo usuarionombre(usuarioid($_COOKIE["usuario-notas"])); ?></button></a>
</td>
</tr>
<tr>
<td align="left" valign="top"  class="principal">
Notas asignadas a:<br />
	<?php
	echo "<a href=\"".compurle(-1)."\">Todas las notas (".mysqli_num_rows(todasnotasnoarchi()).")</a><br />";
	$todosusuarios = todosidymostrar();
	while($unuser = mysqli_fetch_array($todosusuarios)){
	echo "<a href=\"".compurle($unuser['id'])."\">".utf8_encode($unuser['mostrar'])." (".mysqli_num_rows(notasasiga($unuser['id'])).")</a><br />";
	}
	?>
<br />Estado:<br />
<?php
echo "<a href=\"".compurla(-1)."\">Todas las notas (".mysqli_num_rows(notasasiga($_GET['a'])).")</a><br />";
	for($i=0;$i<9;$i++){
	echo "<a href=\"".compurla($i)."\">".estadotexto($i)." (".mysqli_num_rows(notasasigyestad($_GET['a'],$i)).")</a><br />";	
	}
	
	if($_GET['a']==8){
echo "<br />Clientes:<br />";
echo "<a href=\"".compurla(-1)."\">Todos los clientes (".mysqli_num_rows(notasasiga($_GET['a'])).")</a><br />";
$idsclientesnotasdiego = idsclientesnotasdiego();
	while($unid = mysqli_fetch_array($idsclientesnotasdiego)){
		$cliente = clientebyid($unid['cliente']);
		$selectvalue = "";
			if($cliente['empresa']!=""){
			$selectvalue = utf8_encode($cliente['empresa'])." (".utf8_encode($cliente['nombre'])." ".utf8_encode($cliente['apellidos']).")";
			}else{
			$selectvalue = utf8_encode($cliente['nombre'])." ".utf8_encode($cliente['apellidos']);
			}
		echo "<a href=\"".compurlc($cliente['id'])."\">".$selectvalue." (".mysqli_num_rows(notasdeestecliasignadasdiegoidyestado($cliente['id'],$_GET['e'])).")</a><br />";	
	}
}
	?>
    
    
</td>
<td align="left" valign="top"  class="principal" colspan="2">
<?php if($_GET['p']) include $_GET['p'].'.php'; ?>
</td>
</table>    

<?php
}
?>
</body>
</html>