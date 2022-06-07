<?php 

	if (strlen(session_id()) < 1) {
		session_start();
	}

	include_once "../conf/conf.php";

			switch ($_GET["op"]){

					case 'listar_servicios':

						$sql = "SELECT `idServicio`, 
													 `nom_servicio`, 
													 `descrip_servicio`, 
													 `precio`, 
													 `estado_servicio` 
										FROM `servicios` WHERE `estado_servicio` = 1";
				    $db = $dbh->prepare($sql);
				    $db->execute();
						$optServicio = "";
						$optServicio = '<option value="0">Selecciona Servicio</option>';				    

						while($reg = $db->fetch(PDO::FETCH_OBJ)){
							$optServicio .='<option value="'.$reg->idServicio.'">'.$reg->nom_servicio.'</option>';
						}
						echo $optServicio;

						// if (!isset($_SESSION["nombre"]))
						// {
						//   header("Location: ".ENLACE_WEB);
						// }
						// else
						// {

						// 		$sql = "SELECT `idServicios`, 
						// 									 `nom_servicio`, 
						// 									 `descrip_servicio`, 
						// 									 `precio`, 
						// 									 `estado_servicio` 
						// 						FROM `servicios` WHERE `estado_servicio` = 1";

						//     $db = $dbh->prepare($sql);
						//     $db->execute();
						//  		$data= Array();

						//  		while($reg = $db->fetch(PDO::FETCH_OBJ)){

						//  			$data[]=array(
						//  				"0"=>$reg->idServicios,
						//  				"1"=>$reg->nom_servicio,
						//  			);

						//  		}

						//  		$results = array(
						//  			"sEcho"=>1, 
						//  			"iTotalRecords"=>count($data),
						//  			"iTotalDisplayRecords"=>count($data),
						//  			"aaData"=>$data);
						 		
						//  		echo json_encode($results);
						// }
					break;

					case 'listar_servicios_seleccionados':

						$data= Array();
					 				// <i class='fas fa-arrow-circle-right'>
						// <button type='button' class='btn btn-primary btn-sm'>
					 // 				<i class='fas fa-trash'>
					 // 				</button>
						if (!empty($_SESSION["serv_sel"])){
							for ($i=0; $i < count($_SESSION["serv_sel"]); $i++) { 
					 			$data[]=array(
					 				"0"=>$_SESSION["serv_sel"][$i]["idServicio"],
					 				"1"=>$_SESSION["serv_sel"][$i]["nom_servicio"],
					 				"2"=>$_SESSION["serv_sel"][$i]["cantidad"],
					 				"3"=>$_SESSION["serv_sel"][$i]["precio"],
					 			  "4"=>$_SESSION["serv_sel"][$i]["importe"]
					 			);
							}
	
							$results = array(
									"sEcho"=>1, 
									"iTotalRecords"=>count($data), 
									"iTotalDisplayRecords"=>count($data),
									"aaData"=>$data);

							echo json_encode($results);

						}else{
							echo "error";
						}


						// if (empty($_SESSION["listadecompra"])) {
						//     $i = 0;
						//     $_SESSION["listadecompra"][$i] = $productos;
						// } else {
						//     $i = count($_SESSION["listadecompra"]);
						//     $i++;
						//     $_SESSION["listadecompra"][$i] = $productos;
						// }

						// if (!isset($_SESSION["nombre"]))
						// {
						//   header("Location: ".ENLACE_WEB);
						// }
						// else
						// {

						// 		$sql = "SELECT `idPagosC`, `codigo_colegiado` 
						// 						FROM `pagos_cabecera` 
						// 						WHERE idColegiado = " . $_GET["idcol"];
						// 		$db = $dbh->prepare($sql);
						// 		$db->execute();
						// 		$data_pagosC = $db->fetch(PDO::FETCH_OBJ);

						// 		if ($data_pagosC->idPagosC != "") {

						// 				$sql = "SELECT `idPagoDetalle`, `idPagoC`, `id_pago`, `nro_cuota`, `fecha_vence`, `mora`, `deuda`, `gen`, `obs`, `adelanto`, `saldo`, `estado` FROM `pagos_detalle` WHERE idPagoC = " . $data_pagosC->idPagosC;
						// 				$db = $dbh->prepare($sql);
						// 				$db->execute();
						// 				$fila = "";

						// 				$data= Array();

						// 				while($data_pago = $db->fetch(PDO::FETCH_OBJ)){

						// 					$fechaVence = date("d/m/Y", strtotime($data_pago->fecha_vence));

						// 					$data[]=array(

						// 	         "0"=>$data_pagosC->codigo_colegiado,
						// 	         "1"=>$data_pago->nro_cuota,
						// 	         "2"=>$fechaVence,
						// 	         "3"=>$data_pago->mora,
						// 	         "4"=>$data_pago->deuda,
						// 	         "5"=>$data_pago->gen,
						// 	         "6"=>$data_pago->adelanto,
						// 	         "7"=>$data_pago->saldo
						// 					);
						// 				}

						// 			 	$results = array(
						// 				 		"sEcho"=>1, 
						// 				 		"iTotalRecords"=>count($data), 
						// 				 		"iTotalDisplayRecords"=>count($data), 
						// 				 		"aaData"=>$data);			

						// 				echo json_encode($results);					

						// 		}else{
						// 			echo "error";
						// 		}


						// }
					break;

					case 'listar_pagos_servicios':
						if (!isset($_SESSION["nombre"]))
						{
						  header("Location: ".ENLACE_WEB);
						}
						else
						{

								$sql = "SELECT ps.idPagoServ, ps.fecha_pago_serv, ps.idColegiado, ps.descripcion, ps.monto, 
															 ps.estado, c.idColegiado, c.codigo_col, c.nom_colegiado, c.ape_paterno, 
															 c.ape_materno, c.dni
												FROM pagos_servicios ps INNER JOIN colegiados c
												ON ps.idColegiado = c.idColegiado";

								$db = $dbh->prepare($sql);
								$db->execute();

								$data= Array();

								while($data_pagosS = $db->fetch(PDO::FETCH_OBJ)){
									$fechaPagoServ = date("d/m/Y", strtotime($data_pagosS->fecha_pago_serv));

									$data[]=array(
					         "0"=>$data_pagosS->idPagoServ,
					         "1"=>$fechaPagoServ,
					         "2"=>$data_pagosS->codigo_col,
					         "3"=>$data_pagosS->nom_colegiado . " " . $data_pagosS->ape_paterno . " " . $data_pagosS->ape_materno,
					         "4"=>$data_pagosS->descripcion,
					         "5"=>$data_pagosS->monto,
					         "6"=>"<a class='btn btn-info btn-sm' href='".ENLACE_WEB."mod_pagos/comprobante_pdf.php?id=".$data_pagosS->idPagoServ."&idcol=".$data_pagosS->idColegiado."' target='_blank'><i class='fas fa-print'></i></a>"
									);
								}


								if(count($data)>0){
									$results = array(
											 		"sEcho"=>1, 
											 		"iTotalRecords"=>count($data), 
											 		"iTotalDisplayRecords"=>count($data), 
											 		"aaData"=>$data);			

									echo json_encode($results);	
								}
								else{
									echo "error";
								}


						// 		if ($data_pagosC->idPagosC != "") {

						// 				$sql = "SELECT `idPagoDetalle`, `idPagoC`, `id_pago`, `nro_cuota`, `fecha_vence`, `mora`, `deuda`, `gen`, `obs`, `adelanto`, `saldo`, `estado` FROM `pagos_detalle` WHERE idPagoC = " . $data_pagosC->idPagosC;
						// 				$db = $dbh->prepare($sql);
						// 				$db->execute();
						// 				$fila = "";

						// 				$data= Array();

						// 				while($data_pago = $db->fetch(PDO::FETCH_OBJ)){

						// 					$fechaVence = date("d/m/Y", strtotime($data_pago->fecha_vence));

						// 					$data[]=array(

						// 	         "0"=>$data_pagosC->codigo_colegiado,
						// 	         "1"=>$data_pago->nro_cuota,
						// 	         "2"=>$fechaVence,
						// 	         "3"=>$data_pago->mora,
						// 	         "4"=>$data_pago->deuda,
						// 	         "5"=>$data_pago->gen,
						// 	         "6"=>$data_pago->adelanto,
						// 	         "7"=>$data_pago->saldo
						// 					);
						// 				}

						// 			 	$results = array(
						// 				 		"sEcho"=>1, 
						// 				 		"iTotalRecords"=>count($data), 
						// 				 		"iTotalDisplayRecords"=>count($data), 
						// 				 		"aaData"=>$data);			

						// 				echo json_encode($results);					

						// 		}else{
						// 			echo "error";
						// 		}
						}

					break;


					case 'agregar_servicios':

						$cant = 0;

						// $idservicio = isset($_POST["optServicio"])?	$_POST["optServicio"]	: "";
						// echo "servicio selecionado: " . $_POST["optServicio"] . "--" . $_POST["idcolegiado"] . "--" . $_POST["fecha_pago_serv"];

						$sql = "SELECT `idServicio`, 
													 `nom_servicio`, 
													 `descrip_servicio`, 
													 `precio`, 
													 `estado_servicio` 
										FROM `servicios` WHERE `estado_servicio` = 1 AND idServicio = ".$_POST["optServicio"];
				    $db = $dbh->prepare($sql);
				    $db->execute();

				    if( isset($_SESSION["serv_sel"]) ){


				    	if ( count($_SESSION["serv_sel"]) > 0 ) {

				    		for ($i=0; $i < count($_SESSION["serv_sel"]); $i++) { 
									if( $_SESSION["serv_sel"][$i]["idServicio"] == $_POST["optServicio"] ){
										$cant++;
										$pos = $i;
									}
					    	}
					    	

					    	if( $cant > 0 ){
					    		$_SESSION["serv_sel"][$pos]["cantidad"] = $_SESSION["serv_sel"][$pos]["cantidad"] + 1;
					    		$_SESSION["serv_sel"][$pos]["importe"] = number_format($_SESSION["serv_sel"][$pos]["cantidad"] * $_SESSION["serv_sel"][$pos]["precio"], 2);
					    	}else{

					    		$newpos = count($_SESSION["serv_sel"]);

						    	while($reg = $db->fetch(PDO::FETCH_OBJ)){
										$_SESSION["serv_sel"][$newpos]["idServicio"] = $reg->idServicio;
										$_SESSION["serv_sel"][$newpos]["nom_servicio"] = $reg->nom_servicio;
										$_SESSION["serv_sel"][$newpos]["cantidad"] = 1;
										$_SESSION["serv_sel"][$newpos]["precio"] = $reg->precio;
										$_SESSION["serv_sel"][$newpos]["importe"] = number_format((1*$reg->precio), 2);

									}

					    	}
				    	
				    	}


				    }else{

				    	while($reg = $db->fetch(PDO::FETCH_OBJ)){
								$_SESSION["serv_sel"][$cant]["idServicio"] = $reg->idServicio;
								$_SESSION["serv_sel"][$cant]["nom_servicio"] = $reg->nom_servicio;
								$_SESSION["serv_sel"][$cant]["cantidad"] = 1;
								$_SESSION["serv_sel"][$cant]["precio"] = $reg->precio;
								$_SESSION["serv_sel"][$cant]["importe"] = number_format((1*$reg->precio), 2);
							}

				    }

						// echo $_SESSION["serv_sel"];
					break;

					case 'agregar_servicios2':

						$cant = 0;

				    if( isset($_SESSION["serv_sel"]) ){

				    	if ( count($_SESSION["serv_sel"]) > 0 ) {

				    		for ($i=0; $i < count($_SESSION["serv_sel"]); $i++) { 
									if( $_SESSION["serv_sel"][$i]["idServicio"] == $_POST["optServicio"] ){
										$cant++;
										$pos = $i;
									}
					    	}
					    	

					    	if( $cant > 0 ){
					    		$_SESSION["serv_sel"][$pos]["cantidad"] = $_SESSION["serv_sel"][$pos]["cantidad"] + 1;
					    		$_SESSION["serv_sel"][$pos]["importe"] = number_format($_SESSION["serv_sel"][$pos]["cantidad"] * $_SESSION["serv_sel"][$pos]["precio"], 2);
					    	}else{

					    		$newpos = count($_SESSION["serv_sel"]);

						    	while($reg = $db->fetch(PDO::FETCH_OBJ)){
										$_SESSION["serv_sel"][$newpos]["idServicio"] = $reg->idServicio;
										$_SESSION["serv_sel"][$newpos]["nom_servicio"] = $reg->nom_servicio;
										$_SESSION["serv_sel"][$newpos]["cantidad"] = 1;
										$_SESSION["serv_sel"][$newpos]["precio"] = $reg->precio;
										$_SESSION["serv_sel"][$newpos]["importe"] = number_format((1*$reg->precio), 2);
									}

					    	}
				    	
				    	}


				    }else{

				    	// while($reg = $db->fetch(PDO::FETCH_OBJ)){
								// $_SESSION["serv_sel"][$cant]["idServicio"] = $reg->idServicio;
								// $_SESSION["serv_sel"][$cant]["nom_servicio"] = $reg->nom_servicio;
								// $_SESSION["serv_sel"][$cant]["cantidad"] = 1;
								// $_SESSION["serv_sel"][$cant]["precio"] = $reg->precio;
								// $_SESSION["serv_sel"][$cant]["importe"] = number_format((1*$reg->precio), 2);

				    		$precio 	= number_format($_POST["formGroupPrecio"],2, '.','');
				    		$importe 	= $precio * $_POST["formGroupCantidad"];
				    		$importe = number_format($importe, 2, '.', '');

								$_SESSION["serv_sel"][$cant]["idServicio"] 	 	= 4;
								$_SESSION["serv_sel"][$cant]["nom_servicio"] 	= $_POST["formGroupDescripcion"];
								$_SESSION["serv_sel"][$cant]["cantidad"] 			= $_POST["formGroupCantidad"];
								$_SESSION["serv_sel"][$cant]["precio"] 				= $precio;
								$_SESSION["serv_sel"][$cant]["importe"] 			= $importe;

							// }


				    }


					break;
					
					case 'limpia_deuda':
						unset($_SESSION["total_deuda"]);
					break;

					case 'elimina_servicios':
							// echo $_GET["idfila"]; 
							// $data= Array();

							// for ($i=0; $i < count($_SESSION["serv_sel"]); $i++) { 
							// 	if( $_SESSION["serv_sel"][$i]["idServicio"] == $_GET["idserv"] ){
							// 		$pos = $i;
							// 	}
							// }


							// unset( $_SESSION['serv_sel'][$pos] ); 
							// $data = $_SESSION['serv_sel'];

							unset($_SESSION['serv_sel']);

							// echo "<pre>";
							// print_r($_SESSION['serv_sel']);
							// echo "</pre>";

							

							// echo "<pre>";
							// print_r($data);
							// echo "</pre>";

							// unset($_SESSION['serv_sel']);


							// exit();
							
    // [2] => Array
    //     (
    //         [idServicio] => 3
    //         [nom_servicio] => CERTIFICADO DE HABILIDAD
    //         [cantidad] => 1
    //         [precio] => 15.00
    //         [importe] => 15.00
    //     )							

// $datos_list = "";

// for ($i=0; $i < count($data); $i++) { 

// 	$_SESSION["serv_sel"][$i]["idServicio"] 	= $data[$i]["idServicio"];
// 	$_SESSION["serv_sel"][$i]["nom_servicio"] = $data[$i]["nom_servicio"];
// 	$_SESSION["serv_sel"][$i]["cantidad"] 		= $data[$i]["cantidad"];
// 	$_SESSION["serv_sel"][$i]["precio"] 			= $data[$i]["precio"];
// 	$_SESSION["serv_sel"][$i]["importe"] 			= $data[$i]["importe"];

// 	// $datos_list .= $data[$i]["idServicio"] . "-" . $data[$i]["nom_servicio"] . "-" . $data[$i]["cantidad"];
// }

	// echo $_SESSION['serv_sel'];

							// session_destroy();
							// $_SESSION['serv_sel'] = $data;

							// echo "<pre>";
							// print_r($data);
							// echo "</pre>";
							// exit();
							

					break;

					case 'registrar_servicios':

								$montoTotal = 0;
								$resDetalle = 0;

								if (!isset($_SESSION["nombre"]))
								{
								  header("Location: ../mod_login/login.php");//Validamos el acceso solo a los usuarios logueados al sistema.
								}
								else
								{

									if( isset($_SESSION["serv_sel"]) ){
										for ($i=0; $i < count($_SESSION["serv_sel"]); $i++) { 
											$montoTotal = $montoTotal + $_SESSION["serv_sel"][$i]["importe"];											
							    	}
									}

									// echo "monto total: " . $montoTotal;

									$estadoPagoServ = ($_POST["estadoServicio"]==0) ? 1 : $_POST["estadoServicio"];

									if($_POST["estadoServicio"]==0){
										$descripcionServ = $_POST["descripcionServ"];
									}else{
										$descripcionServ = $_POST["descripcionServ"];
									}


									if ($montoTotal > 0) {

										$sql = "INSERT INTO `pagos_servicios`(`fecha_pago_serv`, `idColegiado`, `descripcion`, `monto`, `estado`) 
														VALUES (:fecha_pago_serv, :idColegiado, :descripcion ,:monto, :estado)";

									  $db = $dbh->prepare($sql);
									  $db->bindValue(':fecha_pago_serv' , $_POST["fecha_pago_serv"],	PDO::PARAM_STR);
									  $db->bindValue(':idColegiado' 		, $_POST["idcolegiado"], 			PDO::PARAM_INT);
									  $db->bindValue(':descripcion'			, $descripcionServ, 					PDO::PARAM_STR);
									  $db->bindValue(':monto'			  		, $montoTotal, 								PDO::PARAM_INT);
									  $db->bindValue(':estado'					, $estadoPagoServ, 						PDO::PARAM_INT);
									  $result = $db->execute();
									  $idpagoserv = $dbh->lastInsertId();

									  if($result){

									  		for ($i=0; $i < count($_SESSION["serv_sel"]); $i++) {

											  	$sql2 = "INSERT INTO `pagos_servicios_detalle`(`idPagoServ`, `idServicio`, `cantidad`, `precio`, `importe`) VALUES (:idpagoserv, :idservicio, :cantidad, :precio, :importe)";
												  $db = $dbh->prepare($sql2);
												  $db->bindValue(':idpagoserv' 	, $idpagoserv,															PDO::PARAM_INT);
												  $db->bindValue(':idservicio' 	, $_SESSION["serv_sel"][$i]["idServicio"],	PDO::PARAM_INT);
												  $db->bindValue(':cantidad' 		, $_SESSION["serv_sel"][$i]["cantidad"], 		PDO::PARAM_INT);
												  $db->bindValue(':precio'	 		, $_SESSION["serv_sel"][$i]["precio"], 			PDO::PARAM_INT);
												  $db->bindValue(':importe'			, $_SESSION["serv_sel"][$i]["importe"], 		PDO::PARAM_INT);
												  $result2 = $db->execute();

												  if($result2){
												  	$resDetalle++;
												  } 

									  		}

									  		if($resDetalle > 0 && $resDetalle == count($_SESSION["serv_sel"]) ){
									  			unset($_SESSION['serv_sel']);
									  			echo "exito";
									  		}

 
									  		if( $_POST["financia"] == 1 ){

														$sql = "SELECT PD.`idPagoDetalle`, 
																					 PD.`idPagoC`, 
																					 PD.`id_pago`, 
																					 PD.`nro_cuota`, 
																					 PD.`fecha_vence`, 
																					 PD.`mora`, 
																					 PD.`deuda`, 
																					 PD.`gen`, 
																					 PD.`obs`, 
																					 PD.`adelanto`, 
																					 PD.`saldo`, 
																					 PD.`estado`, 
																					 C.idColegiado, 
																					 C.codigo_col
																		FROM pagos_detalle PD LEFT JOIN pagos_cabecera PC
																		ON PD.idPagoC = PC.idPagosC
																		INNER JOIN colegiados C
																		ON C.idColegiado = PC.idColegiado
																		WHERE C.idColegiado = " . $_POST["idcolegiado"] . "
																		ORDER BY 1 DESC";
														$db = $dbh->prepare($sql);
														$db->execute();

														while($data_pago = $db->fetch(PDO::FETCH_OBJ)){
															$sqlFinancia = "UPDATE `pagos_detalle` 
																							SET `deuda` = " . ($data_pago->deuda - $data_pago->deuda) . ", 
																									`adelanto` = " . ($data_pago->deuda) . ", 
																									`saldo` = " . ($data_pago->saldo - $data_pago->deuda) . ",
																									`estado` = 0 
																									WHERE `idPagoDetalle` = " . $data_pago->idPagoDetalle;
															$db2 = $dbh->prepare($sqlFinancia);
															$db2->execute();
														}
									  			
									  		// 	$sql = "SELECT `idPagosC`, `codigo_colegiado` 
													// 				FROM `pagos_cabecera` 
													// 				WHERE idColegiado = " . $_POST["idcolegiado"];
													// $db = $dbh->prepare($sql);
													// $db->execute();
													// $data_pagosC = $db->fetch(PDO::FETCH_OBJ);

													// 	if ($data_pagosC->idPagosC != "") {

													// 			$sql2 = "SELECT `idPagoDetalle`, `idPagoC`, `id_pago`, `nro_cuota`, `fecha_vence`, `mora`, `deuda`, `gen`, `obs`, `adelanto`, `saldo`, `estado` 
													// 							 FROM `pagos_detalle` 
													// 							 WHERE idPagoC = " . $data_pagosC->idPagosC;
													// 			$db = $dbh->prepare($sql2);
													// 			$db->execute();
													// 			$fila = "";

													// 			while($data_pago = $db->fetch(PDO::FETCH_OBJ)){
													// 				$sqlFinancia = "UPDATE `pagos_detalle` 
													// 												SET `deuda` = " . ($data_pago->deuda - $data_pago->deuda) . ", 
													// 														`adelanto` = " . ($data_pago->deuda) . ", 
													// 														`saldo` = " . ($data_pago->saldo - $data_pago->deuda) . ",
													// 														`estado` = 0 
													// 												WHERE `idPagoDetalle` = " . $data_pago->idPagoDetalle;
													// 				$db2 = $dbh->prepare($sqlFinancia);
													// 				$db2->execute();
													// 			}
													// 	}		


														if( $montoTotal < $_POST["montoFinancia"] ){

																echo " entro con estos datos -> monto total : " . $montoTotal . " - monto parte: " . $_POST["montoFinancia"]; 

																$sqlpc = "INSERT INTO `pagos_cabecera`(`idColegiado`, `codigo_colegiado`, `estado`) 
																				VALUES (:idcolegiado, :codigo_colegiado, :estado)";

															  $db4 = $dbh->prepare($sqlpc);
															  $db4->bindValue(':idcolegiado' 			, $_POST["idcolegiado"], PDO::PARAM_INT);
															  $db4->bindValue(':codigo_colegiado'	, "",								 	   PDO::PARAM_STR);
															  $db4->bindValue(':estado'						, 1, 						   			 PDO::PARAM_INT);
															  $result = $db4->execute();

															  $idpago = $dbh->lastInsertId();

															  if($result){
															  	$deuda = ($_POST["montoFinancia"] - $montoTotal);
															  	$deuda = number_format( $deuda ,2, '.','');

																	$sqlDeuda = "INSERT INTO `pagos_detalle`(`idPagoC`, 
																																						 `id_pago`, 
																																						 `nro_cuota`, 
																																						 `fecha_vence`, 
																																						 `mora`, 
																																						 `deuda`, 
																																						 `gen`, 
																																						 `obs`, 
																																						 `adelanto`, 
																																						 `saldo`, 
																																						 `estado`) 
																			 					VALUES (:idpagoc, 
																			 									:id_pago, 
																			 									:nro_cuota, 
																			 									:fecha_vence,
																			 									:mora,
																			 									:deuda,
																			 									:gen,
																			 									:obs,
																			 									:adelanto,
																			 									:saldo,
																			 									:estado)";

																	$db3 = $dbh->prepare($sqlDeuda);
																	$db3->bindValue(':idpagoc' 		, $idpago, 												PDO::PARAM_INT);
																	$db3->bindValue(':id_pago' 		, 1, 															PDO::PARAM_INT);
																	$db3->bindValue(':nro_cuota'		, 1, 														PDO::PARAM_INT);
																	$db3->bindValue(':fecha_vence' , date("Y-m-d"), 								PDO::PARAM_STR);
																	$db3->bindValue(':mora' 				, number_format( 0 ,2, '.',''), PDO::PARAM_INT);
																	$db3->bindValue(':deuda'				, $deuda, 											PDO::PARAM_INT);
																	$db3->bindValue(':gen' 				, "FINAN".date("d-m-Y"),					PDO::PARAM_STR);
																	$db3->bindValue(':obs' 				, "", 														PDO::PARAM_STR);
																	$db3->bindValue(':adelanto'		, number_format( 0 ,2, '.',''),		PDO::PARAM_INT);
																	$db3->bindValue(':saldo' 			, $deuda, 												PDO::PARAM_INT);
																	$db3->bindValue(':estado'			, 1, 															PDO::PARAM_INT);
																	$result1 = $db3->execute();

																	  // if ($result1) {
																	  // 	echo "exito";
																	  // }else{
																	  // 	echo "error";
																	  // }
															  }

														}
								  			

									  		}

	
									  }else {
									  	echo "error";
									  }



	
									}else{
										echo "no_data";
									}
							

								}


					break;

			}


?>