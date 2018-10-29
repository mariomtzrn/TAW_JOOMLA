<?php

$mvc =  new mvc_controller();
$respuesta=$mvc -> perfilC("productos");
?>

<div class="pcoded-inner-content">

    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
        <!-- Page-header start -->
            <div class="page-header card">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="icofont icofont-barcode bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Producto</h4>
                                <span>Detalles de Productos | Historal</span>
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
                        <li class="breadcrumb-item"><a href="#">Producto</a>
                        </li>
                    </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Product detail page start -->
                        <div class="card product-detail-page">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-lg-5 col-xs-12">
                                        <div class="port_details_all_img row">
                                            <div class="col-lg-12 m-b-15">
                                                <div id="big_banner">
                                                    <div class="port_big_img">
                                                        <center><img class="img img-fluid" 
                                                             width="200px" height="200px"
                                                             src="<?php echo $respuesta['imagen'] ?> " alt="Big_ Details">
                                                          </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 product-right">
                                                <center>
                                                   <a href="index.php?action=Inventario">
                                                     <button type="button" class="btn btn-default">
                                                     <i class="icofont icofont-arrow-left"></i></button></a>
                                                     <a href="index.php?action=Editar&id=<?php echo $respuesta['id'] ?>&select=Producto">
                                                   <button type="button" class="btn btn-success">
                                                    <i class="icofont icofont-ui-edit"></i></button></a>
                                                  <a href="index.php?action=Eliminar&idBorrar=<?php echo $respuesta['id'] ?>&select=Producto">
                                                   <button type="button" class="btn btn-inverse">
                                                    <i class="icofont icofont-delete-alt"></i></button></a>
                                                   </center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-xs-12 product-detail" id="product-detail">
                                        <div class="row">
                                            <div>  
                                              <div class="col-lg-12">
                                                <table>
                                                  <tr>
                                                    <td><span class="txt-muted d-inline-block">Codigo de Producto: <?php echo $respuesta['codigo'] ?> </span>
                                                    </td>
                                                    <td> <input type="text" style="border: 0; background-color: #ffff; width:215px;" 
                                                                disabled></td>
                                                    <td> <span class="f-right">Stock : <?php echo $respuesta['stock'] ?> </span></td>
                                                  </tr>
                                                </table>
                                              </div>
                                               <div class="col-lg-12">
                                                 <table>
                                                  <tr>
                                                    <td>
                                                    <span class="txt-muted"> Categoria : <?php echo $respuesta['categoria'] ?> </span>
                                                    </td>
                                                    <td> <input type="text" style="border: 0; background-color: #ffff; width:300px;" 
                                                                disabled></td>
                                                    <td><span class="txt-muted"> Agregado : <?php echo $respuesta['fecha'] ?> </span></td>
                                                  </tr>
                                                </table>
                                                </div>
                                                <div class="col-lg-12">
                                                   <h1><b><?php echo $respuesta['nombre'] ?></b></h1>
                                                </div>
                                               
                                                <div class="col-lg-12">
                                                    <span class="text-primary product-price"><i class="icofont icofont-cur-dollar"></i>
                                                     <?php echo $respuesta['precio'] ?></span> 
                                                  <br></br>
                                                </div>
                                                <div class="col-lg-12 col-sm-12 mob-product-btn">
                                                    <center>
                                                  <table>
                                                  <tr>
                                                    <td><button type="button" class="btn btn-primary btn-xlg waves-effect" 
                                                              data-toggle="modal" data-target="#agregar">
                                                     <i class="icofont icofont-inbox"></i>Agregar</button></a>
                                                    </td>
                                                    <td> 
                                                      <input type="text" style="border: 0; background-color: #ffff; width:20px;" disabled>
                                                    </td>
                                                    <td><button type="button" class="btn btn-primary btn-xlg waves-effect" 
                                                              data-toggle="modal" data-target="#eliminar">
                                                        <i class="icofont icofont-box"></i>Eliminar</button></td>
                                                  </tr>
                                                </table></center>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product detail page end -->
                    </div>
                </div>

        <div class="card">
              <div class="card-block">
                  <div class="dt-responsive table-responsive">
                      <table id="simpletable"
                             class="table table-striped table-bordered nowrap">
                          <thead>
                          <tr>
                              <th>Fecha</th>
                              <th>Hora</th>
                              <th>Descripción</th>
                              <th>Referencia</th>
                              <th>Total</th>
                          </tr>
                          </thead>
                          <tbody>
                               <?php
                                  $vistaH = new mvc_controller();
                                  $vistaH -> vistaHistorailC();
                                  ?>
                          </tbody>

                      </table>
                  </div>
              </div>
        </div>
  
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="agregar" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Ageragr Stock</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cantidad</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="cantidadA" id="cantidadA" placeholder="cantidad">

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Referencia</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="referencia" id="referencia" placeholder="Referencia">
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


<div class="modal fade" id="eliminar" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Eliminar Stock</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cantidad</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="cantidadE" id="cantidadE" placeholder="cantidad">

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Referencia</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="referencia" id="referencia" placeholder="Referencia">
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
$regiistroH = new mvc_controller();
$regiistroH -> registroHistoralAC();
$regiistroH -> registroHistoralEC();
?>