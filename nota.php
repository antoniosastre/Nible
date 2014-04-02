
<table border="1" bgcolor="<? 

switch ($nota['prioridad']){
	case 0:
		echo "#ffffff";
		break;
		
	case 1:
		echo "#ccffcc";
		break;
		
	case 2:
		echo "#aaccff";
		break;
		
	case 3:
		echo "#ffff66";
		break;
		
	case 4:
		echo "#ff9933";
		break;
	
	case 5:
		echo "#ff2222";
		break;	
	
}

?>" width="400" height="600">
<tr>
<?php
echo "<td colspan=\"6\" align=\"center\" valign=\"middle\">";
echo "<h1><a href=\"programa.php?p=editarnota&i=".$nota['id']."\"><button class=\"bototitu\">".utf8_encode($nota['trabajo'])."</button></a></h1>";
?>
</td>
</tr>
<tr>
<td colspan="6"><table width="100%"><tr><td colspan="2">Cliente:</td><td>Empresa:</td><td align="right">
<?php
echo "ID: ".$nota['cliente']."</td></tr>";
if ($nota['cliente']!=0){
	$cliente = clientebyid($nota['cliente']);
	echo "<tr><td colspan=\"2\">".utf8_encode($cliente['nombre'])." ".utf8_encode($cliente['apellidos'])."</td><td>".utf8_encode($cliente['empresa'])."</td></tr>";
	echo "<tr><td>Telf:<br />".$cliente['telefono']."</td>";
	echo "<td>Email:<br />".utf8_encode($cliente['email'])."</td>";
	echo "<td>DNI/NIF:<br />".utf8_encode($cliente['nif'])."</td></tr>";
}

?></table>
</td>
</tr>
<tr>
<td colspan="3">Fecha In:<br />
<?php
echo fechanormal($nota['fecha_in']);
?>
</td>
<td colspan="3">Fecha Out:<br />
<?php
echo fechanormal($nota['fecha_out']);
?>
</td>
</tr>
<tr>
<td colspan="6">Descripción:<br />
<?php
echo utf8_encode($nota['descripcion']);
?>
</td>
</tr>
<tr>
<td colspan="6">Notas:<br />
<?php
echo utf8_encode($nota['notas']);
?>
</td>
</tr>
<tr>
<td colspan="6">
<?php
if ($archivos = archivosde($nota['id'])) {
	echo "<table border=\"0\" width=\"100%\" align=\"center\" valign=\"middle\">";
	echo "<tr><td>Archivos (".mysqli_num_rows($archivos).")</td><td>Tipo</td><td>Peso (MB)</td></tr>";
	 while($archivo = mysqli_fetch_array($archivos)){
		 echo "<tr>";
	echo "<td><a href=\"archivos/".$nota['id']."/".$archivo['nombre']."\" target=\"new\" download=\"".$archivo['nombre']."\">".$archivo['nombre']."</a></td>";
	echo "<td>".$archivo['tipo']."</td>";
	echo "<td>".round(($archivo['peso'] / (1024*1024)),2)."</td>";
		echo "</tr>";
	 }
	 echo "</table>";
  }
?>
</td>
</tr>
<tr>
<td>ID:<br /><?php echo $nota['id']; ?></td>
<td>Prioridad:<br /><?php echo $nota['prioridad']; ?></td>
<td>Estado:<br /><?php echo estadotexto($nota['estado']); ?></td>
<td>Creador:<br /><?php echo usuariomostrar($nota['creador']); ?></td>
<td>Asignado:<br /><?php echo usuariomostrar($nota['asignado']); ?></td>
<td>Precio:<br /><?php echo str_replace(".",",",$nota['precio'])." €"; ?></td>
</tr>
</table>

<?php
/*echo $nota['id'];
echo $nota['trabajo'];
echo $nota['fecha_in'];
echo $nota['fecha_out'];
echo $nota['isediting'];
echo $nota['precio'];
echo $nota['notas'];
echo $nota['descripcion'];
echo $nota['cliente'];
echo $nota['asignado'];
echo $nota['creador'];
echo $nota['archivo'];
echo $nota['prioridad'];
echo $nota['estado'];*/
?>