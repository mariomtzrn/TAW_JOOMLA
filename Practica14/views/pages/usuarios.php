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
                   <i class="la la-user-plus"></i>Registrar</button>
                    </div>
                </div>
                
                
                
                  <table id="export-table" class="table mb-0">
                      <thead>
                          <tr>
                              <th>Usuario</th>
                              <th>Nombre</th>
                              <th><span style="width:100px;">Tipo</span</th>
                              <th>Email</th>
                              <th>Fecha</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                <tbody>
                   <?php
                      $vista = new mvc_controller();
                      $vista -> vistaUsuariosC();
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
                                <label class="col-lg-3 form-control-label">Nombre</label>
                                <div class="col-lg-9">
                                    <input type="text" placeholder="Nombre"  maxlength="100" name="nombre" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Apellido</label>
                                <div class="col-lg-9">
                                    <input type="text"  maxlength="100" name="apellido" placeholder="Apellido" class="form-control">
                                </div>
                            </div>
                           <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Nombre de usuario</label>
                                <div class="col-lg-9">
                                    <input type="text"  maxlength="30" name="usuario" placeholder="username" class="form-control">
                                </div>
                            </div>
                           <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Email</label>
                                <div class="col-lg-9">
                                    <input type="email"  maxlength="50" placeholder="Email" name="email" class="form-control">
                                </div>
                            </div>
                           <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Contraseña</label>
                                <div class="col-lg-9">
                                    <input type="password"  maxlength="20" name="password" placeholder="Contraseña" id="pass" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Confirmar Contraseña</label>
                                <div class="col-lg-9">
                                    <input type="password"  maxlength="20" placeholder="Confirmar contraseña" id="re_pass"
                                           class="form-control"  oninput="validarC();">
                                  <small id="demo"></small><small id="demo2"></small>
                                </div>
                            </div>
                          <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-3 form-control-label">Tipo de usuario</label>
                            <div class="col-lg-9">
                                <select class=" custom-select form-control" name="tipo" data-live-search="true">
                                    <option value="2">Cliente</option>
                                    <option value="1">Administrador</option>
                                </select>
                            </div>
                        </div>
                                                      <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Imagen</label>
                                <div class="col-lg-9">
                                    <input type="file" name="imagen" accept="image/jpeg, image/png" class="form-control"  >
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
$mvc -> registroUsuarioC();
$mvc -> borrarUsuarioC();

?>
<!----- M O D A L--------->
        <div id="modal-Editar" class="modal fade">
    <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">USUARIOS3</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
                          <input type="hidden" value="<?php echo $respuesta["id"] ?>"  name="id_Editar">
                           <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Nombre</label>
                                <div class="col-lg-9">
                                    <input type="text" placeholder="Nombre"  value="<?php echo $respuesta["nombre"]?>" maxlength="100" name="nombre" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Apellido</label>
                                <div class="col-lg-9">
                                    <input type="text"  maxlength="100" value="<?php echo $respuesta["apellido"]?>" name="apellido" placeholder="Apellido" class="form-control">
                                </div>
                            </div>
                           <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Nombre de usuario</label>
                                <div class="col-lg-9">
                                    <input type="text"  maxlength="30" value="<?php echo $respuesta["usuario"]?>" name="usuario" placeholder="username" class="form-control">
                                </div>
                            </div>
                           <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Email</label>
                                <div class="col-lg-9">
                                    <input type="email"  maxlength="50" value="<?php echo $respuesta["email"]?>" placeholder="Email" name="email" class="form-control">
                                </div>
                            </div>
                           <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Contraseña</label>
                                <div class="col-lg-9">
                                    <input type="password"  maxlength="20" value="<?php echo $respuesta["password"] ?>" name="password" placeholder="Contraseña" id="pass" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Confirmar Contraseña</label>
                                <div class="col-lg-9">
                                    <input type="password"  maxlength="20" value="<?php echo $respuesta["password"] ?>" placeholder="Confirmar contraseña" id="re_pass" class="form-control"  oninput="validarC();">
                                  <small id="demo"></small><small id="demo2"></small>
                                </div>
                            </div>
                          <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-3 form-control-label">Tipo de usuario</label>
                            <div class="col-lg-9">
                                <select class=" custom-select form-control" name="tipo" data-live-search="true">
                                     <option value="<?php echo $respuesta["tipo"] ?>">Cliente</option>
                                    <option value="2">Cliente</option>
                                    <option value="1">Administrador</option>
                                </select>
                            </div>
                        </div>
                             <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">Imagen</label>
                                <div class="col-lg-9">
                                    <input type="file" name="imagen" accept="image/jpeg, image/png" class="form-control"  >
                                </div>
                            </div>
                          <input type="hidden" value="<?php echo $respuesta["imagen"] ?>"  name="ImagenV">
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
