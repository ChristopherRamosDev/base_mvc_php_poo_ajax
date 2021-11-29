<?php require_once 'includes/head.php'?>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
        <div class="row flex-grow">
          <div class="mx-auto text-white">
            <div class="row d-block">
              <div class="text-center">
                <h1 class="display-1 mb-0 text-center">404</h1>
              </div>
              <div class=" error-page-divider text-center">
                <h2>SORRY!</h2>
                <h3 class="font-weight-light">The page you’re looking for was not found.</h3>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 text-center mt-xl-2">
                <a class="text-white font-weight-medium" href="<?php echo base_url;?>">Back to home</a>
              </div>
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
  <?php require_once 'includes/footer.php'?>
  <!-- endinject -->
</body>

</html>
