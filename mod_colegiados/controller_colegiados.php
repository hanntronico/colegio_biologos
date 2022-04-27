<?php 
			include_once "../conf/conf.php";

			if ($_POST["accion"]=='carga_inicial') {
				$sql = "SELECT idColegiado, codigo_col, nom_colegiado, ape_paterno, ape_materno, dni, fec_nac, foto, telefono, email, lug_nacim, lug_labores, info_contacto, estado FROM colegiados";

		    $db = $dbh->prepare($sql);
		    $db->execute();

				$fila = "";

				while($data = $db->fetch(PDO::FETCH_OBJ)):

					$estado = ($data->estado == 1) ? "<span class='badge badge-pill badge-success'>Activo</span>" : "<span class='badge badge-pill badge-danger'>Inactivo</span>";

					$btnEstado = ($data->estado == 1) ? "<button type='button' class='btn btn-danger btn-sm' onclick='desactivar(".$data->idColegiado.")'><i class='fa fa-minus'></i></button>" : "<button type='button' class='btn btn-primary btn-sm' onclick='activar(".$data->idColegiado.")'><i class='fa fa-check'></i></button>";

					$fila .= "<tr>
					          <td>".$data->dni."</td>
					          <td><a href='javascript:;' onclick='verPagos(".$data->idColegiado.")'>".$data->codigo_col."</a></td>
					          <td>".$data->nom_colegiado."</td>
					          <td>".$data->ape_paterno . " " . $data->ape_materno ."</td>
					          <td>".$data->telefono."</td>
					          <td>".$data->email."</td>
					          <td>".$estado."</td>
					          <td>
					          	<button type='button' class='btn btn-warning btn-sm'><i class='fa fa-edit mr-1'></i>Editar</button>
					          	".$btnEstado."
					          </td>
					         </tr>";
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
				// echo "crea con exito " . 
				// $_POST["inputNombres"] . 
				// $_POST["inputApePaterno"] . 
				// $_POST["inputApeMaterno"];

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
											  :dirección,
											  :lug_nacim,
											  :lug_labores,
											  :info_contacto,
											  :estado)";

								echo random_int(100000, 999999);


		    $db = $dbh->prepare($sql);
		    $dbP->bindValue(':cod_colegiado', random_int(100000, 999999), PDO::PARAM_STR);
		    $dbP->bindValue(':nombres'			, $_POST["inputNombres"], PDO::PARAM_STR);
		    $dbP->bindValue(':apePaterno'		, $_POST["inputApePaterno"], PDO::PARAM_STR);
		    $dbP->bindValue(':apeMaterno'		, $_POST["inputApeMaterno"], PDO::PARAM_STR);
		    $dbP->bindValue(':dni'					, $_POST["inputDni"], PDO::PARAM_STR);
		    $dbP->bindValue(':fec_nac'			, $_POST["inputFecNac"], PDO::PARAM_STR);
		    $dbP->bindValue(':foto'					, , PDO::PARAM_STR);
		    $dbP->bindValue(':telefono'			, $_POST["inputTelefono"], PDO::PARAM_STR);
		    $dbP->bindValue(':email'				, $_POST["inputEmail"], PDO::PARAM_STR);
		    $dbP->bindValue(':password'			, , PDO::PARAM_STR);
		    $dbP->bindValue(':dirección'		, , PDO::PARAM_STR);
		    $dbP->bindValue(':lug_nacim'		, , PDO::PARAM_INT);
		    $dbP->bindValue(':lug_labores'	, , PDO::PARAM_INT);
		    $dbP->bindValue(':info_contacto', , PDO::PARAM_STR);
		    $dbP->bindValue(':estado'				, 1, PDO::PARAM_INT);









		    $db->execute();



      //       $sqlP = "INSERT into  fi_solicitud_revision
      //       (fk_detalle_solcitud
      //         , cant_revision
      //         , fecha_cambio ) values
      //         ( :rowid
      //         , :cantidad
      //         , NOW())";
      //       $dbP = $this->dbh->prepare($sqlP);
      //       $dbP->bindValue(':rowid', $cambio["id"], PDO::PARAM_INT);
      //       $dbP->bindValue(':cantidad', $cambio["cantidad"], PDO::PARAM_STR);
      //       $result = $dbP->execute();



		    // echo "exito";





			}

?>