<?php 

	if (strlen(session_id()) < 1) {
		session_start();
	}

	include_once "../conf/conf.php";




	switch ($_GET["op"]) {
		
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
					$univers_instit 				= isset($_POST["univers_instit"])? 					$_POST["univers_instit"] : "";
					$optEspecialidad 				= isset($_POST["optEspecialidad"])? 				$_POST["optEspecialidad"] : "";



					$sql = "INSERT INTO `colegiatura`(`idColegiado`, 
																						`fec_colegiatura`, 
																						`fecha_registro`, 
																						`desc_colegiatura`, 
																						`sector_profesional`, 
																						`univ_institu`, 
																						`idEspecialidad`, 
																						`estado_colegiatura`) 
									VALUES (:idcolegiado, 
									        :fec_colegiatura,
									        :fecha_registro,
									        :desc_colegiatura,
									        :sector_profesional,
									        :univ_institu,
									        :idEspecialidad,
									        :estado_colegiatura)";

					$db = $dbh->prepare($sql);
					$db->bindValue(':idcolegiado'				, $idcolegiado, 						PDO::PARAM_INT);
					$db->bindValue(':fec_colegiatura'		, $fecha_pago_colegiatura, 	PDO::PARAM_STR);
					$db->bindValue(':fecha_registro'		, $fecha_registro, 					PDO::PARAM_STR);
					$db->bindValue(':desc_colegiatura'	, 'registro conforme', 			PDO::PARAM_STR);
					$db->bindValue(':sector_profesional', $optSector, 							PDO::PARAM_STR);
					$db->bindValue(':univ_institu'			, $univers_instit, 					PDO::PARAM_STR);
					$db->bindValue(':idEspecialidad'		, $optEspecialidad, 				PDO::PARAM_INT);
					$db->bindValue(':estado_colegiatura', 1, 												PDO::PARAM_INT);
					$result = $db->execute();

					if ($result) {
						echo "exito";
					}else{
						echo "error";
					}


				}


		break;

		

	}



?>