<?php 

	if (strlen(session_id()) < 1) {
		session_start();
	}

	include_once "../conf/conf.php";

	switch ($_GET["op"]) {
		case 'obtenerFechaHabilidad':

		  $sql3 = "SELECT `idPagoServ`, `fecha_pago_serv`, `idColegiado`, `monto`, `estado` 
		           FROM `pagos_servicios` 
		           WHERE `idColegiado` = " . $_SESSION['idColegiado'] . " ORDER BY 1 DESC LIMIT 0,1";
		  $db = $dbh->prepare($sql3);
		  $db->execute();
		  $data_servicios = $db->fetch(PDO::FETCH_OBJ);
		  
      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

      $originalDate = $data_servicios->fecha_pago_serv;
      $newDate = date("d" . "DE" . "Y", strtotime($originalDate));  
      $dia = date("d", strtotime($originalDate));
      // $mes = date("M", strtotime($originalDate));
      $mes = $meses[date('n', strtotime($originalDate))-1];
      $anio = date("Y", strtotime($originalDate));
			echo $dia . " DE " . strtoupper($mes) . " DE " . $anio; 


		break;
		

	}





?>