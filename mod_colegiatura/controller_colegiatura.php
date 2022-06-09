<?php 

	if (strlen(session_id()) < 1) {
		session_start();
	}

	include_once "../conf/conf.php";




	switch ($_GET["op"]) {
		case 'listar_colegiaturas':
			
			$sqlColes = "SELECT * 
									 FROM colegiatura CA LEFT JOIN colegiados C
									 ON CA.idColegiado = C.idColegiado";
			$db = $dbh->prepare($sqlColes);

			try{
					$db->execute();
					$filas = $db->rowCount();
					$reg = $db->fetch(PDO::FETCH_OBJ); 
					//echo $filas . " - " . $reg->especialidad;

					$data= Array();

					while($reg = $db->fetch(PDO::FETCH_OBJ)){
//						$habilidad = ($reg->estado_colegiatura == 1) ? "HABILITADO" : "INHABILITADO" ;
						$habilidad = ($reg->estado_colegiatura == 1) ? "<span class='badge badge-pill badge-success'>HABILITADO</span>" : "<span class='badge badge-pill badge-danger'>INHABILITADO</span>";
						$fechaColegiatura = date("d/m/Y", strtotime($reg->fec_colegiatura));
						$data[]=array(
						 				"0"=>$reg->idColegiado,
						 				"1"=>$reg->dni,
						 				"2"=>$reg->codigo_col,
						 			  "3"=>$reg->nom_colegiado . " ".$reg->ape_paterno . " " . $reg->ape_materno,
						 				"4"=>$fechaColegiatura,
										"5"=>$habilidad
						 			);
					}
				
					$results = array(
						"sEcho"=>1, //Información para el datatables
						"iTotalRecords"=>count($data), //enviamos el total registros al datatable
						"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
						"aaData"=>$data);
						 		
					echo json_encode($results);
					
			}catch(PDOException $e){
					echo $e->getMessage();
			}

		break;

		case 'listar_especialidades':
				$sql = "SELECT `idespecialidad`, `especialidad`, `descrip_especialida`, `nom_corto_esp`, `estado_esp` 
								FROM `especialidades` WHERE `estado_esp` = 1";
				$db = $dbh->prepare($sql);
				$db->execute();
				$optEspecialidad = "";
				$optEspecialidad = '<option value="0">Selecciona especialidad</option>';				    

				while($reg = $db->fetch(PDO::FETCH_OBJ)){
					$optEspecialidad .='<option value="'.$reg->idespecialidad.'">'.$reg->especialidad.'</option>';
				}
				echo $optEspecialidad;
		break;

		case 'registrar_colegiatura':


				if (!isset($_SESSION["nombre"]))
				{
				  header("Location: ../mod_login/login.php");
				}
				else
				{				

					$idcolegiado 						= isset($_POST["idcolegiado"])? 						$_POST["idcolegiado"] : "";
					$fecha_pago_colegiatura = isset($_POST["fecha_pago_colegiatura"])? 	$_POST["fecha_pago_colegiatura"] : "";
					$fecha_registro					= isset($_POST["fecha_pago_colegiatura"])? 	$_POST["fecha_pago_colegiatura"] : "";
					$optSector 							= isset($_POST["optSector"])? 							$_POST["optSector"] : "";
					$univers_instit 				= isset($_POST["optUniversidad"])? 					$_POST["optUniversidad"] : "";
					$optTitulo 							= isset($_POST["optTitulo"])? 							$_POST["optTitulo"] : "" ;
					$optUniversidadPost 		= isset($_POST["optUniversidadPost"])? 			$_POST["optUniversidadPost"] : "" ;
					$titulo_post 						= isset($_POST["titulo_post"]) ? 						$_POST["titulo_post"] : "" ;
					$rne 										= isset($_POST["rne"])? 										$_POST["rne"] : "" ;
					$optEspecialidad 				= isset($_POST["optEspecialidad"])? 				$_POST["optEspecialidad"] : "";
					
					$codigo_cole_asign			= isset($_POST["txtCodigoColegiado"])? 			$_POST["txtCodigoColegiado"] : "";


					// $sql = "INSERT INTO `colegiatura`(`idColegiado`, 
					// 																	`fec_colegiatura`, 
					// 																	`fecha_registro`, 
					// 																	`desc_colegiatura`, 
					// 																	`sector_profesional`, 
					// 																	`idInstitucion`, 
					// 																	`idEspecialidad`, 
					// 																	`estado_colegiatura`)
					// 				VALUES (:idcolegiado, 
					// 				        :fec_colegiatura,
					// 				        :fecha_registro,
					// 				        :desc_colegiatura,
					// 				        :sector_profesional,
					// 				        :univ_institu,
					// 				        :idEspecialidad,
					// 				        :estado_colegiatura)";

					// $db = $dbh->prepare($sql);
					// $db->bindValue(':idcolegiado'				, $idcolegiado, 						PDO::PARAM_INT);
					// $db->bindValue(':fec_colegiatura'		, $fecha_pago_colegiatura, 	PDO::PARAM_STR);
					// $db->bindValue(':fecha_registro'		, $fecha_registro, 					PDO::PARAM_STR);
					// $db->bindValue(':desc_colegiatura'	, 'registro conforme', 			PDO::PARAM_STR);
					// $db->bindValue(':sector_profesional', $optSector, 							PDO::PARAM_STR);
					// $db->bindValue(':univ_institu'			, $univers_instit, 					PDO::PARAM_INT);
					// $db->bindValue(':idEspecialidad'		, $optEspecialidad, 				PDO::PARAM_INT);
					// $db->bindValue(':estado_colegiatura', 1, 												PDO::PARAM_INT);
					// $result = $db->execute();

					$sql = "INSERT INTO `colegiatura`(`idColegiado`, 
																		 `fec_colegiatura`, 
																		 `fecha_registro`, 
																		 `desc_colegiatura`, 
																		 `sector_profesional`, 
																		 `idInstitucion`, 
																		 `idUniv_titu_pre`, 
																		 `idUniv_post`, 
																		 `idUniv_titu_post`, 
																		 `rne`, 
																		 `idEspecialidad`, 
																		 `estado_colegiatura`) 
								 	VALUES (:idcolegiado,
								 		  		:fec_colegiatura,
								 				  :fecha_registro,
								 				  :desc_colegiatura,
								 				  :sector_profesional,
								 				  :univ_institu,
								 				  :univ_titulo_pre,
								 				  :univ_post,
								 				  :univ_titulo_post,
								 				  :rne,
								 				  :idEspecialidad,
								 				  :estado_colegiatura)";

					$db = $dbh->prepare($sql);
					$db->bindValue(':idcolegiado'				, $idcolegiado, 						PDO::PARAM_INT);
					$db->bindValue(':fec_colegiatura'		, $fecha_pago_colegiatura, 	PDO::PARAM_STR);
					$db->bindValue(':fecha_registro'		, $fecha_registro, 					PDO::PARAM_STR);
					$db->bindValue(':desc_colegiatura'	, 'registro conforme', 			PDO::PARAM_STR);
					$db->bindValue(':sector_profesional', $optSector, 							PDO::PARAM_STR);
					$db->bindValue(':univ_institu'			, $univers_instit, 					PDO::PARAM_INT);
					$db->bindValue(':univ_titulo_pre'		, $optTitulo, 							PDO::PARAM_INT);
					$db->bindValue(':univ_post'					, $optUniversidadPost, 			PDO::PARAM_INT);
					$db->bindValue(':univ_titulo_post'	, $titulo_post, 						PDO::PARAM_INT);
					$db->bindValue(':rne'								, $rne, 										PDO::PARAM_STR);
					$db->bindValue(':idEspecialidad'		, $optEspecialidad, 				PDO::PARAM_INT);
					$db->bindValue(':estado_colegiatura', 1, 												PDO::PARAM_INT);
					$result = $db->execute();


					if ($result) {

						$sqlUpdCol ="UPDATE `colegiados` SET `codigo_col`=:codigo_col, `password`=:password WHERE `idColegiado` = " . $idcolegiado;
						$db2 = $dbh->prepare($sqlUpdCol);
						$db2->bindValue(':codigo_col'	, $codigo_cole_asign			, PDO::PARAM_STR);
						$db2->bindValue(':password'		, MD5($codigo_cole_asign)	, PDO::PARAM_STR);
						$result2 = $db2->execute();

						if($result2){
							echo "exito";
						}else{
							echo "error_upd";
						}
					
					}else{
						echo "error";
					}


				}


		break;

		

	}



?>
