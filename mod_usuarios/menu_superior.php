<?php
$nivelaxe = $_SESSION["nivel"];

if($nivelaxe==1 || $nivelaxe==2){ }else{
	print "<script>alert('Acceso invalido! - Nivel de acceso no permitido');window.location='../';</script>";
}
?>
     <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="dasboard.php">
          <!--<img src="images/logo.svg" alt="logo" />-->
          <img src="../dist/img/logo-ini.png" width="126px" height="17px" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="dasboard.php">
          <img src="images/favicon.png" width="16px" height="17px" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">

        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Bienvenido, <?=$datnomuser;?> !</span>
              <img class="img-xs rounded-circle" src="../dist/img/faces-clipart/pic-4.png" alt="Perfil Usuario">
            </a>
            
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <!--<a class="dropdown-item mt-2">
                Mi Cuenta
              </a>-->
              <a class="dropdown-item" data-toggle="modal" data-target="#myModalClave">
                Cambiar Password
              </a>

              <!--<a class="dropdown-item">
                Check Inbox
              </a>-->
              <a href="logout.php" class="dropdown-item text-danger">
                Cerrar Sesion <i class="mdi mdi-login"></i>
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    
   
  <div class="modal fade" id="myModalClave" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <!--<h4 class="modal-title">Modal Header</h4>-->
        </div>
        <div class="modal-body">
          <p>Ingresa tu nueva Clave.</p>
          <form class="forms-sample" method="post" action="update_pass.php">
                       <div class="form-group">
                          <label for="exampleInputPassword1">Nombre</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Tu Nombre" value="<?=$datnomuser;?>" readonly>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Usuario</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tu Usuario" value="<?=$datuser;?>" readonly>
                          <input type="hidden" name="keyllave" class="form-control" id="exampleInputEmail1" placeholder="idusu" value="<?=$_SESSION["idu"];?>" readonly>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Clave Nueva</label>
                          <input type="password" name="llaveuno" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Cambiar Clave</button>
                    
                      </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>