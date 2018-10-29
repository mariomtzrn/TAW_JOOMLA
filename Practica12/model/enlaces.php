<?php
  class EnlacesPagina  {
    //Una funcion con el parametro $enlacesModel que se recibe a traves del
    //controlador
    public function enlacesPaginasM($enlacesModel){
      //Validamos
      if ($enlacesModel == 'User'  || $enlacesModel == 'log_out'  || $enlacesModel == 'Editar' 
         || $enlacesModel == 'Inventario'  || $enlacesModel == 'Perfil'   || $enlacesModel == 'Eliminar'
         || $enlacesModel == 'Categorias'  || $enlacesModel == 'Producto') {
        //Mostramos el uril concatenado con $enlacesModel
        $module = 'views/pages/' . $enlacesModel . '.php';
        //Una vez que que action viene vacia (validando en el controlador)
        //entonces se consulta si la variable $enlacesModel es igual a la cadena
        //index, para, de ser asi, se muestre index.php
      } elseif ($enlacesModel == 'index') {
        $module = 'views/pages/Inventario.php';
        //Validar una lista blanca
      } else {
        $module = 'views/pages/Inventario.php';
      }
      return $module;
    }
  }
?>