<?php /* require_once 'includes/head.php'; */

require_once "includes/head.php";
?>

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
              <h4 class="font-weight-light">¿Nuevo Aquí? Registrate</h4>
              <form class="pt-3" method="POST" id="formRegisterUser">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="nombres" id="nombres" minlength="1" maxlength="50" placeholder="Nombres" >
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="apellidos" id="apellidos" minlength="1" maxlength="50" placeholder="Apellidos" >
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" id="email" minlength="1" maxlength="50" placeholder="Email" >
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="usuario" id="usuario" minlength="1" maxlength="50" placeholder="Usuario" reuired>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" id="password" minlength="1" maxlength="30" placeholder="Password" >
                </div>

                <div class="mt-3">
                  <button  class="btn btn-block btn-primary p-3" type="submit" id="btnInsertar">
                      REGISTRARME
                  </button>
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
  <?php /* require_once 'includes/head.php'; */

require_once "includes/footer.php";
?>
  <!-- endinject -->
</body>

</html>