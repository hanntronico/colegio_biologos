USE bdcolbiologos;

SELECT C.idColegiado, 
			 C.codigo_col, 
			 C.nom_colegiado, 
			 C.ape_paterno, 
			 C.ape_materno, 
			 C.dni, 
			 C.fec_nac, 
			 C.foto, 
			 C.telefono, 
			 C.email, 
			 C.direccion, 
			 C.lug_nacim, 
			 C.lug_labores, 
			 C.info_contacto, 
			 C.estado_exonerado, 
			 C.estado,
			 D.iddistrito,
			 P.idprovincia,
			 DEP.iddepartamento
FROM colegiados C LEFT JOIN distritos D
ON C.lug_nacim = D.iddistrito
LEFT JOIN provincias P
ON D.idprovincia = P.idprovincia
LEFT JOIN departamentos DEP
ON P.iddepartamento = DEP.iddepartamento
WHERE idColegiado = 4908;