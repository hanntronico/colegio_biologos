<?php 
  ob_start();
  SESSION_START();
  include_once "../conf/conf.php";

  if (!isset($_SESSION["nombre"]))
  {
    header("Location: ../index.php");
  }
  else
  {

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro de pagos - <?php echo PROY_TITULO; ?></title>

  <?php include_once "../head.php"; ?>

  <style type="text/css" media="screen">
    .hanncolor{
      background-color: #FFC9C9;
      /*color: #ff0000;*/
    }
  </style>

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
            <h1 class="m-0">Gestión de deudas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../administrador/">Inicio</a></li>
              <li class="breadcrumb-item active">Listado de colegiados</li>
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
                  Ingrese los datos de pago
                </h3>
              </div>

              <div class="card-body">
                
                <form>
                  <div class="form-row">
                    <div class="col-md-4">
                      <label for="validationServer01">Seleccionar colegiado:</label>
                      <input type="text" class="form-control" id="colegiado" name="colegiado" placeholder="Colegiado" readonly="true">
                      <input type="hidden" name="idcolegiado" id="idcolegiado" value="">
                    </div>

                    <div>
                      <br>
                      <button type="button" class="btn btn-primary btn-sm form-control px-3 mt-2" data-toggle="modal" data-target="#exampleModalLong">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>

                    <div class="col-md-2">
                      <br>
<!--                       <label for="validationServer02">Nro </label>
                      <input type="text" class="form-control" id="validationServer02" placeholder="Last name" required> -->
                      <button type="button" class="btn btn-primary mt-2" style="margin-left: 25px;" onclick="buscarPagos()">
                        Buscar Pagos
                      </button>

                    </div>
                    <div class="col-md-4">
<!--                       <button type="button" class="btn btn-primary mt-2" onclick="buscarPagos()">
                        Buscar Pagos
                      </button> -->

<!--                       <label for="validationServerUsername">Username</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupPrepend3">@</span>
                        </div>
                        <input type="text" class="form-control is-invalid" id="validationServerUsername" placeholder="Username" aria-describedby="inputGroupPrepend3" required>
                        <div class="invalid-feedback">
                          Please choose a username.
                        </div>
                      </div> -->
                    </div>
                  </div>

<!--                   <hr>
                  <div class="form-row">
                    <div class="col-md-6">hannotrnico</div>
                    <div class="col-md-6">content</div>
                  </div> -->

<!--                   <div class="form-row">
                    <div class="col-md-6">
                      <label for="validationServer03">City</label>
                      <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="City" required>
                      <div class="invalid-feedback">
                        Please provide a valid city.
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationServer04">State</label>
                      <input type="text" class="form-control is-invalid" id="validationServer04" placeholder="State" required>
                      <div class="invalid-feedback">
                        Please provide a valid state.
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationServer05">Zip</label>
                      <input type="text" class="form-control is-invalid" id="validationServer05" placeholder="Zip" required>
                      <div class="invalid-feedback">
                        Please provide a valid zip.
                      </div>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <div class="form-check">
<!--                       <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" required>
                      <label class="form-check-label" for="invalidCheck3">
                        Agree to terms and conditions
                      </label> -->
<!--                       <div class="invalid-feedback">
                        You must agree before submitting.
                      </div> -->
                    </div>
                  </div>
                  <!-- <button class="btn btn-primary btn-xl" type="submit">Submit form</button> -->
                </form>

              </div>              

            </div>


<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Pagos del colegiado
    </h3>

      <div class="row">
        <div class="col-md-6">
          &nbsp;
        </div>
        <div class="col-md-6 text-right" style="color: #138AF9">
          <b>Deuda total:</b> S/
          <span id="deuda_total">0.00</span>

          <input type="hidden" name="txtDeudaTotal" id="txtDeudaTotal" value="">
          
          <button type="button" class="btn btn-success btn-sm ml-3 px-4" onclick="pagarDeudaAmortizacion()" id="btnPagar">PAGAR</button>
        </div>        
      </div>

  </div>



  <div class="card-body">
                <table id="lista_pagos_id" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ST</th>
                    <th style="text-align: center;">CBP</th>
                    <th>Nro cuota</th>
                    <th>Fecha venci.</th>
                    <th style="text-align: right;">Mora</th>
                    <th style="text-align: right;">Deuda</th>
                    <th>Gen</th>
                    <th style="text-align: right;">Adelanto</th>
                    <th style="text-align: right;">Saldo</th>
                    <!-- <th style="text-align: center;">&nbsp;</th> -->
                  </tr>
                  </thead>
                  <tbody id="lista_pagos">
                  </tbody>
                </table>

  </div>
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
    <strong>Copyright &copy; 2022 <a href="#">Grupo Alcedo</a>.</strong>
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
                              <h5 class="modal-title" id="exampleModalLongTitle">Búsqueda de colegiados</h5>
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

  $( "#btnSalir" ).click(function() {
    if (confirm("Esta seguro de salir del sistema")) {
      location.href="<?php echo ENLACE_WEB;?>mod_login/logout.php";
    }else{
      return false;
    }
  });


  function cargarTotalDeuda(){
    $.post('<?php echo ENLACE_WEB?>mod_pagos/controller_pagos.php?op=total_deuda&idcol='+$("#idcolegiado").val(),function(r){
      $("#deuda_total").html(r);
      $("#txtDeudaTotal").val(r);
      if( r > 0 ){
         $("#btnPagar").prop("disabled", false);
      }else{
         $("#btnPagar").prop("disabled", true);
      }
      // console.log(r);
    });
  }

  function pagarDeudaAmortizacion() {
    // $.post('<?php //echo ENLACE_WEB?>mod_pagos/controller_pagos.php?op=pagar_deuda&idcol='+$("#idcolegiado").val(),function(r){
    //   // $("#deuda_total").html(r);
    //   console.log(r);
    // });


    Swal.fire({
      title: '¿Desea realizar el pago de la deuda?',
      text: "Realizar el pago!",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar!'
    }).then((result) => {
      if (result.isConfirmed) {
        // Swal.fire(
        //   'Deleted!',
        //   'Your file has been deleted.',
        //   'success'
        // )
            
            $.ajax({
              url: '<?php echo ENLACE_WEB?>mod_pagos/controller_pagos.php',
              type: 'POST',
              data: {accion: 'pagar_deuda', idColegiado: $("#idcolegiado").val(), deudaTotal: $("#txtDeudaTotal").val()},
            })
            .done(function(data) {
              // alert("Colegiado seleccionado!");
              // var resp = JSON.parse(data);
              console.log(data);
              if(data == 'exito'){
                location.href="<?php echo ENLACE_WEB;?>mod_pagos/view_pagos_servicios.php?idcol=" + $("#idcolegiado").val();
              }

              // $("#colegiado").val(data);

              // console.log(resp.idcolegiado);
              // console.log(resp.datosColegiado);
              // $("#idcolegiado").val(resp.idcolegiado);
              // $("#colegiado").val(resp.datosColegiado);
              // $("#lista_colegiados_busca").empty();
              // $("#dni_codigo").val('');
              // $("#cerrar").click();
              
            })
            .fail(function() {
              console.log("error");
            })



      }
    })





    // if( confirm('hanntronico') == true ){

    // }



  }

  function seleccionarColegiado(idColegiado) {
    
      $.ajax({
        url: '<?php echo ENLACE_WEB?>mod_pagos/controller_pagos.php',
        type: 'POST',
        data: {accion: 'carga_datos_cole', idColegiado: idColegiado},
      })
      .done(function(data) {
        // alert("Colegiado seleccionado!");

        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        Toast.fire({
          icon: 'success',
          title: 'Colegiado seleccionado!'
        })


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

  // function buscarPagos() {
  //   $('#content').html('<div class="loading"><img src="../dist/img/loading.gif" alt="loading" width="5%" /><br/>Un momento, por favor...</div>');

  //   $.ajax({
  //     url: '<?php //echo ENLACE_WEB?>mod_pagos/controller_pagos.php',
  //     type: 'POST',
  //     data: {accion: 'buscar_pagos', idColegiado:$("#idcolegiado").val() },
  //   })
  //   .done(function(data) {
  //     console.log(data);
  //     if(data != ''){
  //       $('#lista_pagos').empty().html(data);
  //     }else{

  //       if(data == 'vacio'){
  //         $('#lista_pagos').empty().html('<tr><td colspan="7" class="text-center">Sin pagos</td></tr>');  
  //       }
        
  //     }
      
  //   })
  //   .fail(function() {
  //     console.log("error");
  //   })

  // }

  function buscarPagos() {

    tabla=$('#lista_pagos_id').dataTable(
    {
      "lengthMenu": [ 5, 12, 24, 75, 100],
      "aProcessing": true,
        "aServerSide": true,
        "dom": 'Blfrtip',
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
      "ajax":
          {
            url: 'controller_pagos.php?op=listar_pagos&idcol=' + $("#idcolegiado").val(),
            type : "get",
            dataType : "json",            
            error: function(e){
              console.log(e.responseText);
              if (e.responseText == 'error') {
                $("#lista_pagos").empty().html('<tr><td colspan="8" class="text-center">Vacio</td></tr>');
                // alert('sin pagos');
              }
            }
            // ,
            // success: function(e)
            // { 
            //   console.log(e.aaData);
            // }
          },
        "language": {
          url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
      "rowCallback": function( row, data, index ) {
            $(row).addClass('green');
      },
      "bDestroy": true,
      "iDisplayLength": 12,
      "order": [[ 0, "desc" ]],
      "columnDefs": [
          {
            "targets": 0, 
            "className": "dt-body-center"
            // ,"width": "4%"
            ,"render": function (data, type, row) {
                if (row[4] > 0) {
                  // $('tr').css('background-color', '#FFC9C9');
                }
                return data;
            }            
         },
         {
            "targets": 1,
            "className": "dt-body-center"
            ,"width": "4%"
         },
         {
            "targets": 2,
            "className": "dt-body-center"
            ,"width": "8%"
         },
         {
            "targets": 3,
            "className": "dt-body-right"
            ,"width": "9%"            
         },
         {
            "targets": 4,
            "className": "dt-body-right",            
         },
         {
            "targets": 5,
            "className": "dt-body-right",            
         },
         {
            "targets": 6,
            "className": "dt-body-left",            
         },
         {
            "targets": 7,
            "className": "dt-body-right",
         },
         {
            "targets": 8,
            "className": "dt-body-right",
         }
         // ,
         // {
         //    "targets": 9,
         //    "className": "dt-body-center",
         // }
         ],        
    }).DataTable();    


     cargarTotalDeuda();

    // var table = $('#lista_pagos_id').DataTable({
    // rowCallback: function( row, data, index ) {
    //   if ( data[4] == "0" ) {$(row).addClass('red');} 
    //   // else if ( data[3] == "61" ) {$(row).addClass(orange');}
    //   // else if ( data[3] == "30" ) {$(row).addClass('red');} 
    // }
    // });   

  }


  function buscarColegiado() {

    $('#content').html('<div class="loading text-center" style="text-align: center;"><img src="../dist/img/loading.gif" alt="loading" width="5%" /><br/>Un momento, por favor...</div>');

    $.ajax({
      url: '<?php echo ENLACE_WEB?>mod_colegiados/controller_colegiados.php',
      type: 'POST',
      data: {accion: 'carga_busqueda_colegiados', dni_codigo: $("#dni_codigo").val()},
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




  $( document ).ready(function() {


  });


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

<?php 
}
ob_end_flush();
?>