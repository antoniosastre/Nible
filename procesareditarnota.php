<?php
  
  $query = "UPDATE notas SET trabajo='".utf8_decode($_POST['trabajo'])."', fecha_in='".$_POST['fecha_in']."', fecha_out='".$_POST['fecha_out']."', precio='".str_replace(",",".",$_POST['precio'])."', notas='".utf8_decode($_POST['notas'])."', descripcion='".utf8_decode($_POST['descripcion'])."', cliente='".$_POST['cliente']."', asignado='".$_POST['asig']."', prioridad='".$_POST['prioridad']."', estado='".$_POST['estado']."' WHERE id='".$_GET['i']."'";

  mysqli_query($conexion,$query);
  
  $idestanota = $_GET['i'];


for ($i=0; $i<count($_POST['eliminar']); $i++){ 
$eliminaritem = $_POST['eliminar'][$i];
	$archivo = nombrearchivobyid($eliminaritem);
	unlink("archivos/".$idestanota."/".$archivo);

 $query = "DELETE FROM archivos WHERE id='".$eliminaritem."'";
	mysqli_query($conexion,$query);
	
	
}
  

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
VALUES ('".utf8_decode($file["name"])."', '".$idestanota."', '".$file["type"]."', '".$file["size"]."')";
  mysqli_query($conexion,$query);
  
  if (!file_exists("archivos/".$idestanota)) {
    mkdir("archivos/".$idestanota);
}
  
  if (file_exists("archivos/".$idestanota."/".$file["name"]))
      {
      echo $file["name"]." ya existe en la carpeta de esta nota. ";
      }
    else
      {
      move_uploaded_file($file["tmp_name"],
      "archivos/".$idestanota."/". $file["name"]);  
        }
		}
	}
  
  echo "Listo!";
  
?>