<?php require_once 'includes/head.php' ?>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
     
      <div class="content-wrapper d-block align-items-center auth px-0">
        <div class="row w-100 mx-0" style="margin-top:5rem;">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="text-center mb-5">
              <h2 class="font-weight-light">Inicio de sesión</h2>
                
              </div>
              
              
              <form class="pt-3" method="POST" id="fromLoginUser">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="user" id="user" placeholder="Usuario">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="pass" id="pass" placeholder="Clave">
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
        
       
          <div class="footer_log">
          <img src="<?php echo base_url;?>View/images/logo_marca.png" alt="servicesworkshop" >
         
          <p>&copy 2021 Service Workshop Todos los derechos reservados</p>
      
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