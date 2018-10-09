<?php
  class EnlacesPagina  {
    //Una funcion con el parametro $enlacesModel que se recibe a traves del
    //controlador
    public function enlacesPaginasModel($enlacesModel){
      //Validamos
      if ($enlacesModel == 'log_out' || $enlacesModel == 'login' ||
      $enlacesModel == 'usuarios' || $enlacesModel == 'registrarse' || $enlacesModel == 'EditarUsuario'
         || $enlacesModel == 'delete') {
        //Mostramos el uril concatenado con $enlacesModel
        $module = 'view/modules/' . $enlacesModel . '.php';
        //Una vez que que action viene vacia (validando en el controlador)
        //entonces se consulta si la variable $enlacesModel es igual a la cadena
        //index, para, de ser asi, se muestre index.php
      } elseif ($enlacesModel == 'index') {
        $module = 'view/modules/inicio.php';
        //Validar una lista blanca
      } else {
        $module = 'view/modules/inicio.php';
      }
      return $module;
    }


  }
?>
