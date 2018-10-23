<?php
	include_once "header.php";
	$before_login=true;
	include_once "menu.php";
?>
<?php
  if($status=="before_submission" or $status=="failure")
  {
?>
<div class="ui middle aligned center aligned grid" style="padding-top:100px;">
	<div class="column" style="max-width:450px;">
		<h2 class="ui teal image header">
			<div class="content">
				BMS
			</div>
		</h2>
		<form class="ui form" method="post">
			<div class="ui stacked segment">
				<h3>Log in</h3>
				<div class="field">
					<div class="ui left icon input">
						<i class="user icon"></i>
						<input type="text" name="username" value="<?php echo $_REQUEST["username"]; ?>">
						<font color="red"><?php echo $errors["username"]; ?></font>
					</div>
				</div>
				<div class="field">
					<div class="ui left icon input">
						<i class="lock icon"></i>
						<input type="password" name="password">
						<font color="red"><?php echo $errors["password"]; ?></font>
					</div>
				</div>
				<input type="hidden" name="page" value="login">
				<input type="hidden" name="caller" value="self">
				<input type="submit" value="Sign in" class="ui fluid large teal submit button">
			</div>
		</form>
<?php
	}
	else
	{ ?>
		<form method="post">
			<input type="hidden" name="username" id="username" value="<?php echo $_REQUEST["username"]; ?>">
			<input type="hidden" name="password" id="password" value="<?php echo $_REQUEST["password"]; ?>">
			<input type="hidden" name="page" value="home">
		</form>
		<script>
			document.forms[0].submit();
		</script>
<?php	}
?>
		<div class="ui message">
			<a href="index.php?page=register">Register</a>
		</div>
	</div>
</div>
<?php
	include_once "footer.php";
?>
