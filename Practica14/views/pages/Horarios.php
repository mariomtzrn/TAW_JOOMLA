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
                   <i class="ti ti-timer"></i>Registrar</button>
                    </div>
                </div>
                
                
                
                  <table id="export-table" class="table mb-0">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Dia</th>
                             <th>Hora Abrir</th>
                              <th>Hora Cerrar</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                <tbody>
                   <?php
                      $vista = new mvc_controller();
                      $vista -> vistaHorariosC();
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
                        <h4 class="modal-title">USUARIOS</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
                         <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-3 form-control-label">Dias</label>
                            <div class="col-lg-9">
                                <select class=" custom-select form-control" name="dia" data-live-search="true">
                                    <option value="Domingo">Domingo</option>
                                    <option value="Lunes">Lunes</option>  
                                    <option value="Martes">Martes</option>
                                    <option value="Miercoles">Miercoles</option>
                                  <option value="Jueves">Jueves</option>  
                                    <option value="Viernes">Viernes</option>
                                    <option value="Sabado">Sabado</option>
                                </select>
                            </div>
                        </div>
                           <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Hora Abrir</label>
                                <div class="col-lg-9">
                                    <input type="time"  maxlength="20" name="hora_abrir" placeholder="Hora Abrir" id="hora_abrir" 
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Hora Cerrar</label>
                                <div class="col-lg-9">
                                    <input type="time"  maxlength="20" placeholder="Hora Cerrar" id="hora_cerrar" class="form-control"  
                                        name="hora_cerrar"   oninput="validarh();">
                                  <small id="fecha"></small><small id="fecha"></small>
                                </div>
                            </div>
                          <input type="hidden" value="" id="validacion" name="validacion">
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
$mvc -> registroHorarioC();
$mvc -> borrarC("horarios");

?>

