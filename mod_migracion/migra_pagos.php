<?php  
	include_once "../conf/conf.php";

	require_once 'PHPExcel/Classes/PHPExcel.php';	

	$archivo = "DATA_DEL_COLEGIO_DE_BIOLOGOS_MODIFICADO.xlsx";
	$inputFileType = PHPExcel_IOFactory::identify($archivo);
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load($archivo);
	$sheet = $objPHPExcel->getSheet(0); 
	$highestRow = $sheet->getHighestRow(); 
	$highestColumn = $sheet->getHighestColumn();

	$datos = [];
	
	$num=0;
	for ($row = 2; $row <= $highestRow; $row++){ 
			if($sheet->getCell("A".$row)->getValue() != "" &&
			   $sheet->getCell("B".$row)->getValue() != "" &&
			   $sheet->getCell("C".$row)->getValue() != ""){


					// echo $sheet->getCell("A".$row)->getValue();
					// echo " -- ";
					// echo $sheet->getCell("B".$row)->getValue();
					// echo " -- ";
					// echo $sheet->getCell("C".$row)->getValue();
					// echo " -- ";
					// echo $sheet->getCell("D".$row)->getValue();
					// echo "<br>";
					// $pagos = $sheet->getCell("E".$row)->getValue();
					// echo "<br>";

					// echo $sheet->getCell("A".$row)->getValue();
					// echo " -- ";
					// echo $sheet->getCell("B".$row)->getValue();
					// echo " -- ";
					// echo $sheet->getCell("C".$row)->getValue();
					// echo " -- ";
					$estado = $sheet->getCell("C".$row)->getValue();
	 
					echo $codigo_colegiado = str_pad($sheet->getCell("D".$row)->getValue(), 5, "0", STR_PAD_LEFT); 
					echo "<br>";
					$pagos = $sheet->getCell("E".$row)->getValue();
					// echo "<br>";

					$pagos = json_decode($pagos, true);
					$datos = $pagos[0];

					if($pagos[0] == null){
						echo "nulo vacío <br>";
					}else{
						echo "<pre>";
						print_r($datos[0]);
						echo "</pre>";

					$sql = "SELECT idColegiado, codigo_col, nom_colegiado, ape_paterno, ape_materno, dni, fec_nac, foto, telefono, email, lug_nacim, lug_labores, info_contacto, estado FROM colegiados WHERE codigo_col = '". $codigo_colegiado ."'";
			    $db = $dbh->prepare($sql);
			    $db->execute();
					$fila = "";
					$data = $db->fetch(PDO::FETCH_OBJ);

						if( $data->idColegiado > 0 ){

							// echo "<pre>";
							// print_r($data);
							// echo "</pre>";


							$sql = "INSERT INTO `pagos_cabecera`(`idColegiado`, `codigo_colegiado`, `estado`) VALUES (:idcolegiado, :codigo_colegiado, :estado)";

						  $db = $dbh->prepare($sql);
						  $db->bindValue(':idcolegiado' 			, $data->idColegiado, PDO::PARAM_INT);
						  $db->bindValue(':codigo_colegiado' 	, $codigo_colegiado, 	PDO::PARAM_STR);
						  $db->bindValue(':estado'						, $estado, 						PDO::PARAM_INT);
						  $result = $db->execute();

						  echo "id insertado: ";
						  echo $idpago = $dbh->lastInsertId();
						  echo "<br>";

						  if($result){

								  	
								foreach ($datos as $dato) {
									$dat = json_decode(json_encode($dato));
									echo $dat->id."--".
											 $dat->id_pago."--".
											 $dat->nro_cuota."--".
											 $dat->fecha_vence."--".
											 $dat->mora."--".
											 $dat->deuda."--".
											 $dat->gen."--".
											 $dat->obs."--".
											 $dat->adelanto."--".
											 $dat->saldo."--".
											 $dat->estado."<br>";

									$sql = "INSERT INTO `pagos_detalle`(`idPagoC`, `id_pago`, `nro_cuota`, `fecha_vence`, `mora`, `deuda`, `gen`, `obs`, `adelanto`, `saldo`, `estado`) 
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

								  $db = $dbh->prepare($sql);
								  $db->bindValue(':idpagoc' 		, $idpago, 						PDO::PARAM_INT);
								  $db->bindValue(':id_pago' 		, $dat->id_pago, 			PDO::PARAM_INT);
								  $db->bindValue(':nro_cuota'		, $dat->nro_cuota, 		PDO::PARAM_INT);
								  $db->bindValue(':fecha_vence' , $dat->fecha_vence, 	PDO::PARAM_STR);
								  $db->bindValue(':mora' 				, $dat->mora, 				PDO::PARAM_INT);
								  $db->bindValue(':deuda'				, $dat->deuda, 				PDO::PARAM_INT);
								  $db->bindValue(':gen' 				, $dat->gen, 					PDO::PARAM_STR);
								  $db->bindValue(':obs' 				, $dat->obs, 					PDO::PARAM_STR);
								  $db->bindValue(':adelanto'		, $dat->adelanto, 		PDO::PARAM_INT);
								  $db->bindValue(':saldo' 			, $dat->saldo, 				PDO::PARAM_INT);
								  $db->bindValue(':estado'			, 1, 			PDO::PARAM_INT);
								  $result1 = $db->execute();

								  if ($result1) {
								  	echo "exito";
								  }else{
								  	echo "error";
								  }



								}
						  }



						}




					}





			}

			echo "---------------------------------------------------------------------------------------<br>";
	}


?>