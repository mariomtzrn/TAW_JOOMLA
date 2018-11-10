<div class="container-fluid">
    <!-- Begin Page Header-->
    <div class="row">
        <div class="page-header">
          <div class="d-flex align-items-center">
              <h2 class="page-header-title">Leaflet</h2>
              <div>
              <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="db-default.html"><i class="ti ti-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Maps</a></li>
                  <li class="breadcrumb-item active">Leaflet</li>
              </ul>
              </div>
          </div>
        </div>
    </div>
  <div class="row flex-row">
        <div class="col-xl-12">       
      <!-- Export -->
      <div class="widget has-shadow">
          <div class="widget-header bordered no-actions d-flex align-items-center">
              <h4>Export</h4>
          </div>
        
          <div class="widget-body">
              <div class="table-responsive">
                
                <div class="row">
                    <div class="col-xl-10 d-flex align-items-center mb-3">
                     </div>
                    <div class="col-xl-2 d-flex align-items-center mb-3">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-large">
                   <i class="la la-trophy"></i>Registrar</button>
                    </div>
                </div>
                
                
                
                  <table id="export-table" class="table mb-0">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Descripción</th>
                              <th>Visitas</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                <tbody>
                   <?php
                      $vista = new mvc_controller();
                      $vista -> vistaPromocionesC();
                    ?>
                 </tbody>
                  </table>
              </div>
          </div>
      </div>
      <!-- End Export -->
    </div>
  </div>
</div>

<!----- M O D A L--------->
        <div id="modal-large" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">PROMOCIONES</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
                           <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Nombre</label>
                                <div class="col-lg-9">
                                    <input type="text" placeholder="Nombre"  maxlength="100" name="nombre" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Descripcion</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" placeholder="Type your message here ..." required name="descripcion"></textarea>
                                    
                                </div>
                            </div>
                           <div class="form-group row d-flex align-items-center mb-5">
                              <label class="col-lg-3 form-control-label">N° de Vistas</label>
                                <div class="col-lg-9">
                                    <input type="number"  maxlength="30" name="visitas" placeholder="N° de Visitas"  required class="form-control">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                      </form>
                </div>
            </div>
        </div>

<?php
$mvc =  new mvc_controller();
$mvc -> registroPromocionC();
$mvc -> borrarC("promociones");

?>

