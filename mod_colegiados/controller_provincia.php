<?php 

	include_once "../conf/conf.php";

	
$sql = "SELECT idprovincia, provincias, iddepartamento 
				FROM provincias WHERE iddepartamento = " . $_POST["departamento"];
	$db = $dbh->prepare($sql);
	$db->execute();

	$fila = "";
	$fila = "<option value='0'>Seleccione provincia</option>";
	while($data = $db->fetch(PDO::FETCH_OBJ)):
		$fila .= "<option value='".$data->idprovincia."'>". $data->provincias ."</option>";
  endwhile;


	echo $fila;

	

?>
