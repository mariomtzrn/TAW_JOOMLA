<div class="pcoded-inner-content">
<!-- Main-body start -->
<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="icofont icofont-tags bg-c-pink"></i>
                        <div class="d-inline">
                            <h4>Categorias</h4>
                            <span>Listado de Categorias</span>
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
                            <li class="breadcrumb-item"><a href="#!">Categorias</a>
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
                          <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#default-Modal">
                            Nueva Categoria</button>  
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
                                        <th>Nombe</th>
                                        <th>Descripción</th>
                                        <th>Agregado</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                            $vistaCategoria = new mvc_controller();
                                            $vistaCategoria -> vistaCategoriaC();
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
                      <h4 class="modal-title">Nueva Categoria</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
                  </div>
                  <div class="modal-body">
                      <form method="post">
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Nombre</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nombre">

                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Descripción</label>
                              <div class="col-sm-10">
                                 <textarea class="textarea" required placeholder="Place some text here" name="descripcion"
                                           style="width: 100%; height: 200px; font-size: 14px; line-height: 
                                            18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
$registro -> registroCategoriaC();
?>