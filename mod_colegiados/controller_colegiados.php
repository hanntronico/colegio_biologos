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


?>