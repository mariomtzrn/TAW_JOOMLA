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
                  <h4>Inventario</h4>
                  <span>Listado de Productos</span>
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
      </ul>
          </div>
      </div>
  </div>
</div>
<!-- Page-header end -->

<!-- Page body start -->
<div class="page-body">
  <!-- Product list start -->
<div class="card">
    <div class="card-header">
      <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#default-Modal">Nuevo Producto</button>  
      <div class="card-header-right"><i
                class="icofont icofont-spinner-alt-5"></i></div>
    </div>
  </div>
  <div class="row">
    <?php
$ver =  new mvc_controller();
$ver -> vistaProductoC();
?>
   </div>

  <!-- Product list end -->
</div>
<!-- Page body end -->
</div>
</div>
</div>

<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                   <form method="post" enctype="multipart/form-data" >
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Codigo</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="codigo" id="codigo" required placeholder="Codigo">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nombre">

                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Categoria</label>
                        <div class="col-sm-10">

                      <select class="form-control select2" required name="categoria">
                        <?php
                        $mvc= new mvc_controller();
                         $mvc-> SelectC("categorias");
                            ?>
                      </select>

                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Precio</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="precio" id="precio" required placeholder="Precio">

                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Stock</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="stock" id="stock" required placeholder="Stock">

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
$registro -> registroProductoC();
?>
