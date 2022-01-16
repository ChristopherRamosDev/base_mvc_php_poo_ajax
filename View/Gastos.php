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
      <?php require_once 'includes/nav-bar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <!-- content-wrapper ends -->
          <?php require_once 'includes/editBudget.php'; ?>
          <!-- partial:partials/_footer.html -->
          <div class="col-12 mb-4 mb-xl-0 p-2">
            <button class="btn btn-success mt-1" id="btnNewBudget" data-toggle="modal" data-target="#exampleModalGasto">Añadir gasto</button>
          </div>
          <div class="modal fade" id="exampleModalGasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Agregar</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="frmGasto">
                    <div class="form-group">
                      <label for="nombre" class="col-form-label">Nombre</label>
                      <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>

                    <div class="form-group">
                      <label for="nombre" class="col-form-label">Monto</label>
                      <input type="text" class="form-control" id="monto" name="monto">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                  <button id="nuevoGasto" type="button" class="btn btn-primary">Enviar</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 grid-margin stretch-card" style="width: 80%;margin: 0 auto;">

            <div class="card">

              <div class="card-body">

                <div class="table-responsive">
                  <table class="table table-striped" id="tablaGastos" style="width: 100%;">
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
                  <form id="frmGastoUpdate">
                    <input type="hidden" name="idPresu" id="idPresu" value="">
                    <input type="hidden" name="trid" id="trid" value="">
                    <div class="form-group">
                      <label for="nombre" class="col-form-label">Nombre</label>
                      <input type="text" class="form-control" id="nombreUpdateGasto" name="nombreUpdateGasto">
                    </div>

                    <div class="form-group">
                      <label for="nombre" class="col-form-label">Monto</label>
                      <input type="text" class="form-control" id="montoUpdate" name="montoUpdate">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                  <button id="updateGasto" type="button" class="btn btn-primary">Editar</button>
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
    <script src="<?php echo base_url; ?>View/js/gastos.js"></script>


  <?php else :

  header('Location:' . base_url);
endif; ?>