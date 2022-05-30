<?php 

	if (strlen(session_id()) < 1) {
		session_start();
	}

	include_once "../conf/conf.php";

	$sql = "SELECT idColegiado, email, password, estado
					FROM colegiados 
					WHERE estado = 1 AND idColegiado = " . $_POST["idcolegiado"];
	$db = $dbh->prepare($sql);
	$db->execute();
	$data = $db->fetch(PDO::FETCH_OBJ);

	echo $filas = $db->rowCount();

	if ( $filas > 0){
		if( $data->password != md5($_POST["llaveuno"]) ){
				$sql = "UPDATE `colegiados` SET `password`='" . md5($_POST["llaveuno"]) . "' WHERE idColegiado=" . $_POST["idcolegiado"];
		    $db = $dbh->prepare($sql);
		    $db->execute();
		}
	}

	// echo "<pre>";
	// print_r($data);
	// echo "</pre>";
	// exit();
	

?>