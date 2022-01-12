<?php

if (isset($_SESSION['user'])) : ?>
  <?php require_once 'includes/head.php'; ?>

  <body>
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
        <?php require_once 'includes/nav-bar.php'; ?>
        <!-- partial -->
        <div class="main-panel">

          <!-- content-wrapper ends -->
          <div class="content-wrapper">
            <?php require_once 'includes/nuevoPresupuesto.php'; ?>
            <!-- partial:partials/_footer.html -->


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="frmPresu">
                      <div class="form-group">
                        <label for="nombre" class="col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                      </div>

                      <div class="form-group">
                        <label for="nombre" class="col-form-label">Cantidad</label>
                        <input type="text" class="form-control" id="cantidad" name="cantidad">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button id="nuevoPre" type="button" class="btn btn-primary">Enviar</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 grid-margin stretch-card" style="width: 80%;margin: 0 auto;">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped" id="tablaPresupuestos" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>
                            Nombre
                          </th>
                        
                          <th>
                            Monto
                          </th>
                          <th>
                            Fecha
                          </th>

                          <th>
                            Ver más
                          </th>
                          <th class="text-center">
                            Editar
                          </th>
                        </tr>
                      </thead>

                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="frmPresuUpdate">
                      <input type="hidden" name="idPresu" id="idPresu" value="">
                      <input type="hidden" name="trid" id="trid" value="">
                      <div class="form-group">
                        <label for="nombre" class="col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreUpdate" name="nombreUpdate">
                      </div>

                      <div class="form-group">
                        <label for="nombre" class="col-form-label">Cantidad</label>
                        <input type="text" class="form-control" id="cantidadUpdate" name="cantidadUpdate">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button id="updatePre" type="button" class="btn btn-primary">Editar</button>
                  </div>
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
    <script src="<?php echo base_url; ?>View/js/budgets.js"></script>

    </html>

  <?php else :

  header('Location:' . base_url);
endif; ?>