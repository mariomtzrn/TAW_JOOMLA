
<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <div class="modal-header">
              <h3>Editar <?php echo $_GET["select"]?></h3>
           </div>
           <div class="modal-body">
          <form method="POST" enctype="multipart/form-data">
            <?php
           if($_GET["select"] == "Categoria"){
              $mvc = new mvc_controller();
              $mvc -> editarCategoriaC();
              $mvc -> actualizarCategoriaC();
              $direccion="index.php?action=Categorias" ;
             }
            if($_GET["select"] == "Usuario"){
              $mvc = new mvc_controller();
              $mvc -> editarUsuarioC();
              $mvc -> actualizarUsuarioC();
              $direccion="index.php?action=User" ;
             }
                if($_GET["select"] == "Producto"){
              $mvc = new mvc_controller();
              $mvc -> editarProductoC();
              $mvc -> actualizarProductoC();
              $direccion="index.php?action=Inventario" ;
             }
            ?>
  
       </div>
           <div class="modal-footer">
                <?php echo '<a href= "'.$direccion.' " class="btn btn-danger">Salir</a>'?>
               <button type="submit" class="btn btn-primary">Actualizar</button>
           </div>
           
    </form> 
      </div>
   </div>
  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
   <script>
      $(document).ready(function()
      {
         $("#default-Modal").modal("show");
      });
    </script>
<?php
#}
?>