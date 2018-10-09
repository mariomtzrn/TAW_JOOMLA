<?php
session_start();
  error_reporting(0);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MVC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">       
    <style media="screen">
      header {
        position: relative;
        margin: auto;
        text-align: center;
        padding: 5px;
      }
      nav {
        position: relative;
        margin: auto;
        width: 100%;
        height: auto;
        background: black;
      }
      nav ul {
        position: relative;
        margin: auto;
        width: 50%;
        text-align: center;
      }
      nav ul li {
        display: inline-block;
        width: 24%;
        line-height: 50px;
        list-style: none;
      }
      nav ul li a {
        color: white;
        text-decoration: none;
      }
      section {
        position: relative;
        padding: 20%;
      }
    </style>
  </head>
     <body>
    <header>
      <h1>TAW: PHP-MVC</h1>
    </header>
      <?php
        include('modules/navigation.php');
        //Mostraremos un controlador que muestra la plantilla
        $mvc = new mvc_controller();
        //Mostramos la funcion
        $mvc->enlaces_paginas_controller();

      ?>

  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>

