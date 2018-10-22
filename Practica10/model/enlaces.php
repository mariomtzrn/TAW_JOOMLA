<?php
  class EnlacesPagina  {
    //Una funcion con el parametro $enlacesModel que se recibe a traves del
    //controlador
    public function enlacesPaginasModel($enlacesModel){
      //Validamos
      if ($enlacesModel == 'dashboard'  || $enlacesModel == 'log_out'  || $enlacesModel == 'Editar' 
         || $enlacesModel == 'Alumnos'  || $enlacesModel == 'Perfil'   || $enlacesModel == 'Delete'
         || $enlacesModel == 'Tutores'  || $enlacesModel == 'Carreras' || $enlacesModel == 'Tutorias'
         || $enlacesModel == 'Historial') {
        //Mostramos el uril concatenado con $enlacesModel
        $module = 'views/pages/' . $enlacesModel . '.php';
        //Una vez que que action viene vacia (validando en el controlador)
        //entonces se consulta si la variable $enlacesModel es igual a la cadena
        //index, para, de ser asi, se muestre index.php
      } elseif ($enlacesModel == 'index') {
        $module = 'views/pages/dashboard.php';
        //Validar una lista blanca
      } else {
        $module = 'views/pages/dashboard.php';
      }
      return $module;
    }
  }
?>