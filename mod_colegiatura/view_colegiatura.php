<?php 
  SESSION_START();
  include_once "../conf/conf.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro de pagos - <?php echo PROY_TITULO; ?></title>

  <?php include_once "../head.php"; ?>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
<!--   <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php //echo ENLACE_WEB; ?>dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->
  
  <?php include '../mod_menu/menu_dashboard_h.php'; ?>

  <!-- Main Sidebar Container -->
  <!-- <aside class="main-sidebar sidebar-blue-primary elevation-4"> -->
  
    <?php include '../mod_menu/menu_dashboard_v.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registrar colegiatura</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../administrador/">Inicio</a></li>
              <li class="breadcrumb-item active">Registrar colegiatura</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  Datos de la colegiatura
                </h3>
              </div>

              <div class="card-body">
                
                <form name="frmRegColegiatura" id="frmRegColegiatura" enctype="multipart/form-data" method="POST">
                  <div class="form-row">
                    <div class="col-md-4">
                      <label for="colegiado">Seleccionar colegiado:</label>
                      <input type="text" class="form-control" id="colegiado" name="colegiado" placeholder="Colegiado" readonly="true">
                      <input type="hidden" name="idcolegiado" id="idcolegiado">
                    </div>

                    <div>
                      <br>
                      <button type="button" class="btn btn-primary btn-sm form-control px-3 mt-2" data-toggle="modal" data-target="#exampleModalLong">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>

                    <div class="col-md-2 ml-3">
                      <label for="txtCodigoColegiado">CBP Asignado:</label>
                      <input type="text" class="form-control" name="txtCodigoColegiado" id="txtCodigoColegiado" required>
                    </div>

<!-- 
??? Fecha de Ingreso
??? Fecha de Registro
??? Sector Profesional
??? Universidad/Instituto
??? Especialidad
??? Documentos adjuntos
??? Regi??n
??? Documento de Identidad
??? Concepto de Pagos 
-->


                    <div class="col-md-2">
                      <label for="fecha_pago_colegiatura">Fecha de colegiatura:</label>
                      <input type="date" class="form-control" name="fecha_pago_colegiatura" id="fecha_pago_colegiatura" required>
                    </div>


                    <div class="col-md-2">
                      <label for="optSector">Sector profesional:</label>
                      <select class="form-control" name="optSector" id="optSector" required>
                        <option value="0">Selecciona sector</option>
                        <option value="publico">Sector p??blico</option>
                        <option value="privado">Sector privado</option>
                      </select>                          
                    </div>
                  </div>


                  <br>
                  <div class="form-row pb-2" style="border-bottom: 1px solid #CECECE;">
                    <div class="col-md-12">
                      <label>Pre grado</label>
                    </div>
                  </div>

                  <div class="form-row mt-3">
                    <div class="col-md-4">
                      <label for="optUniversidad">Universidad:</label>
                      <select class="form-control" name="optUniversidad" id="optUniversidad" required>
                        <option value="0">Universidad Nacional Mayor de San Marcos </option>
                        <option value="1">Universidad Nacional Intercultural Fabiola Salazar Legu??a</option>
                        <option value="2">Universidad Nacional Aut??noma de Alto Amazonas </option>
                        <option value="3">Universidad Peruana Cayetano Heredia </option>
                        <option value="4">Universidad Ricardo Palma</option>
                        <option value="5">Universidad Cient??fica del Per?? </option>
                        <option value="6">Universidad Peruana de Ciencias Aplicadas</option>
                        <option value="7">Universidad Cient??fica del Sur </option>
                        <option value="8">Universidad Nacional de San Crist??bal de Huamanga</option>
                        <option value="9">Universidad Nacional de San Antonio Abad del Cusco</option>
                        <option value="10">Universidad Nacional de Trujillo </option>
                        <option value="11">Universidad Nacional de San Agust??n de Arequipa</option>
                        <option value="12">Universidad Nacional Agraria La Molina</option>
                        <option value="13">Universidad Nacional San Luis Gonzaga</option>
                        <option value="14">Universidad Nacional de la Amazon??a Peruana </option>
                        <option value="15">Universidad Nacional del Altiplano</option>
                        <option value="16">Universidad Nacional de Piura</option>
                        <option value="17">Universidad Nacional de Cajamarca</option>
                        <option value="18">Universidad Nacional Federico Villarreal </option>
                        <option value="19">Universidad Nacional Jos?? Faustino S??nchez Carri??n</option>
                        <option value="20">Universidad Nacional Pedro Ruiz Gallo</option>
                        <option value="21">Universidad Nacional Jorge Basadre Grohmann</option>
                        <option value="22">Universidad Nacional del Santa </option>
                        <option value="23">Otro (abrir escritura)</option>
                      </select>
                    </div>

                    <div class="col-md-3">
                      <label for="optTitulo">T??tulo</label>
                      <select class="form-control" name="optTitulo" id="optTitulo" required>
                        <option value="1">Bi??logo (a) Microbi??logo (a) Parasit??logo (a)</option>
                        <option value="2">Bi??logo (a) Gen??tista Biotecn??logo (a)</option>
                        <option value="3">Bi??logo (a) con menci??n en hidrobiolog??a y pesqueria</option>
                        <option value="4">Bi??logo (a) con menci??n en zoolog??a</option>
                        <option value="5">Bi??logo (a) con menci??n en bot??nica</option>
                        <option value="6">Bi??logo (a) con menci??n en biolog??a celular y gen??tica</option>
                        <option value="7">Bi??logo (a) con menci??n en gen??tica</option>
                        <option value="8">Bi??logo (a) con menci??n en microbiolog??a y parasitolog??a</option>
                        <option value="9">Bi??logo (a), Especialidad: Microbiolog??a</option>
                        <option value="10">Bi??logo (a), Especialidad: Biotecnolog??a</option>
                        <option value="11">Bi??logo (a), Especialidad: Ecolog??a y recursos naturales</option>
                        <option value="12">Bi??logo (a)</option>
                        <option value="13">Bi??logo (a) Microbi??logo (a)</option>
                        <option value="14">Bi??logo (a) Pesquero (a)</option>
                        <option value="15">Bi??logo (a) Acuicultor (a)</option>
                        <option value="16">Licenciado (a) en Biolog??a</option>
                        <option value="17">Licenciado (a) en Biolog??a: Microbiolog??a y Laboratorio Cl??nico</option>
                        <option value="18">Licenciado (a) en Biolog??a: Ecolog??a</option>
                        <option value="19">Licenciado (a) en Biolog??a: Pesquer??a</option>
                        <option value="20">Bi??logo (a) - Biotecn??logo (a)</option>
                        <option value="21">Bi??logo (a) con menci??n en Biotecnolog??a</option>
                        <option value="22">Licenciado (a) en Biolog??a - Microbiolog??a - Parasitolog??a</option>
                        <option value="23">Licenciado (a) en Biolog??a ??? Bot??nica</option>
                        <option value="24">Licenciado (a) en Biolog??a ??? Pesquer??a</option>
                        <option value="25">Bi??logo (a) Microbi??logo (a)</option>
                        <option value="26">Biotecn??logo (a)</option>
                        <option value="27">Bi??logo (a) Acuicultor (a)</option>
                        <option value="28">Bi??logo (a) Acu??cola</option>
                        <option value="29">Bi??logo (a) con menci??n en Biotecnolog??a y Biomedicina</option>
                        <option value="30">Bi??logo (a) Marino (a)</option>
                        <option value="31">Otro (abrir Escritura)</option>
                      </select>
                    </div>

                  </div>


                  <br>
                  <div class="form-row pb-2" style="border-bottom: 1px solid #CECECE;">
                    <div class="col-md-12">
                      <label>Post grado</label>
                    </div>
                  </div>

                  <div class="form-row mt-3">

                    <div class="col-md-4">
                      <label for="optUniversidadPost">Universidad:</label>
                      <select class="form-control" name="optUniversidadPost" id="optUniversidadPost" required>
                        <option value="0">Universidad Nacional Mayor de San Marcos </option>
                        <option value="1">Universidad Nacional Intercultural Fabiola Salazar Legu??a</option>
                        <option value="2">Universidad Nacional Aut??noma de Alto Amazonas </option>
                        <option value="3">Universidad Peruana Cayetano Heredia </option>
                        <option value="4">Universidad Ricardo Palma</option>
                        <option value="5">Universidad Cient??fica del Per?? </option>
                        <option value="6">Universidad Peruana de Ciencias Aplicadas</option>
                        <option value="7">Universidad Cient??fica del Sur </option>
                        <option value="8">Universidad Nacional de San Crist??bal de Huamanga</option>
                        <option value="9">Universidad Nacional de San Antonio Abad del Cusco</option>
                        <option value="10">Universidad Nacional de Trujillo </option>
                        <option value="11">Universidad Nacional de San Agust??n de Arequipa</option>
                        <option value="12">Universidad Nacional Agraria La Molina</option>
                        <option value="13">Universidad Nacional San Luis Gonzaga</option>
                        <option value="14">Universidad Nacional de la Amazon??a Peruana </option>
                        <option value="15">Universidad Nacional del Altiplano</option>
                        <option value="16">Universidad Nacional de Piura</option>
                        <option value="17">Universidad Nacional de Cajamarca</option>
                        <option value="18">Universidad Nacional Federico Villarreal </option>
                        <option value="19">Universidad Nacional Jos?? Faustino S??nchez Carri??n</option>
                        <option value="20">Universidad Nacional Pedro Ruiz Gallo</option>
                        <option value="21">Universidad Nacional Jorge Basadre Grohmann</option>
                        <option value="22">Universidad Nacional del Santa </option>
                        <option value="23">Otro (abrir escritura)</option>
                      </select>
                    </div>

                    <div class="col-md-3">
                      <label for="titulo_post">T??tulo:</label>
                      <select class="form-control" name="titulo_post" id="titulo_post" required>
                        <option value="1">Bi??logo (a) Microbi??logo (a) Parasit??logo (a)</option>
                        <option value="2">Bi??logo (a) Gen??tista Biotecn??logo (a)</option>
                        <option value="3">Bi??logo (a) con menci??n en hidrobiolog??a y pesqueria</option>
                        <option value="4">Bi??logo (a) con menci??n en zoolog??a</option>
                        <option value="5">Bi??logo (a) con menci??n en bot??nica</option>
                        <option value="6">Bi??logo (a) con menci??n en biolog??a celular y gen??tica</option>
                        <option value="7">Bi??logo (a) con menci??n en gen??tica</option>
                        <option value="8">Bi??logo (a) con menci??n en microbiolog??a y parasitolog??a</option>
                        <option value="9">Bi??logo (a), Especialidad: Microbiolog??a</option>
                        <option value="10">Bi??logo (a), Especialidad: Biotecnolog??a</option>
                        <option value="11">Bi??logo (a), Especialidad: Ecolog??a y recursos naturales</option>
                        <option value="12">Bi??logo (a)</option>
                        <option value="13">Bi??logo (a) Microbi??logo (a)</option>
                        <option value="14">Bi??logo (a) Pesquero (a)</option>
                        <option value="15">Bi??logo (a) Acuicultor (a)</option>
                        <option value="16">Licenciado (a) en Biolog??a</option>
                        <option value="17">Licenciado (a) en Biolog??a: Microbiolog??a y Laboratorio Cl??nico</option>
                        <option value="18">Licenciado (a) en Biolog??a: Ecolog??a</option>
                        <option value="19">Licenciado (a) en Biolog??a: Pesquer??a</option>
                        <option value="20">Bi??logo (a) - Biotecn??logo (a)</option>
                        <option value="21">Bi??logo (a) con menci??n en Biotecnolog??a</option>
                        <option value="22">Licenciado (a) en Biolog??a - Microbiolog??a - Parasitolog??a</option>
                        <option value="23">Licenciado (a) en Biolog??a ??? Bot??nica</option>
                        <option value="24">Licenciado (a) en Biolog??a ??? Pesquer??a</option>
                        <option value="25">Bi??logo (a) Microbi??logo (a)</option>
                        <option value="26">Biotecn??logo (a)</option>
                        <option value="27">Bi??logo (a) Acuicultor (a)</option>
                        <option value="28">Bi??logo (a) Acu??cola</option>
                        <option value="29">Bi??logo (a) con menci??n en Biotecnolog??a y Biomedicina</option>
                        <option value="30">Bi??logo (a) Marino (a)</option>
                        <option value="31">Otro (abrir Escritura)</option>
                      </select>
                    </div>

                    <div class="col-md-3">
                      <label for="rne">RNE:</label>
                      <input type="text" class="form-control" id="rne" name="rne" placeholder="RNE" required>
                    </div>
                  </div>


                  <div class="form-row">
                    <div class="col-md-2">
                      <br>
                      <button type="submit" class="btn btn-primary mt-2 px-4">
                        GUARDAR
                      </button>
                    </div>
                  </div>



                  <div class="form-group">
                    <div class="form-check">


                    </div>
                  </div>

                </form>

              </div>              

            </div>


<!--             <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  Pagos del colegiado
                </h3>
              </div>


              <div class="card-body">


              </div>
            </div>
 -->

        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="#">Grupo Alcedo</a>.</strong>
    Todos los derechos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->




                      <!-- Modal -->
                      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <!-- <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document"> -->
                        <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">B??squeda de colegiados</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">

                              <form>
                                <div class="form-row">
                                  <div class="col-md-4">
                                    <label for="validationServer01">Seleccionar colegiado:</label>
                                    <input type="text" name="dni_codigo" id="dni_codigo" class="form-control" placeholder="DNI o CODIGO o APELLIDOS">
                                  </div>
                                  <div class="col-md-4">
                                    <label for="validationServer01">&nbsp;</label><br>
                                    <button type="button" class="btn btn-success btn-xl" onclick="buscarColegiado()">Buscar</button>
                                  </div>
                                </div>
                              </form>

                              <div class="row mt-4">
                                <div class="col-md-12">
                                  <table id="tabla_busca_colegiados_id" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th>DNI</th>
                                      <th>CODIGO</th>
                                      <th>Nombres</th>
                                      <th>Apellidos</th>
                                      <th>Estado</th>
                                      <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody id="lista_colegiados_busca">
                                      <tr><td colspan="6">
                                        <div id="content"></div>
                                      </td></tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>

                            </div>
                            <div class="modal-footer">
                              <button type="button" id="cerrar" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>


  <?php include_once "../foot.php"; ?>

<script type="text/javascript">

  $( document ).ready(function() {
    llenarComboEspecialidad();

  });


  $("#frmRegColegiatura").on("submit",function(e){
    e.preventDefault();
    var formData = new FormData($("#frmRegColegiatura")[0]);

    if($("#colegiado").val() != '' && $("#idcolegiado").val() !=''){

      $.ajax({
        url: "<?php echo ENLACE_WEB?>mod_colegiatura/controller_colegiatura.php?op=registrar_colegiatura",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

          success: function(datos)
          {                    
            // bootbox.alert(datos);           
            // mostrarform(false);
            // tabla.ajax.reload();
            console.log(datos);
            if( datos == 'exito' ){
              // alert("Pago de servicios realizado con ??xito");

              Swal.fire(
                'Exito!',
                'Colegiatura registrada correctamente!',
                'success'
              )              
            }
          }
      });

    }else{
      alert("Por favor, ingrese datos v??lidos");
    }


  });


  $( "#btnSalir" ).click(function() {
    if (confirm("Esta seguro de salir del sistema")) {
      location.href="<?php echo ENLACE_WEB;?>mod_login/logout.php";
    }else{
      return false;
    }
  });


  function seleccionarColegiado(idColegiado) {
    
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'success',
        title: 'Agregado correctamente'
      })

      $.ajax({
        url: '<?php echo ENLACE_WEB?>mod_pagos/controller_pagos.php',
        type: 'POST',
        data: {accion: 'carga_datos_cole', idColegiado: idColegiado},
      })
      .done(function(data) {
        var resp = JSON.parse(data);

        // $("#colegiado").val(data);

        console.log(resp.idcolegiado);
        console.log(resp.datosColegiado);

        $("#idcolegiado").val(resp.idcolegiado);
        $("#colegiado").val(resp.datosColegiado);
        $("#lista_colegiados_busca").empty();
        $("#dni_codigo").val('');
        $("#cerrar").click();
        
      })
      .fail(function() {
        console.log("error");
      })

  }


  function llenarComboEspecialidad() {
    $.post('<?php echo ENLACE_WEB?>mod_colegiatura/controller_colegiatura.php?op=listar_especialidades',function(r){
      $("#optEspecialidad").html(r);
    });
  }


  function buscarColegiado() {

    $('#content').html('<div class="loading text-center" style="text-align: center;"><img src="../dist/img/loading.gif" alt="loading" width="5%" /><br/>Un momento, por favor...</div>');

    $.ajax({
      url: '<?php echo ENLACE_WEB?>mod_colegiados/controller_colegiados.php',
      type: 'POST',
      data: {accion: 'colegiados_sin_colegiatura', dni_codigo: $("#dni_codigo").val()},
    })
    .done(function(data) {
      // console.log(data);
      if(data != ''){
        $('#lista_colegiados_busca').empty().html(data);  
      }else{
        $('#lista_colegiados_busca').empty().html('<tr><td colspan="6" class="text-center">Vacio</td></tr>');
      }
      
    })
    .fail(function() {
      console.log("error");
    })

  }






      // function cargaListadoColegios() {
      //   $.ajax({
      //     url: 'controller_colegiados.php',
      //     type: 'POST',
      //     data: {accion: 'carga_inicial'},
      //   })
      //   .done(function(data) {
      //     $('#lista_colegiados').empty().html(data);
      //   })
      //   .fail(function() {
      //     console.log("error");
      //   })
      // }

      // cargaListadoColegios();

      // $.get('controller_colegiados.php', function(data) {
      //   $('#lista_colegiados').empty().html(data);
      // });

      function verPagos(idColegiado) {
        // console.log(idColegiado);
        location.href="<?php echo ENLACE_WEB;?>mod_colegiados/view_pagos_colegiados.php?idcol=" + idColegiado;
      }

</script>

</body>
</html>
