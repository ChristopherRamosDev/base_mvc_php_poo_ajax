<?php require_once 'includes/head.php' ?>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="text-center mb-5">
                <h2>Gastos-App</h2>
              </div>
              
              <h4 class="font-weight-light">Inicia sesión para continuar</h4>
              <form class="pt-3" method="POST" id="fromLoginUser">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="user" id="user" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="pass" id="pass" placeholder="Password">
                </div>
                <button  class="btn btn-block btn-primary p-3" type="submit" id="btnLogin">
                      INICIAR SESIÓN
                  </button>
 
             
                <div class="text-center mt-4 font-weight-light">
                  ¿No tienes una cuenta? <a href="<?php echo base_url;?>register" class="text-primary">Registrate</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <?php require_once 'includes/footer.php'; ?>
  <!-- endinject -->
</body>

</html>