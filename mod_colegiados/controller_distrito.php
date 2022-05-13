<?php 

	include_once "../conf/conf.php";

	$sql = "SELECT iddistrito, distritos, idprovincia FROM distritos WHERE idprovincia = " . $_POST["provincia"];
	$db = $dbh->prepare($sql);
	$db->execute();

	$fila = "";

	while($data = $db->fetch(PDO::FETCH_OBJ)):

		$fila .= "<option value='".$data->iddistrito."'>". $data->distritos ."</option>";
  endwhile;


	echo $fila;


?>