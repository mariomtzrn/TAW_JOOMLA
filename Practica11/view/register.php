<?php
	include_once "header.php";
	$before_login=true;
	include_once "menu.php";
?>

<?php
	if($status=="before_submission" or $status=="failure")
	{
?>
		<div class="container" style="padding-top:50px">
			<div class="ui raised very padded text container segment">
				<h3 class="ui header centered">User registration</h3>
				<form class="ui form" method="post" action="">
					<p>Please fill up the following form to register yourself:</p>
					<div class="field" style="padding-left:50px; padding-right:50px">
						<label for="name">Name</label>
						<input type="text" name="name" id="name" value="<?php echo $_REQUEST["name"]; ?>">
						<font color="red"><?php echo $errors["name"]; ?></font>
						<br>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" value="<?php echo $_REQUEST["username"]; ?>">
						<font color="red"><?php echo $errors["username"]; ?></font>
						<br>
						<label for="password">Password</label>
						<input type="password" name="password" id="password">
						<font color="red"><?php echo $errors["password"]; ?></font>
						<br>
						<input type="hidden" name="page" value="register">
						<input type="hidden" name="caller" value="self">
					</div>
					<div class="field" style="padding-left:50px; padding-right:50px">
						<input type="submit" class="ui fluid large teal submit button" value="Sign Up">
					</div>
				</form>
			</div>
		</div>
<?php
	}
	else
	{
?>
		<div class="container" style="padding-top:50px">
			<div class="ui raised very padded text container segment">
				<h3 class="ui header centered">Registration successful</h3>
			</div>
		</div>
<?php
	}
?>

<?php
	include_once "footer.php";
?>
