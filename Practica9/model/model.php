<?php
  class EnlacesPagina  {
    //Una funcion con el parametro $enlacesModel que se recibe a traves del
    //controlador
    public function enlacesPaginasModel($enlacesModel){
      //Validamos
      if ($enlacesModel == 'dashboard' || $enlacesModel == 'log_out' ||
      $enlacesModel == 'EditarAlumno' || $enlacesModel == 'Alumnos') {
        //Mostramos el uril concatenado con $enlacesModel
        $module = 'views/modules/' . $enlacesModel . '.php';
        //Una vez que que action viene vacia (validando en el controlador)
        //entonces se consulta si la variable $enlacesModel es igual a la cadena
        //index, para, de ser asi, se muestre index.php
      } elseif ($enlacesModel == 'index') {
        $module = 'views/modules/dashboard.php';
        //Validar una lista blanca
      } else {
        $module = 'views/modules/dashboard.php';
      }
      return $module;
    }
  }
?>
