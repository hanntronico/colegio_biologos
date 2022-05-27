<?php 

	if (strlen(session_id()) < 1) {
		session_start();
	}

	include_once "../conf/conf.php";

			switch ($_GET["op"]){

					case 'listar':
						if (!isset($_SESSION["nombre"]))
						{
						  header("Location: ".ENLACE_WEB);
						}
						else
						{
							if (1==1)
							{

				$sql = "SELECT idColegiado, codigo_col, nom_colegiado, ape_paterno, ape_materno, dni, fec_nac, foto, telefono, email, lug_nacim, lug_labores, info_contacto, estado FROM colegiados ORDER BY idColegiado DESC LIMIT 0, 5000";

		    $db = $dbh->prepare($sql);
		    $db->execute();



						 		$data= Array();

						 		while($reg = $db->fetch(PDO::FETCH_OBJ)){

						 			$estado = ($reg->estado == 1) ? "<span class='badge badge-pill badge-success'>Activo</span>" : "<span class='badge badge-pill badge-danger'>Inactivo</span>";

									$btnEstado = ($reg->estado == 1) ? "<button type='button' class='btn btn-danger btn-sm' onclick='desactivar(".$reg->idColegiado.")'><i class='fa fa-minus'></i></button>" : "<button type='button' class='btn btn-primary btn-sm' onclick='activar(".$reg->idColegiado.")'><i class='fa fa-check'></i></button>";

									$acciones = "<button type='button' class='btn btn-warning btn-sm'><i class='fa fa-edit mr-1'></i>Editar</button>";

									$correo = ( strlen($reg->email) > 30 ) ? substr($reg->email, 0, 30) . "..." : $reg->email;

						 			$data[]=array(
					 				
						 				"0"=>$reg->idColegiado,
						 				"1"=>$reg->dni,
						 				"2"=>$reg->codigo_col,
						 				"3"=>$reg->nom_colegiado,
						 			  "4"=>$reg->ape_paterno . " " . $reg->ape_materno,
						 				"5"=>$reg->telefono,
						 				"6"=>$correo,
						 				"7"=>$estado,
						 				"8"=>$acciones . $btnEstado
						 				
						 			);

						 		}
						 		$results = array(
						 			"sEcho"=>1, //Información para el datatables
						 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
						 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
						 			"aaData"=>$data);
						 		
						 		echo json_encode($results);

							//Fin de las validaciones de acceso
							}
							else
							{
						  	require 'noacceso.php';
							}
						}
					break;

					case 'listar_pagos':
						if (!isset($_SESSION["nombre"]))
						{
						  header("Location: ".ENLACE_WEB);
						}
						else
						{
							if (1==1)
							{

								$sql = "SELECT `idPagosC`, `codigo_colegiado` 
												FROM `pagos_cabecera` 
												WHERE idColegiado = " . $_GET["idcol"];
								$db = $dbh->prepare($sql);
								$db->execute();
								$data_pagosC = $db->fetch(PDO::FETCH_OBJ);


								if ($data_pagosC->idPagosC != "") {
									// echo "<pre>";
									// print_r($data_pagosC);
									// echo "</pre>";
										$sql = "SELECT `idPagoDetalle`, `idPagoC`, `id_pago`, `nro_cuota`, `fecha_vence`, `mora`, `deuda`, `gen`, `obs`, `adelanto`, `saldo`, `estado` FROM `pagos_detalle` WHERE idPagoC = " . $data_pagosC->idPagosC . " ORDER BY idPagoDetalle DESC";
										$db = $dbh->prepare($sql);
										$db->execute();
										$fila = "";

										$data= Array();

										while($data_pago = $db->fetch(PDO::FETCH_OBJ)){

											$fechaVence = date("d/m/Y", strtotime($data_pago->fecha_vence));

											$data[]=array(

							         "0"=>$data_pagosC->codigo_colegiado,
							         "1"=>$data_pago->nro_cuota,
							         "2"=>$fechaVence,
							         "3"=>$data_pago->mora,
							         "4"=>$data_pago->deuda,
							         "5"=>$data_pago->gen,
							         "6"=>$data_pago->adelanto,
							         "7"=>$data_pago->saldo
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


						}
					}
					break;

			}



	if ($_POST["accion"]=='carga_datos_cole') {

		$sql = "SELECT idColegiado, codigo_col, nom_colegiado, 
									 ape_paterno, ape_materno, dni, fec_nac, foto, telefono, email, lug_nacim, lug_labores, info_contacto, estado 
						FROM colegiados WHERE idColegiado = " .$_POST["idColegiado"]. "  LIMIT 0, 100";
		$db = $dbh->prepare($sql);
		$db->execute();
		$data_col = $db->fetch(PDO::FETCH_OBJ);

		// echo $data_col->codigo_col . "--". $data_col->ape_paterno ." ".$data_col->ape_materno .", ".$data_col->nom_colegiado;

		echo json_encode(["idcolegiado" => $data_col->idColegiado,
											 "datosColegiado" => $data_col->codigo_col . "--". $data_col->ape_paterno ." ".$data_col->ape_materno .", ".$data_col->nom_colegiado ]);

	}


	if ($_POST["accion"]=='buscar_pagos') {

// idPagosC, idColegiado, codigo_colegiado, estado

		$sql = "SELECT `idPagosC`, `codigo_colegiado` FROM `pagos_cabecera` WHERE idColegiado = " . $_POST["idColegiado"];
		$db = $dbh->prepare($sql);
		$db->execute();
		$data_pagosC = $db->fetch(PDO::FETCH_OBJ);

			if ($data_pagosC->idPagosC != "") {
				// echo "<pre>";
				// print_r($data_pagosC);
				// echo "</pre>";
					$sql = "SELECT `idPagoDetalle`, `idPagoC`, `id_pago`, `nro_cuota`, `fecha_vence`, `mora`, `deuda`, `gen`, `obs`, `adelanto`, `saldo`, `estado` FROM `pagos_detalle` WHERE idPagoC = " . $data_pagosC->idPagosC;
					$db = $dbh->prepare($sql);
					$db->execute();
					$fila = "";
					while($data = $db->fetch(PDO::FETCH_OBJ)):
						$fila .= "<tr>
						          <td>".$data_pagosC->codigo_colegiado."</td>
						          <td>".$data->nro_cuota."</td>
						          <td>".$data->fecha_vence."</td>
						          <td>".$data->mora."</td>
						          <td>".$data->gen."</td>
						          <td>".$data->adelanto."</td>
						          <td>".$data->saldo."</td>
						         </tr>";
					endwhile;
					echo $fila;

			}else{
					echo "<tr><td colspan='7' class='text-center'>Sin pagos</td></tr>";
			}

		

		// // $sql = "SELECT `idPagoDetalle`, `idPagoC`, `id_pago`, `nro_cuota`, `fecha_vence`, `mora`, `deuda`, `gen`, `obs`, `adelanto`, `saldo`, `estado` FROM `pagos_detalle` WHERE 1"
		
		// $fila = "";

		// while($data = $db->fetch(PDO::FETCH_OBJ)):

		// 			// $estado = ($data->estado == 1) ? "<span class='badge badge-pill badge-success'>Activo</span>" : "<span class='badge badge-pill badge-danger'>Inactivo</span>";

		// 			// $btnEstado = ($data->estado == 1) ? "<button type='button' class='btn btn-danger btn-sm' onclick='desactivar(".$data->idColegiado.")'><i class='fa fa-minus'></i></button>" : "<button type='button' class='btn btn-primary btn-sm' onclick='activar(".$data->idColegiado.")'><i class='fa fa-check'></i></button>";

		// 			// strlen($data->email)
		// 			// $correo = ( strlen($data->email) > 50 ) ? substr($data->email, 0, 50) . "..." : $data->email;

		// 			$fila .= "<tr>
		// 			          <td>".$data->codigo_colegiado."</td>
		// 			          <td><a href='javascript:;'>".$data->codigo_col."</a></td>
		// 			          <td>".$data->nom_colegiado."</td>
		// 			          <td>".$data->ape_paterno . " " . $data->ape_materno ."</td>
		// 			          <td>".$data->telefono."</td>
		// 			          <td>".$correo."</td>
		// 			          <td>".$estado."</td>
		// 			         </tr>";
		// 	  endwhile;
		// 		echo $fila;
	}







?>