<?php 
		if (strlen(session_id()) < 1){
			session_start();
		}

			include_once "../conf/conf.php";

			switch ($_GET["op"]){

					case 'listar':
						if (!isset($_SESSION["nombre"]))
						{
						  header("Location: ../vistas/login.html");
						}
						else
						{
							if (1==1)
							{

								$sql = "SELECT idColegiado, codigo_col, nom_colegiado, ape_paterno, ape_materno, dni, fec_nac, foto, telefono, email, lug_nacim, lug_labores, info_contacto, estado FROM colegiados ORDER BY idColegiado DESC";

		    				$db = $dbh->prepare($sql);
		    				$db->execute();



						 		$data= Array();

						 		while($reg = $db->fetch(PDO::FETCH_OBJ)){

						 			$estado = ($reg->estado == 1) ? "<span class='badge badge-pill badge-success'>Activo</span>" : "<span class='badge badge-pill badge-danger'>Inactivo</span>";

									$btnEstado = ($reg->estado == 1) ? "<button type='button' class='btn btn-danger btn-sm' onclick='desactivar(".$reg->idColegiado.")'><i class='fa fa-minus'></i></button>" : "<button type='button' class='btn btn-primary btn-sm' onclick='activar(".$reg->idColegiado.")'><i class='fa fa-check'></i></button>";

									$acciones = "<button type='button' class='btn btn-warning btn-sm' onclick='editar(".$reg->idColegiado.")'><i class='fa fa-edit mr-1'></i>Editar</button>";

									$correo = ( strlen($reg->email) > 30 ) ? substr($reg->email, 0, 30) . "..." : $reg->email;

						 			$data[]=array(
					 				
						 				"0"=>$reg->idColegiado,
						 				"1"=>$reg->dni,
						 				"2"=>$reg->codigo_col,
						 				"3"=>$reg->nom_colegiado,
						 			  "4"=>$reg->ape_paterno . " " . $reg->ape_materno,
						 				"5"=>$reg->telefono,
						 				"6"=>$estado,
						 				"7"=>$acciones . $btnEstado
						 				
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


					case 'listar_exonerados':

						if (!isset($_SESSION["nombre"]))
						{
						  header("Location: ../vistas/login.html");
						}
						else
						{
							if (1==1)
							{

								$sql = "SELECT idColegiado, 
															 codigo_col, 
															 nom_colegiado, 
															 ape_paterno, 
															 ape_materno, 
															 dni, 
															 fec_nac, 
															 foto, 
															 telefono, 
															 email, 
															 lug_nacim, 
															 lug_labores, 
															 info_contacto, 
															 estado_exonerado,
															 estado 
												FROM colegiados
												WHERE estado_exonerado = 1
												ORDER BY idColegiado DESC";

		    				$db = $dbh->prepare($sql);
		    				$db->execute();

						 		$data= Array();

						 		while($reg = $db->fetch(PDO::FETCH_OBJ)){

						 			$estado = ($reg->estado == 1) ? "<span class='badge badge-pill badge-success'>Activo</span>" : "<span class='badge badge-pill badge-danger'>Inactivo</span>";

									// $btnEstado = ($reg->estado == 1 || $reg->estado == 3) ? "<button type='button' class='btn btn-danger btn-sm' onclick='desactivar(".$reg->idColegiado.")'><i class='fa fa-minus'></i></button>" : "<button type='button' class='btn btn-primary btn-sm' onclick='activar(".$reg->idColegiado.")'><i class='fa fa-check'></i></button>";
									$btnEstado = "";

									$acciones = "<button type='button' class='btn btn-warning btn-sm' onclick='editar(".$reg->idColegiado.")'><i class='fa fa-edit mr-1'></i>Editar</button>";

									$correo = ( strlen($reg->email) > 30 ) ? substr($reg->email, 0, 30) . "..." : $reg->email;

						 			$data[]=array(
						 				"0"=>$reg->idColegiado,
						 				"1"=>$reg->dni,
						 				"2"=>$reg->codigo_col,
						 				"3"=>$reg->nom_colegiado,
						 			  "4"=>$reg->ape_paterno . " " . $reg->ape_materno,
						 				"5"=>"<span class='badge badge-pill badge-info'>EXONERADO</span>"
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





					case 'mostrar_colegiado':
						// echo $_POST["idcolegiado"];

						$sqlCol = "SELECT idColegiado, codigo_col, nom_colegiado, ape_paterno, ape_materno, dni, fec_nac, foto, telefono, email, direccion, lug_nacim, lug_labores, info_contacto, estado FROM colegiados WHERE idColegiado = " . $_POST["idcolegiado"];

		    		$db = $dbh->prepare($sqlCol);
		    		$db->execute();

		    		$data = $db->fetch(PDO::FETCH_OBJ);

		    		echo json_encode($data);

					break;


					case 'total_colegiados':
						$sqlConsulta = "SELECT count(*) as total_colegiados FROM colegiados";
						$db = $dbh->prepare($sqlConsulta);
		    		$db->execute();

		    		$data = $db->fetch(PDO::FETCH_OBJ);

		    		echo $data->total_colegiados;

					break;



					case 'listar_rpt_colegiados':

						if (!isset($_SESSION["nombre"]))
						{
						  header("Location: ../vistas/login.html");
						}
						else
						{
							if (1==1)
							{

// idColegiatura,  idColegiado,  fec_colegiatura,  fecha_registro,  desc_colegiatura,  sector_profesional,  idInstitucion,  idEspecialidad,  estado_colegiatura

								$sql = "SELECT * 
												FROM colegiados C INNER JOIN colegiatura CA 
												ON C.idColegiado = CA.idColegiado
												INNER JOIN instituciones I
												ON CA.idInstitucion = I.idInstitucion
												LEFT JOIN distritos D
												ON C.lug_nacim = D.iddistrito
												INNER JOIN provincias P
												ON D.idprovincia = P.idprovincia
												INNER JOIN departamentos DEP
												ON P.iddepartamento = DEP.iddepartamento";

						    $db = $dbh->prepare($sql);
						    $db->execute();

						 		$data= Array();

						 		while($reg = $db->fetch(PDO::FETCH_OBJ)){

						 			$habilidad = ($reg->estado_colegiatura == 1) ? "HABILITADO" : "INHABILITADO" ;

									$fechaColegiatura = date("d/m/Y", strtotime($reg->fec_colegiatura));

						 			$data[]=array(
						 				"0"=>$reg->idColegiado,
						 				"1"=>$reg->dni,
						 				"2"=>$reg->codigo_col,
						 			  "3"=>$reg->nom_colegiado . " ".$reg->ape_paterno . " " . $reg->ape_materno,
						 				"4"=>$fechaColegiatura,
						 				"5"=>$reg->sector_profesional,
						 				"6"=>$habilidad,
						 				"7"=>$reg->institucion,
						 				"8"=>$reg->distritos . " - " . $reg->provincias . " - " . $reg->departamento
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

			}


// ********************* Fuera del switch **********************


			if ($_POST["accion"]=='carga_inicial') {
				$sql = "SELECT idColegiado, codigo_col, nom_colegiado, ape_paterno, ape_materno, dni, fec_nac, foto, telefono, email, lug_nacim, lug_labores, info_contacto, estado FROM colegiados LIMIT 0, 4000";

		    $db = $dbh->prepare($sql);
		    $db->execute();

				$fila = "";

				while($data = $db->fetch(PDO::FETCH_OBJ)):

					$estado = ($data->estado == 1) ? "<span class='badge badge-pill badge-success'>Activo</span>" : "<span class='badge badge-pill badge-danger'>Inactivo</span>";

					$btnEstado = ($data->estado == 1) ? "<button type='button' class='btn btn-danger btn-sm' onclick='desactivar(".$data->idColegiado.")'><i class='fa fa-minus'></i></button>" : "<button type='button' class='btn btn-primary btn-sm' onclick='activar(".$data->idColegiado.")'><i class='fa fa-check'></i></button>";

					// strlen($data->email)
					$correo = ( strlen($data->email) > 50 ) ? substr($data->email, 0, 50) . "..." : $data->email;

					$fila .= "<tr>
					          <td>".$data->dni."</td>
					          <td><a href='javascript:;' onclick='verPagos(".$data->idColegiado.")'>".$data->codigo_col."</a></td>
					          <td>".$data->nom_colegiado."</td>
					          <td>".$data->ape_paterno . " " . $data->ape_materno ."</td>
					          <td>".$data->telefono."</td>
					          <td>".$correo."</td>
					          <td>".$estado."</td>
					          <td>
					          	<button type='button' class='btn btn-warning btn-sm'><i class='fa fa-edit mr-1'></i>Editar</button>
					          	".$btnEstado."
					          </td>
					         </tr>";
			  endwhile;
				echo $fila;
			}


			if ($_POST["accion"]=='carga_busqueda_colegiados') {


				$sql = "SELECT idColegiado, codigo_col, nom_colegiado, ape_paterno, ape_materno, dni, fec_nac, foto, telefono, email, lug_nacim, lug_labores, info_contacto, estado FROM colegiados WHERE estado = 1 AND (ape_paterno like '%".$_POST["dni_codigo"]."%' OR dni = '".$_POST["dni_codigo"]."' OR codigo_col = '".$_POST["dni_codigo"]."')";
				
				// $sql = "SELECT idColegiado, codigo_col, nom_colegiado, ape_paterno, ape_materno, dni, fec_nac, foto, telefono, email, lug_nacim, lug_labores, info_contacto, estado FROM colegiados LIMIT 0, 1500";

		    $db = $dbh->prepare($sql);
		    $db->execute();

				$fila = "";

				while($data = $db->fetch(PDO::FETCH_OBJ)):

					if (!empty($data->dni) || $data->dni !="" ) {
						$estado = ($data->estado == 1) ? "<span class='badge badge-pill badge-success'>Activo</span>" : "<span class='badge badge-pill badge-danger'>Inactivo</span>";

						$btnEstado = ($data->estado == 1) ? "<button type='button' class='btn btn-danger btn-sm' onclick='desactivar(".$data->idColegiado.")'><i class='fa fa-minus'></i></button>" : "<button type='button' class='btn btn-primary btn-sm' onclick='activar(".$data->idColegiado.")'><i class='fa fa-check'></i></button>";

						// strlen($data->email)						$correo = ( strlen($data->email) > 50 ) ? substr($data->email, 0, 50) . "..." : $data->email;
						// $data->codigo_col."--".$data->ape_paterno . " " . $data->ape_materno;

						$fila .= "<tr>
							          <td>".$data->dni."</td>
							          <td><a href='javascript:;'>".$data->codigo_col."</a></td>
							          <td>".$data->nom_colegiado."</td>
							          <td>".$data->ape_paterno . " " . $data->ape_materno ."</td>
							          <td>".$estado."</td>
							          <td>

							          	<button type='button' class='btn btn-info btn-sm' onclick='seleccionarColegiado(".$data->idColegiado.")'><i class='fa fa-check mr-1'></i></button>
							          </td>
						         </tr>";
					} 

			  endwhile;
				echo $fila;
			}

			if ($_POST["accion"] == 'desactivar') {
				
				$sql = "UPDATE `colegiados` SET `estado`=0 WHERE idColegiado=" . $_POST["idCol"];
		    $db = $dbh->prepare($sql);
		    $db->execute();
		    echo "exito";

			}

			if ($_POST["accion"] == 'activar') {
				
				$sql = "UPDATE `colegiados` SET `estado`=1 WHERE idColegiado=" . $_POST["idCol"];
		    $db = $dbh->prepare($sql);
		    $db->execute();
		    echo "exito";

			}


			if($_POST["accion"] == 'guardar'){

						if (!isset($_SESSION["nombre"]))
						{
						  header("Location: ../mod_login/login.php");//Validamos el acceso solo a los usuarios logueados al sistema.
						}
						else
						{

							$valorRandom = random_int(100000, 999999);

							if (!file_exists($_FILES['inputFoto']['tmp_name']) || !is_uploaded_file($_FILES['inputFoto']['tmp_name']))
								{
									$imagen = "sin_imagen_disponible.jpg";
								}else
								{
									$ext = explode(".", $_FILES["inputFoto"]["name"]);
									if ($_FILES['inputFoto']['type'] == "image/jpg" || $_FILES['inputFoto']['type'] == "image/jpeg" || $_FILES['inputFoto']['type'] == "image/png"){
											// $imagen = 'col'.round(microtime(true)) . '.' . end($ext);
											$imagen = 'col' . $_POST["inputDni"] . '.' . end($ext);
											move_uploaded_file($_FILES["inputFoto"]["tmp_name"], "../dist/img/colegiados/" . $imagen);
									}
								}								

						}

				$valorRandom = random_int(100000, 999999);

				$sql = "INSERT INTO `colegiados`(`codigo_col`, 
																				 `nom_colegiado`, 
																				 `ape_paterno`, 
																				 `ape_materno`, 
																				 `dni`, 
																				 `fec_nac`, 
																				 `foto`, 
																				 `telefono`, 
																				 `email`,
																				 `password`, 
																				 `direccion`, 
																				 `lug_nacim`, 
																				 `lug_labores`, 
																				 `info_contacto`, 
																				 `estado`) 
								VALUES (:cod_colegiado,
												:nombres,
											  :apePaterno,
											  :apeMaterno,
											  :dni,
											  :fec_nac,
											  :foto,
											  :telefono,
											  :email,
											  :password,
											  :direccion,
											  :lug_nacim,
											  :lug_labores,
											  :info_contacto,
											  :estado)";

		    $db = $dbh->prepare($sql);
		    $db->bindValue(':cod_colegiado' , strval($valorRandom), 			PDO::PARAM_STR);
		    $db->bindValue(':nombres'			  , $_POST["inputNombres"], 		PDO::PARAM_STR);
		    $db->bindValue(':apePaterno'	  , $_POST["inputApePaterno"], 	PDO::PARAM_STR);
		    $db->bindValue(':apeMaterno'	  , $_POST["inputApeMaterno"], 	PDO::PARAM_STR);
		    $db->bindValue(':dni'					  , $_POST["inputDni"], 				PDO::PARAM_STR);
		    $db->bindValue(':fec_nac'			  , $_POST["inputFecNac"], 			PDO::PARAM_STR);
		    $db->bindValue(':foto'				  , $imagen,	 									PDO::PARAM_STR);
		    $db->bindValue(':telefono'		  , $_POST["inputTelefono"], 		PDO::PARAM_STR);
		    $db->bindValue(':email'				  , $_POST["inputEmail"], 			PDO::PARAM_STR);
		    $db->bindValue(':password'		  , md5($_POST["inputEmail"]), 	PDO::PARAM_STR);
		    $db->bindValue(':direccion'		  , $_POST["inputDireccion"], 	PDO::PARAM_STR);
		    $db->bindValue(':lug_nacim'		  , $_POST["distrito"], 				PDO::PARAM_INT);
		    $db->bindValue(':lug_labores'	  , $_POST["distrito_lab"], 		PDO::PARAM_INT);
		    $db->bindValue(':info_contacto' , 'info', 										PDO::PARAM_STR);
		    $db->bindValue(':estado'				, 1, 													PDO::PARAM_INT);
		    $result = $db->execute();

		    if ($result) {
		    	echo $result;
		    }else {
		    	echo "error";
		    }
 

			}

			if($_POST["accion"] == 'editar'){

					if (!isset($_SESSION["nombre"]))
						{
						  header("Location: ../mod_login/login.php");//Validamos el acceso solo a los usuarios logueados al sistema.
						}
						else
						{


								if (!file_exists($_FILES['inputFoto']['tmp_name']) || !is_uploaded_file($_FILES['inputFoto']['tmp_name']))
									{
										
										if( $_POST["imgFoto"] != "sin_imagen_disponible.jpg" ){

											$imagen = $_POST["imgFoto"];

										}else{

											$imagen = "sin_imagen_disponible.jpg";

										}


									}else
									{
										$ext = explode(".", $_FILES["inputFoto"]["name"]);
										if ($_FILES['inputFoto']['type'] == "image/jpg" || $_FILES['inputFoto']['type'] == "image/jpeg" || $_FILES['inputFoto']['type'] == "image/png"){
												// $imagen = 'col'.round(microtime(true)) . '.' . end($ext);
												$imagen = 'col' . $_POST["inputDni"] . '.' . end($ext);
												move_uploaded_file($_FILES["inputFoto"]["tmp_name"], "../dist/img/colegiados/" . $imagen);
										}
									}		


																		 						 // `foto`						=:foto,
							 	$sqlEdita = "UPDATE `colegiados` SET `nom_colegiado`	=:nom_colegiado,
																				 						 `ape_paterno`		=:apePaterno,
																				 						 `ape_materno`		=:apeMaterno,
																				 						 `dni`						=:dni,
																				 						 `fec_nac`				=:fec_nac,
																				 						 `foto`						=:foto,
																				 						 `telefono`				=:telefono,
																				 						 `email`					=:email,
																				 						 `direccion`			=:direccion,
																				 						 `lug_nacim`			=:lug_nacim,
																				 						 `lug_labores`		=:lug_labores,
																				 						 `info_contacto`	=:info_contacto,
																				 						 `estado`					=:estado 
															WHERE `idColegiado` = " . $_POST["idcolegiado"];

							  $db = $dbh->prepare($sqlEdita);
							  $db->bindValue(':nom_colegiado' , $_POST["inputNombres"], 		PDO::PARAM_STR);
							  $db->bindValue(':apePaterno'	  , $_POST["inputApePaterno"], 	PDO::PARAM_STR);
							  $db->bindValue(':apeMaterno'	  , $_POST["inputApeMaterno"], 	PDO::PARAM_STR);
							  $db->bindValue(':dni'					  , $_POST["inputDni"], 				PDO::PARAM_STR);
							  $db->bindValue(':fec_nac'			  , $_POST["inputFecNac"], 			PDO::PARAM_STR);
							  $db->bindValue(':foto'				  , $imagen,	 									PDO::PARAM_STR);
							  $db->bindValue(':telefono'		  , $_POST["inputTelefono"], 		PDO::PARAM_STR);
							  $db->bindValue(':email'				  , $_POST["inputEmail"], 			PDO::PARAM_STR);
							  $db->bindValue(':direccion'		  , $_POST["inputDireccion"], 	PDO::PARAM_STR);
							  $db->bindValue(':lug_nacim'		  , ($_POST["distrito"]==0) ? null : $_POST["distrito"], 				PDO::PARAM_INT);
							  $db->bindValue(':lug_labores'	  , ($_POST["distrito_lab"]==0) ? null : $_POST["distrito_lab"], 		PDO::PARAM_INT);
							  $db->bindValue(':info_contacto' , 'info', 										PDO::PARAM_STR);
							  $db->bindValue(':estado'				, 1, 													PDO::PARAM_INT);
							  $result = $db->execute();

						    if ($result) {
						    	echo $result;
						    }else {
						    	echo "error".$result;
						    }

						}


			}

			if ($_POST["accion"] == 'restablecerPass') {

				$sql = "SELECT idColegiado, codigo_col FROM colegiados WHERE idColegiado = " . $_POST["idCol"];
		    $db = $dbh->prepare($sql);
		    $db->execute();
				$dataCole = $db->fetch(PDO::FETCH_OBJ);
				$codigo_colegiado = $dataCole->codigo_col;
				
				// $sqlUpdPass = "UPDATE `colegiados` SET `estado`=1 WHERE password=" . $_POST["idCol"];

				$sqlUpdPass = "UPDATE `colegiados` SET `password` = MD5('".$codigo_colegiado."') WHERE `colegiados`.`idColegiado` = " . $_POST["idCol"];
		    $db2 = $dbh->prepare($sqlUpdPass);
		    $db2->execute();
		    echo "exito";

			}			

?>