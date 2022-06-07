<?php 

	include_once "../conf/conf.php";

			$sql = "SELECT iddepartamento, departamento FROM departamentos";

	    $db = $dbh->prepare($sql);
	    $db->execute();

	$fila = "";
	$fila = "<option value='0'>Seleccione departamento</option>";

	while($data = $db->fetch(PDO::FETCH_OBJ)):
		$fila .= "<option value='".$data->iddepartamento."'>". $data->departamento ."</option>";
  endwhile;


	echo $fila;


?>
