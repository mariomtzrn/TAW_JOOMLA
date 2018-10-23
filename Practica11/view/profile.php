<?php 
	include_once "header.php";
	if($logged_in)
	{
		$after_login=true;
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
          <h3>Profile Update Form</h3>
          <p>Please fill up the following form to update your profile</p>
          <p>[Fill up only if you want to change it]</p>
          <div class="ui stacked content">
            <div class="field">
              <label for="name">Name</label>
			        <input type="text" name="name" id="name" value="<?php echo $profile[0]["name"]; ?>">
			        <font color="red"><?php echo $errors["name"]; ?></font>
            </div>
            <div class="field">
              <label for="username">Username</label>
			        <input type="text" name="username" id="username" value="<?php echo $profile[0]["username"]; ?>" readonly="true">
			        <font color="red"><?php echo $errors["username"]; ?></font>
            </div>
            <div class="field">
              <label for="password">Password</label>
			        <input type="password" name="password" id="password">
			        <font color="red"><?php echo $errors["password"]; ?></font>
            </div>
            <input type="hidden" name="page" value="profile">
			      <input type="hidden" name="caller" value="self">
            <input type="submit" value="Update" class="ui fluid large teal submit button">
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
        <h3>Profile Updated</h3>
      </div>
    </div>
<?php
		}
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
