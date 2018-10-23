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
          <h3>Book Add Form</h3>
          <p>Please fill up the following form to add new book</p>
          <div class="ui stacked content">
            <div class="field">
              <label for="title">Title</label>
              <input type="text" name="title" id="title" value="<?php echo $_REQUEST["title"]; ?>">
              <font color="red"><?php echo $errors["title"]; ?></font>
            </div>
            <div class="field">
              <label for="author">Author</label>
              <input type="text" name="author" id="author" value="<?php echo $_REQUEST["author"]; ?>">
              <font color="red"><?php echo $errors["author"]; ?></font>
            </div>
            <div class="field">
              <label for="description">Description</label>
              <input type="text" name="description" id="description" value="<?php echo $_REQUEST["description"]; ?>">
              <font color="red"><?php echo $errors["description"]; ?></font>
            </div>
            <input type="hidden" name="page" value="book_add">
            <input type="hidden" name="caller" value="self">
            <input type="submit" class="ui fluid large teal submit button" value="Save">            
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
        <h3>Book saved</h3>
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
