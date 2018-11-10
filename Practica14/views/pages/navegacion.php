<!-- Begin Main Navigation -->

<?php
  if($_SESSION["tipo"]==2){
?>
<ul class="list-unstyled">
    <li><a href="index.php?action=dashboard"><i class="la la-dashboard"></i><span>Dashboard</span></a></li>
    <li><a href="index.php?action=ComoLlegar"><i class="la la-map-marker"></i><span>Como Llegar</span></a></li>
    <li><a href="index.php?action=usuarioHorario"><i class="ti ti-timer"></i><span>Horario</span></a></li>
    <li><a href="index.php?action=usuarioactContra"><i class="la la-unlock"></i><span>Actualizar Contraseña</span></a></li>
    <li><a href="index.php?action=usuarioAcerca"><i class="ti ti-info-alt"></i><span>Acerca de</span></a></li>
</ul>
<?php
  }
  if($_SESSION["tipo"]==1){
?>
  <ul class="list-unstyled">
  <li><a href="index.php?action=dashboard"><i class="la la-dashboard"></i><span>Dashboard</span></a></li>
   <li><a href="index.php?action=usuarios"><i class="la la-user"></i><span>Usuarios</span></a></li>
    <li><a href="index.php?action=Horarios"><i class="ti ti-timer"></i><span>Horarios</span></a></li>
    <li><a href="index.php?action=Promociones"><i class="la la-trophy"></i><span>Promociones</span></a></li>
  </ul>
  
  <?php
  }
?>

<!-- End Side Navbar -->