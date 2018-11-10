<?php
  class EnlacesPagina  {
    //Una funcion con el parametro $enlacesModel que se recibe a traves del
    //controlador
    public function enlacesPaginasModel($enlacesModel){
      //Validamos
      if ($enlacesModel == 'dashboard'  || $enlacesModel == 'dashboard2' || $enlacesModel == 'usuarios'  
          || $enlacesModel == 'log_out' || $enlacesModel == 'Horarios'   || $enlacesModel == 'Promociones' 
          || $enlacesModel == 'Equipo'  || $enlacesModel == 'Perfil' 
          || $enlacesModel == 'ComoLlegar' || $enlacesModel == 'usuarioHorario'    || $enlacesModel == 'usuarioactContra' 
          || $enlacesModel == 'usuarioAcerca' || $enlacesModel == 'usuarioVisitas' || $enlacesModel == 'usuarioPremios' 
          || $enlacesModel == 'usuarioPromos' || $enlacesModel == 'Clima') {
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