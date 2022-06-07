<?php 

	if (strlen(session_id()) < 1){
		session_start();
	}

	include_once "../conf/conf.php";

	switch ($_GET["op"]){

		case 'listar_certificados':
						if (!isset($_SESSION["nombre"]))
						{
						  header("Location: ".ENLACE_WEB);
						}
						else
						{

// SELECT * 
// FROM certificados CE 
// LEFT JOIN colegiados CO
// ON CE.idColegiado = CO.idColegiado
// LEFT JOIN pagos_servicios PS
// ON CE.idPagoServ = PS.idPagoServ

// idCertificado, idColegiado, idPagoServ, fechaEmision, estadoCertificado

// idColegiado, codigo_col, nom_colegiado, ape_paterno, ape_materno, dni, fec_nac, foto, telefono, email, password, direccion, lug_nacim, lug_labores, info_contacto,estado_exonerado, estado

// idPagoServ, fecha_pago_serv, idColegiado, descripcion, monto, estado


							$sql = "SELECT CE.idCertificado, CO.codigo_col, CO.nom_colegiado, CO.ape_paterno, CO.ape_materno, CE.fechaEmision, CE.estadoCertificado 
											FROM certificados CE 
											LEFT JOIN colegiados CO
											ON CE.idColegiado = CO.idColegiado
											LEFT JOIN pagos_servicios PS
											ON CE.idPagoServ = PS.idPagoServ";
							$db = $dbh->prepare($sql);
							$db->execute();
							$fila = "";

							$data= Array();

								while($data_cert = $db->fetch(PDO::FETCH_OBJ)){

									// $fechaVence = date("d/m/Y", strtotime($data_pago->fecha_vence));
									// $fechaEmision = date("d/m/Y", strtotime($data_cert->fechaEmision));
									$fechaEmision = (!empty($data_cert->fechaEmision)) ? date("d/m/Y", strtotime($data_cert->fechaEmision)) : "---" ;

									$data[]=array(
							       "0"=>$data_cert->idCertificado,
							       "1"=>$data_cert->codigo_col,
							       "2"=>$data_cert->nom_colegiado . " " . $data_cert->ape_paterno . " " . $data_cert->ape_materno,
							       "3"=>$fechaEmision
									);
								}

								$results = array(
								 		"sEcho"=>1, 
								 		"iTotalRecords"=>count($data), 
								 		"iTotalDisplayRecords"=>count($data), 
								 		"aaData"=>$data);			

								echo json_encode($results);				

					}

		break;


		case 'registrar_certificado':

			if (!isset($_SESSION["nombre"]))
			{
			  header("Location: ".ENLACE_WEB);
			}
			else
			{
				$idcolegiado 	= isset($_POST["idcolegiado"])? $_POST["idcolegiado"] : "";
				$fechaEmision = date("Y-m-d");
				$idPagoServ 	= isset($_POST["idPagoServ"])? $_POST["idPagoServ"] : "";

				$sqlInsCert = "INSERT INTO `certificados`(`idColegiado`, 
																					 `idPagoServ`, 
																					 `fechaEmision`, 
																					 `estadoCertificado`) 
								VALUES (:idcolegiado, :idpagoserv, :fechaEmision, :estadoCerti)";

				$db = $dbh->prepare($sqlInsCert);
				$db->bindValue(':idcolegiado'		, $idcolegiado,  PDO::PARAM_INT);
				$db->bindValue(':idpagoserv'		, $idPagoServ, 	 PDO::PARAM_INT);
				$db->bindValue(':fechaEmision'	, $fechaEmision, PDO::PARAM_STR);
				$db->bindValue(':estadoCerti'		, 1, 						 PDO::PARAM_INT);
				$result = $db->execute();

				if ($result) {
					$sqlUpdPago = "UPDATE `pagos_servicios` SET `estado`=3 WHERE `idPagoServ`=" . $idPagoServ;
					$db = $dbh->prepare($sqlUpdPago);
					$db->execute();
					echo "exito";
				}else{
					echo "error";
				}

			}





		break;


	}



?>