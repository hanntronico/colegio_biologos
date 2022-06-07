<?php 

	include_once "../conf/conf.php";

	$sql = "SELECT iddistrito, distritos, idprovincia FROM distritos WHERE idprovincia = " . $_POST["provincia"];
	$db = $dbh->prepare($sql);
	$db->execute();

	$fila = "";
	$fila = "<option value='0'>Seleccione distrito</option>";

	while($data = $db->fetch(PDO::FETCH_OBJ)):
		$fila .= "<option value='".$data->iddistrito."'>". $data->distritos ."</option>";
  endwhile;


	echo $fila;


?>
