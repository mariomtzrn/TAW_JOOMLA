<div class="pcoded-inner-content">
<!-- Main-body start -->
<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="icofont icofont-ui-user bg-c-green"></i>
                        <div class="d-inline">
                            <h4>USUARIOS</h4>
                            <span>Listado de usuarios</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="index.php?action=Inventario">
                                    <i class="icofont icofont-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Usuarios</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <!-- Page-body start -->
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Zero config.table start -->
                    <div class="card">
                        <div class="card-header">
                          <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#default-Modal">Nuevo Usuario</button>  
                          <div class="card-header-right"><i
                                    class="icofont icofont-spinner-alt-5"></i></div>
                        </div>

                      <!--- SE CREA LA TABLA PARA VISUALIZAR USUARIOS -->
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable"
                                       class="table table-striped table-bordered nowrap">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Agregado</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                        <th>Vista</th>
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
                    <!-- Zero config.table end -->

                </div>
            </div>
        </div>
        <!-- Page-body end -->
    </div>
</div>
</div>



  
       <!-- Modal static-->
      
      <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Nuevo Usuario</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
                  </div>
                  <div class="modal-body">
                         <form method="post" enctype="multipart/form-data" >
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Nombre</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nombre">

                              </div>
                          </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Apellido</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="apellido" id="apellido" required placeholder="Apellido">

                              </div>
                          </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Usuario</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="usuario" id="usuario" required placeholder="Usuario">

                              </div>
                          </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                  <input type="email" class="form-control" name="email" id="email" required placeholder="Email">

                              </div>
                          </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Contraseña</label>
                              <div class="col-sm-10">
                                  <input type="password" class="form-control" name="password" id="password" required placeholder="Contraseña">

                              </div>
                          </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Imagen</label>
                             <div class="col-sm-10">
                                <input type="file" class="form-control" name="imagen" accept="image/jpeg, image/png">
                               </div>
                            </div>
                                                        
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                   </form>
                      <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
<?php
$registro =  new mvc_controller();
$registro -> registroUsuarioC();
?>