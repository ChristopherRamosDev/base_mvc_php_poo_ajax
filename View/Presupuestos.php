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

            
              <div class="col-lg-9 grid-margin stretch-card" style="margin: 0 auto;">
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
                              Descripción
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
                          </tr>
                        </thead>
                        <!-- <tbody>
                          <tr>
                            <th>si</th>
                            <th>si</th>
                            <th>si</th>
                            <th>si</th>
                          </tr>
                        </tbody> -->
                      </table>
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
    <script src="<?php echo base_url;?>View/js/budgets.js"></script>

    </html>

  <?php else :

  header('Location:' . base_url);
endif; ?>