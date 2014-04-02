<?php 
  if ($result = querynotas($_GET['a'], $_GET['e'], $_GET['c'])) {
	 echo "<table>";
	 $cont = 0;
	 while($nota = mysqli_fetch_array($result))
  {
	  if($cont % 3 == 0) echo "<tr>";
	  echo "<td>";
  include 'nota.php';
  		echo "</td>";
  	 if($cont % 3 == 2) echo "</tr>";
	 $cont++;
  }
  echo "</table>";

  }
?>