<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Practica 9</title>
        <link type="text/css" href="views/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="views/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="views/css/theme.css" rel="stylesheet">
        <link type="text/css" href="views/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
      
    </head>
   <?php
    //verificamos si se encuentra logeado
      /*if(isset($_SESSION["validar"]))
      {*/
      ?>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="template.html">Practica  9</a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav nav-icons">
                            <li class="active"><a href="#"><i class="icon-envelope"></i></a></li>
                            <li><a href="#"><i class="icon-eye-open"></i></a></li>
                            <li><a href="#"><i class="icon-bar-chart"></i></a></li>
                        </ul>
                        <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3">
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                        </form>
                        <ul class="nav pull-right">
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Item No. 1</a></li>
                                    <li><a href="#">Don't Click</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Example Header</li>
                                    <li><a href="#">A Separated link</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Support </a></li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/user.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li>
                                    <li><a href="#">Account Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                  <div class="span3">
                        <div class="sidebar">
                  <?php
      
                   include('modules/navegacion.php');
                   ?>
                    </div> 
                     </div> 
                    <div class="span9">
                  <div class="content">
                <?php
                    //Mostraremos un controlador que muestra la plantilla
                    $mvc = new mvc_controller();
                    //Mostramos la funcion
                    $mvc->enlaces_paginas_controller();
                  ?>     
                </div>
                    </div>      
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2014 Edmin - EGrappler.com </b>All rights reserved.
            </div>
        </div>
        <script src="views/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="views/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="views/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="views/scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="views/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="views/scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="views/scripts/common.js" type="text/javascript"></script>
        <script src="views/scripts/jquery-1.9.1.min.js"></script>
        <script src="views/scripts/jquery-ui-1.10.1.custom.min.js"></script>
        <script src="views/bootstrap/js/bootstrap.min.js"></script>
        <script src="views/scripts/datatables/jquery.dataTables.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script>
          $(document).ready(function() {
            $('.datatable-1').dataTable();
            $('.dataTables_paginate').addClass("btn-group datatable-pagination");
            $('.dataTables_paginate > a').wrapInner('<span />');
            $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
            $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
            
          } );
          // In your Javascript (external .js resource or <script> tag)
          $(document).ready(function() {
              $('.js-example-basic-single').select2();
          });
        </script>
      
    </body>
  <?php
/*}
if (!isset($_SESSION["id"])) {

       include "modules/login.php";
    }*/
?>

