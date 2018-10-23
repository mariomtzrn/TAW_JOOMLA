<?php 
	include_once "header.php";
	if($logged_in)
	{
		$after_login=true;
		include_once "menu.php";
?>

<div class="ui middle aligned center aligned grid" style="padding-top:150px;">  
  <div class="card" style="background:white; padding:20px">
    <h3>Welcome to Home Page</h3>
  </div>
</div>

<?php
	}
	else
	{
		$before_login=true;
		include_once "menu.php";
?>
<div class="ui middle aligned center aligned grid" style="padding-top:150px;">  
  <div class="card" style="background:white; padding:20px">
    <h3>Invalid log in</h3>
  </div>
</div>
<?php
	}
	include_once "footer.php";
?>
