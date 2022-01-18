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
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 mb-4 mb-xl-0 p-2" id="bienvenidoDiv">
                  <h3 id="bienvenido" class="font-weight-bold">Bienvenido</h3>
                  <h6 class="font-weight-normal mb-0">Nos gusta verte de vuelta <span class="text-primary"></span></h6>
                </div>

              </div>
            </div>
          </div>
          <!-- partial:partials/_footer.html -->

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