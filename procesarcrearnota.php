<?php
  if($_POST['cliente']==-1){
	  
	  if(utf8_decode($_POST['nifcli'])==""){
		   $nif = "null";
	  }else{
		   $nif = "'".$_POST['nifcli']."'";
	  }
	  
	   $query = "INSERT INTO clientes (nombre, apellidos, empresa, nif, telefono, email, notas)
VALUES ('".utf8_decode($_POST['nomcli'])."', '".utf8_decode($_POST['apecli'])."', '".utf8_decode($_POST['empcli'])."', ".$nif.", '".$_POST['telcli']."', '".utf8_decode($_POST['emacli'])."', '".utf8_decode($_POST['notcli'])."')";
	  
	  mysqli_query($conexion,$query);
	  
	  $ultimocli = idultimocliente();
  
   $query = "INSERT INTO notas (trabajo, fecha_in, fecha_out, precio, notas, descripcion, cliente, asignado, creador, prioridad, estado)
VALUES ('".utf8_decode($_POST['trabajo'])."', '".$_POST['fecha_in']."', '".$_POST['fecha_out']."', '".str_replace(",",".",$_POST['precio'])."', '".utf8_decode($_POST['notas'])."', '".utf8_decode($_POST['descripcion'])."', '".$ultimocli."', '".$_POST['asig']."', '".usuarioid($_COOKIE["usuario-notas"])."', '".$_POST['prioridad']."', '".$_POST['estado']."')";

  mysqli_query($conexion,$query);
  
  }else{
  
  $query = "INSERT INTO notas (trabajo, fecha_in, fecha_out, precio, notas, descripcion, cliente, asignado, creador, prioridad, estado)
VALUES ('".utf8_decode($_POST['trabajo'])."', '".$_POST['fecha_in']."', '".$_POST['fecha_out']."', '".str_replace(",",".",$_POST['precio'])."', '".utf8_decode($_POST['notas'])."', '".utf8_decode($_POST['descripcion'])."', '".$_POST['cliente']."', '".$_POST['asig']."', '".usuarioid($_COOKIE["usuario-notas"])."', '".$_POST['prioridad']."', '".$_POST['estado']."')";


  mysqli_query($conexion,$query);
  
  }
  
  $ultima = idultimanota();

 $files = array();
        $fdata = $_FILES["file"];
        if (is_array($fdata["name"])) {//This is the problem
                for ($i = 0; $i < count($fdata['name']); ++$i) {
                        $files[] = array(
                            'name' => $fdata['name'][$i],
                            'tmp_name' => $fdata['tmp_name'][$i],
							'type' => $fdata['type'][$i],
							'size' => $fdata['size'][$i],
                        );
                }
        } else {
                $files[] = $fdata;
        }

        foreach ($files as $file) {
			if($file["name"]!="" && $file["size"]!=0){
               $query = "INSERT INTO archivos (nombre, nota, tipo, peso)
VALUES ('".utf8_decode($file["name"])."', '".$ultima."', '".$file["type"]."', '".$file["size"]."')";
  mysqli_query($conexion,$query);
  
  if (!file_exists("archivos/".$ultima)) {
    mkdir("archivos/".$ultima);
}
  
  if (file_exists("archivos/".$ultima."/".$file["name"]))
      {
      echo $file["name"]." ya existe en la carpeta de esta nota. ";
      }
    else
      {
      move_uploaded_file($file["tmp_name"],
      "archivos/".$ultima."/". $file["name"]);  
        }
			}
	}
  
  echo "Listo!";
  
?>