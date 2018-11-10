<?php

$mvc =  new mvc_controller();
$respuesta=$mvc -> perfilC($_GET["id"],"usuarios");
if($respuesta["tipo"]==1){
  $tipo="Administrador";
}elseif($respuesta["tipo"]==2){
  $tipo="Cliente";
}
?>
<div class="container-fluid">
                        <!-- Begin Page Header-->
                        <div class="row">
                            <div class="page-header">
                                <div class="d-flex align-items-center">
                                    <h2 class="page-header-title">Profile</h2>
                                    <div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="db-default.html"><i class="ti ti-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                            <li class="breadcrumb-item active">Profile</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Page Header -->
                        <div class="row flex-row">
                            <div class="col-xl-3">
                                <!-- Begin Widget -->
                                <div class="widget has-shadow">
                                    <div class="widget-body">
                                        <div class="mt-5">
                                            <img src="<?php echo $respuesta["imagen"]?>" alt="..." style="width: 120px;" class="avatar rounded-circle d-block mx-auto">
                                        </div>
                                        <h3 class="text-center mt-3 mb-1"><?php echo $respuesta["nombre"]?> <?php echo $respuesta["apellido"]?></h3>
                                        <p class="text-center"><?php echo $respuesta["email"]?></p>
                                      <?php if($_SESSION["tipo"]==1){?>
                                        <div class="em-separator separator-dashed"></div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="javascript:void(0)"><i class="la la-edit edit la-2x align-middle pr-2"></i>Editar</a>
                                            </li>
                                          <?php if($_SESSION["id"]!=$_GET["id"]){?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="index.php?action=usuarios&idBorrar=<?php echo $_GET["id"]?>">
                                                  <i class="la la-trash delete la-2x align-middle pr-2"></i>Eliminar</a>
                                            </li>
                                          <?php }if($_SESSION["id"]==$_GET["id"]){?>
                                           <li class="nav-item">
                                                <a class="nav-link" href="#">
                                                  <i class="la la-trash delete la-2x align-middle pr-2"></i>Eliminar</a>
                                            </li>
                                          <?php }?>
                                          <li class="nav-item">
                                                <a class="nav-link" href="index.php?action=usuarios"><i class="la la-chevron-circle-left la-2x align-middle pr-2"></i>Regresar</a>
                                            </li>
                                        </ul>
                                      <?php }?>
                                    </div>
                                </div>
                                <!-- End Widget -->
                            </div>
                            <div class="col-xl-9">
                                <div class="widget has-shadow">
                                    <div class="widget-header bordered no-actions d-flex align-items-center">
                                        <h4>Update Profile</h4>
                                    </div>
                                    <div class="widget-body">
                                        
   <div id="accordion-icon-right" class="accordion">
    <div class="widget has-shadow">
        <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseOne" aria-expanded="true">
            <div class="card-title w-100">1. Información Personal</div>
        </a>
        <div id="IconRightCollapseOne" class="card-body collapse show" data-parent="#accordion-icon-right">
            <div class="form-group row mb-5">
                <div class="col-sm-3 form-control-label d-flex align-items-center">ID</div>
                <div class="col-sm-8 form-control-plaintext"><?php echo $respuesta["id"]?></div>
            </div>
            <div class="form-group row mb-5">
                <div class="col-sm-3 form-control-label d-flex align-items-center">NOMBRE</div>
                <div class="col-sm-8 form-control-plaintext"><?php echo $respuesta["nombre"]?></div>
            </div>
            <div class="form-group row mb-5">
                <div class="col-sm-3 form-control-label d-flex align-items-center">APELLIDO</div>
                <div class="col-sm-8 form-control-plaintext"><?php echo $respuesta["apellido"]?></div>
            </div>
            <div class="form-group row mb-5">
                <div class="col-sm-3 form-control-label d-flex align-items-center">FECHA REGISTRO</div>
                <div class="col-sm-8 form-control-plaintext"><?php echo $respuesta["fecha"]?></div>
            </div>
        </div>
        <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseTwo">
            <div class="card-title w-100">2. Detalles de Cuenta</div>
        </a>
        <div id="IconRightCollapseTwo" class="card-body collapse" data-parent="#accordion-icon-right">
            <div class="form-group row mb-5">
                <div class="col-sm-3 form-control-label d-flex align-items-center">NOMBRE USUARIO</div>
                <div class="col-sm-8 form-control-plaintext"><?php echo $respuesta["usuario"]?></div>
            </div>
            <div class="form-group row mb-5">
                <div class="col-sm-3 form-control-label d-flex align-items-center">EMAIL</div>
                <div class="col-sm-8 form-control-plaintext"><?php echo $respuesta["email"]?></div>
            </div>
          <div class="form-group row mb-5">
                <div class="col-sm-3 form-control-label d-flex align-items-center">TIPO DE USUARIO</div>
                <div class="col-sm-8 form-control-plaintext"><?php echo $tipo ?></div>
            </div>

        </div>
      <?php if($_SESSION["tipo"]==1 and $respuesta["tipo"]==2){?>
        <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseThree">
            <div class="card-title w-100">3. Visitas</div>
        </a>
        <div id="IconRightCollapseThree" class="card-body collapse" data-parent="#accordion-icon-right">
          <div class="row">
                    <div class="col-xl-10 d-flex align-items-center mb-3">
                     </div>
                    <div class="col-xl-2 d-flex align-items-center mb-3">
                      <form method="POST">
                        <input type="hidden" name="id_usuario" values="<?php echo $respuesta["id"]?>">
                        <button type="submit" name="submit" class="btn btn-primary">Visita</button>
                      </form>
                    </div>
                </div>
               <table id="export-table" class="table mb-0">
                      <thead>
                          <tr>
                              <th>Id</th>
                              <th>Dia</th>
                              <th>Fecha</th>
                              <th>Hora</th>
                          </tr>
                      </thead>
                <tbody>
                   <?php
                      $vista = new mvc_controller();
                      $vista -> vistaVisitasC();
                    ?>
                 </tbody>
                  </table>
 

        </div>
      <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseFour">
            <div class="card-title w-100">4. Promociones</div>
        </a>
        <div id="IconRightCollapseFour" class="card-body collapse" data-parent="#accordion-icon-right">
                <table id="export-table" class="table mb-0">
                      <thead>
                          <tr>
                              <th>Id</th>
                              <th>visitas</th>
                              <th>nombre</th>
                              <th>Descripcion</th>
                          </tr>
                      </thead>
                <tbody>
                   <?php
                      $vista = new mvc_controller();
                      $vista -> vistaVisitasC();
                    ?>
                 </tbody>
                  </table>
        </div>
      <?php }?>
    </div>
</div>
                                      
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
<?php
$visita=new mvc_controller();
$visita->registroVisitaC();
?>