<?php 
  SESSION_START();
  include_once "../conf/conf.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Listado de Colegiados - <?php echo PROY_TITULO; ?></title>

  <?php include_once "../head.php"; ?>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

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
            <h1 class="m-0">Registro de Colegiados</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Nuevo colegiado</li>
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
                <h3 class="card-title">Registro de Nuevo Colegiado</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <form id="frmColegiado" enctype="multipart/form-data">

                  <div class="row">
                    <div class="col-md-2" >
                      <div style="margin: 0px auto; text-align: center;">
                        <!-- <h5>FOTO</h5> -->
                        <img src="<?php echo ENLACE_WEB;?>dist/img/sin_imagen_disponible.jpg" style="border: 3px solid #E8E8E8; width: 120px; height: 120px; border-radius: 50%;">
                      </div>
                      <!-- <button type="button" class="btn btn-secondary btn-sm mt-2">Seleccionar imagen</button> -->
                      <!-- <input type="file" name="foto" id="foto"> -->
                      <input type='file' class='input-file' id="input_file" name="inputFoto">
                      <button class='input-btn' id='input_btn' style="width: 90%;">Seleccionar imagen</button>
                      
                    </div>

                    <div class="col-md-10">

                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputNombres">Nombres</label>
                          <input type="text" class="form-control" name="inputNombres" id="inputNombres" placeholder="Nombres">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputApePaterno">Apellido paterno</label>
                          <input type="text" class="form-control" name="inputApePaterno" id="inputApePaterno" placeholder="Apellido Paterno">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputApeMaterno">Apellido materno</label>
                          <input type="text" class="form-control" name="inputApeMaterno" id="inputApeMaterno" placeholder="Apellido Materno">
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-2">
                          <label for="inputDni">DNI</label>
                          <input type="text" class="form-control" maxlength="8" name="inputDni" id="inputDni" placeholder="Número de DNI">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputFecNac">Fecha de Nacim.</label>
                          <input type="date" class="form-control" name="inputFecNac" id="inputFecNac">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputTelefono">Teléfono</label>
                          <input type="text" class="form-control" name="inputTelefono" id="inputTelefono" placeholder="Teléfono">
                        </div>
                        <div class="form-group col-md-5">
                          <label for="inputEmail">Email</label>
                          <input type="text" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email">
                        </div>
                        <input type="hidden" name="foto" id="foto" value="foto del colegiado">
                      </div>
                      
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputDireccion">Dirección</label>
                          <input type="text" class="form-control" name="inputDireccion" id="inputDireccion" placeholder="Dirección">
                        </div>
                        <div class="form-group col-md-6">

                        </div>
                      </div>

                    </div>
                  </div>




<!--       $sql = "SELECT idColegiado, nom_colegiado, ape_paterno, ape_materno, dni, fec_nac, foto, telefono, email, lug_nacim, lug_labores, info_contacto, estado FROM colegiados"; -->

<!--                   <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputPassword4">Password</label>
                      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputAddress">Address</label>
                      <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                  </div> -->

<!--                   <div class="form-group">
                    <label for="inputAddress2">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                  </div> -->

                  <hr>
                  <label>Lugar de Nacimiento</label>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="departamento">Departamento</label>
                      <select id="departamento" class="form-control" onchange="cargaProvin(this.value)">
                          <option value="0">Seleccione departamento</option>
                      </select>
                    </div>                    
                    <div class="form-group col-md-4">
                      <label for="provincia">Provincia</label>
                      <select id="provincia" class="form-control" onchange="cargaDistrito(this.value)">
                        <option value="0">Seleccione provincia</option>
                      </select>
                    </div>                    
                    <div class="form-group col-md-4">
                      <label for="distrito">Distrito</label>
                      <select name="distrito" id="distrito" class="form-control">
                        <option value="0">Seleccione distrito</option>
                      </select>
                    </div>                    
                  </div>


                  <hr>
                  <label>Lugar de Labores</label>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="departamento_lab">Departamento</label>
                      <select id="departamento_lab" class="form-control" onchange="cargaProvinLab(this.value)">
                          <option value="0">Seleccione departamento</option>
                      </select>
                    </div>                    
                    <div class="form-group col-md-4">
                      <label for="provincia_lab">Provincia</label>
                      <select id="provincia_lab" class="form-control" onchange="cargaDistritoLab(this.value)">
                        <option value="0">Seleccione provincia</option>
                      </select>
                    </div>                    
                    <div class="form-group col-md-4">
                      <label for="distrito_lab">Distrito</label>
                      <select name="distrito_lab" id="distrito_lab" class="form-control">
                        <option value="0">Seleccione distrito</option>
                      </select>
                    </div>                    
                  </div>

                  <input type="hidden" name="accion" value="guardar">
<!--                   <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputCity">City</label>
                      <input type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputState">State</label>
                      <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputZip">Zip</label>
                      <input type="text" class="form-control" id="inputZip">
                    </div>
                  </div> -->
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="checkActivo">
                      <label class="form-check-label" for="checkActivo">
                        Activo
                      </label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success btn-lg">GUARDAR</button>
                </form>

              </div>
              <!-- /.card-body -->
            </div>

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

  <?php include_once "../foot.php"; ?>

<script type="text/javascript">

  $( "#input_btn" ).click(function(event) {
    event.preventDefault();
    $( "#input_file" ).click();
  });


  
  $( "#btnSalir" ).click(function() {
    if (confirm("Esta seguro de salir del sistema")) {
      location.href="<?php echo ENLACE_WEB;?>mod_login/logout.php";
    }else{
      return false;
    }
  });
  
  // "paging": true,
  // "processing": true,
  // "serverSide": true,
  // "ajax": {
  //     "url" : "controlador_listado_tablas.php",
  //     "type": "GET"
  // },
  // "language": {
  //   url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
  // },
  // // "dom": 'Bfrtip',
  // "dom": 'Blfrtip',
  // "buttons": [
  //     'csv', 'excel', 'pdf', 'print'
  // ]

  $( document ).ready(function() {
    $.get('controller_departamentos.php', function(data) {
      $('#departamento').empty().html(data);
    });

    $.get('controller_departamentos.php', function(data) {
      $('#departamento_lab').empty().html(data);
    });

  });

  function cargaProvin(arg) {
    $.ajax({
      url: '<?php echo ENLACE_WEB;?>mod_colegiados/controller_provincia.php',
      type: 'POST',
      data: {departamento: arg},
    })
    .done(function(data) {
      // console.log('carga provincia: ' + data);
      $('#provincia').empty().html(data);
    })
    .fail(function() {
      console.log("error");
    });
  }

  function cargaProvinLab(arg) {
    $.ajax({
      url: '<?php echo ENLACE_WEB;?>mod_colegiados/controller_provincia.php',
      type: 'POST',
      data: {departamento: arg},
    })
    .done(function(data) {
      // console.log('carga provincia: ' + data);
      $('#provincia_lab').empty().html(data);
    })
    .fail(function() {
      console.log("error");
    });
  }

  function cargaDistrito(arg) {
    $.ajax({
      url: '<?php echo ENLACE_WEB;?>mod_colegiados/controller_distrito.php',
      type: 'POST',
      data: {provincia: arg},
    })
    .done(function(data) {
      // console.log('carga provincia: ' + data);
      $('#distrito').empty().html(data);
    })
    .fail(function() {
      console.log("error");
    });
  }

  function cargaDistritoLab(arg) {
    $.ajax({
      url: '<?php echo ENLACE_WEB;?>mod_colegiados/controller_distrito.php',
      type: 'POST',
      data: {provincia: arg},
    })
    .done(function(data) {
      // console.log('carga provincia: ' + data);
      $('#distrito_lab').empty().html(data);
    })
    .fail(function() {
      console.log("error");
    });
  }


  $("#frmColegiado").on("submit",function(e)
    {
      // if($("#clave").val() == $("#clave2").val() ){
          // console.log('guardar y editar'); 
        guardaryeditar(e);
        // return true;
      // }else{
      //   alert("Por favor verifique se confirmó bien su clave");
      //   return false;
      // }
  });

  function guardaryeditar(e) {
  
    // var datosForm = $('#frmColegiado').serialize();
    // // var datosForm = $('#frmColegiado').serializeArray();

    // // console.log(datosForm);

    // $.ajax({
    //   url: 'controller_colegiados.php',
    //   type: 'POST',
    //   data: datosForm,
    // })
    // .done(function(data) {
    //   console.log("success data: " + data);
    //   // location.href="<?php //echo ENLACE_WEB;?>mod_colegiados/view_pagos_colegiados.php?idcol=" + idColegiado;
    // })
    // .fail(function() {
    //   console.log("error");
    // })  


    e.preventDefault();

    var formData = new FormData($("#frmColegiado")[0]);

    $.ajax({
        url: "controller_colegiados.php",
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
          location.href="<?php echo ENLACE_WEB;?>mod_colegiados/view_colegiados.php";
        }

    });


  
  }






  // $.get('controller_colegiados.php', function(data) {
  //   $('#lista_colegiados').empty().html(data);
  // });



    // $.ajax({
    //   url: '/path/to/file',
    //   type: 'default GET (Other values: POST)',
    //   dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
    //   data: {param1: 'value1'},
    // })
    // .done(function() {
    //   console.log("success");
    // })
    // .fail(function() {
    //   console.log("error");
    // })
    // .always(function() {
    //   console.log("complete");
    // });


  // $(function () {
  //   $("#example1").DataTable({
  //     "responsive": true, "lengthChange": false, "autoWidth": false,
  //     "buttons": ["csv", "excel", "pdf", "print"]
  //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  //   $('#lista_colegiados_id').DataTable({
  //     "paging": true,
  //     "lengthChange": false,
  //     "searching": true,
  //     "ordering": true,
  //     "info": true,
  //     "autoWidth": false,
  //     "responsive": true,
  //   });
  // });

</script>

</body>
</html>
