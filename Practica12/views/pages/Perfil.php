<?php

$mvc =  new mvc_controller();
$respuesta=$mvc -> perfilC("usuarios");
?>

<div class="pcoded-inner-content">
  <div class="main-body user-profile">
      <div class="page-wrapper">
      <!-- Page-header start -->
          <div class="page-header card">
              <div class="row align-items-end">
                  <div class="col-lg-8">
                      <div class="page-header-title">
                          <i class="icofont icofont-ui-user bg-c-green"></i>
                          <div class="d-inline">
                              <h4>PERFIL</h4>
                              <span>Perfil de Usuario</span>
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
                      <li class="breadcrumb-item"><a href="index.php?action=User">Usuarios</a>
                      </li>
                      <li class="breadcrumb-item"><a href="#">Perfil de Usuario</a>
                      </li>
                  </ul>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Page-header end -->

          <!-- Page-body start -->
          <div class="page-body">
              <!--profile cover end-->
              <div class="row">
                  <div class="col-lg-12">                   
                      <div class="tab-content">
                              <div class="card">
                                  <div class="card-header">
                                      <h5 class="card-header-text">Información</h5>
                                      
                                </button>
                                  </div>
                                  <div class="card-block">
                                      <div class="view-info">
                                          <div class="row">
                                              <div class="col-lg-12">
                                                  <div class="general-info">
                                                      <div class="row">
                                                          <div class="col-lg-12 col-xl-4">
                                                              <div class="table-responsive">
                                                                  <div class="col-md-12">
                                                                  <div class="media-left">
                                                                      <a href="#" class="profile-image">
                                                                          <img class="user-img img-radius"
                                                                               src="<?php echo $respuesta['imagen'] ?>" 
                                                                               width="238px" height="238px" alt="user-img">
                                                                      </a>
                                                                      
                                                                  </div>
                                                                    <div class="media-left">
                                                                   <center>
                                                                     <a href="index.php?action=User">
                                                                       <button type="button" class="btn btn-default">
                                                                       <i class="icofont icofont-arrow-left"></i></button></a>
                                                                       <a href="index.php?action=Editar&id=<?php echo $respuesta['id'] ?>&select=Usuario">
                                                                     <button type="button" class="btn btn-success">
                                                                      <i class="icofont icofont-ui-edit"></i></button></a>
                                                                     </center>
                                                                     </div>
                                                                </div>
                                                              </div>
                                                          </div>
                                                          <!-- end of table col-lg-6 -->
                                                          <div class="col-lg-12 col-xl-8">
                                                              <div class="table-responsive">
                                                                  <table class="table">
                                                                      <tbody>
                                                                          <tr>
                                                                              <th scope="row">NOMBRE</th>
                                                                              <td><?php echo $respuesta['nombre'] ?></td>
                                                                          </tr>
                                                                          <tr>
                                                                              <th scope="row">APELLIDO</th>
                                                                              <td><?php echo $respuesta['apellido'] ?></td>
                                                                          </tr>
                                                                          <tr>
                                                                              <th scope="row">USUARIO</th>
                                                                              <td><?php echo $respuesta['usuario'] ?></td>
                                                                          </tr>
                                                                          <tr>
                                                                              <th scope="row">EMAIL</th>
                                                                              <td><?php echo $respuesta['email'] ?></td>
                                                                          </tr>
                                                                          <tr>
                                                                              <th scope="row">FECHA</th>
                                                                              <td><?php echo $respuesta['fecha'] ?></td>
                                                                          </tr>
                                                                      </tbody>
                                                                  </table>
                                                              </div>
                                                          </div>
                                                          <!-- end of table col-lg-6 -->
                                                      </div>
                                                      <!-- end of row -->
                                                  </div>
                                                  <!-- end of general info -->
                                              </div>
                                              <!-- end of col-lg-12 -->
                                          </div>
                                          <!-- end of row -->
                                      </div>
                                      
                                  </div>
                                  <!-- end of card-block -->
                              </div>
                      </div>
                      <!-- tab content end -->
                  </div>
              </div>
          </div>
          <!-- Page-body end -->
      </div>
  </div>

</div>