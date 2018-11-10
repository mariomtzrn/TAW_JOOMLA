<?php $mvc_u = new mvc_controller_user(); ?>
<div class="container-fluid">
    <!-- Begin Page Header-->
    <div class="row">
        <div class="page-header">
          <div class="d-flex align-items-center">
              <h2 class="page-header-title">DWASH</h2>
              <div>
              </div>
          </div>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row flex-row">
        <div class="col-xl-12">
            <!-- Basic Map Marker -->
            <div class="widget has-shadow">
                <div class="widget-header bordered no-actions d-flex align-items-center">
                  <h4>Actualizar Contraseña</h4>
                </div>
                <div class="widget-body">
                  <?php $mvc_u -> actContrasenaC(); ?>
                </div>
            </div>
            <!-- End Basic Map Marker -->
        </div>
    </div>
    <!-- End Row -->
</div>
<!-- End Container -->
