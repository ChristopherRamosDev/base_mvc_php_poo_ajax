<?php

if (isset($_SESSION['user'])) : ?>
  <?php require_once 'includes/head.php'; ?>


  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <?php require_once 'includes/nav-header.php' ?>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

        <!-- <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
          </button> -->

        <?php require_once 'includes/header-content.php'; ?>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->


      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php require_once 'includes/nav-bar.php' ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <!-- content-wrapper ends -->
          <?php require_once 'includes/datos.php'; ?>
          <!-- partial:partials/_footer.html -->
          <div class="col-12 mb-xl-0 p-2 mb-5">
            <button class="btn btn-success mt-1" id="btnEditInfo" data-toggle="modal" data-target="#exampleModalInfo">Editar info</button>
          </div>
          <div class="col-12 grid-margin stretch-card" style="width: 80%;margin: 0 auto;">

            <div class="card">

              <div class="card-body" style="padding-bottom: 0;">

                <div class="table-responsive p-3" id="divInfo">
              
                  <!-- <h3 id="nombreInfo">Nombres:</h3>
                  <hr>
                  <h3 id="apellidoInfo">Apellidos:</h3>
                  <hr>
                  <h3 id="correoInfo">Correo:</h3>
                  <hr>
                  <h3 id="usuarioInfo">Usuario:</h3>
 -->
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="updateModalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="frmInfoUpdate">
                 
                    <div class="form-group">
                      <label for="nombre" class="col-form-label">Nombres:</label>
                      <input type="text" class="form-control" id="nombreUpdateInfo" name="nombreUpdateInfo">
                    </div>
                    <div class="form-group">
                      <label for="nombre" class="col-form-label">Apellidos:</label>
                      <input type="text" class="form-control" id="apellidoInfo" name="apellidoInfo">
                    </div>
                    <div class="form-group">
                      <label for="nombre" class="col-form-label">Correo:</label>
                      <input type="text" class="form-control" id="correoInfo" name="correoInfo">
                    </div>
                    <div class="form-group">
                      <label for="nombre" class="col-form-label">Usuario:</label>
                      <input type="text" class="form-control" id="usuarioInfo" name="usuarioInfo">
                    </div>
                    <div class="form-group">
                      <label for="nombre" class="col-form-label">Clave anterior:</label>
                      <input type="pass" value="********" class="form-control" id="claveAnterior" name="claveAnterior">
                    </div>
                    <div class="form-group">
                      <label for="nombre" class="col-form-label">Nueva Clave:</label>
                      <input type="pass" value="********" class="form-control" id="newPass" name="newPass">
                    </div>
                    <div class="form-group">
                      <label for="nombre" class="col-form-label">Repetir nueva clave:</label>
                      <input type="pass"  value="********" class="form-control" id="repeatPass" name="repeatPass">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                  <button id="updateInfo" type="button" class="btn btn-primary">Editar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <?php require_once 'includes/footer.php'; ?>
    <script src="<?php echo base_url; ?>View/js/profile.js"></script>


  <?php else :

  header('Location:' . base_url);
endif; ?>