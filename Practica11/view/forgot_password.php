<?php 
	include_once "header.php";
	$before_login=true;
	include_once "menu.php";
?>

<?php
	if($status=="before_submission" or $status=="failure")
	{
?>

  <div class="ui middle aligned center aligned grid" style="padding-top:50px;">
    <div class="column" style="max-width:450px;">
      <form class="ui form" method="post">
        <div class="ui stacked segment">
          <h3>Forgot Password Form</h3>
          <p>Please fill up the following form to retrieve password of your account</p>
          <div class="ui stacked content">
            <div class="field">
              <label for="username">Username</label>
			        <input type="text" name="username" id="username" value="<?php echo $_REQUEST["username"]; ?>">
			        <font color="red"><?php echo $errors["username"]; ?></font>
            </div>
            <input type="hidden" name="page" value="forgot_password">
			      <input type="hidden" name="caller" value="self">
            <input type="submit" class="ui fluid large teal submit button" value="Retrieve Password">
          </div>
        </div>
      </form>
    </div>
  </div>

<?php
	}
	else
	{
?>
    <div class="ui middle aligned center aligned grid" style="padding-top:150px;">  
      <div class="card" style="background:white; padding:20px">
		    <h3>Please check your mail for new password</h3>
      </div>
    </div>
<?php
	}
?>

<?php
	include_once "footer.php";
?>
