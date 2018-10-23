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
          <h3>Book Delete Form</h3>
          <p>Please fill up the following form to delete book</p>
          <div class="ui stacked content">
            <div class="field">
              <label for="title">Do you really want to delete the book <?php echo $book[0]["title"]; ?>?</label>
            </div>
            <div class="field">
            </div>
            <div class="field">
              <select name="choice">
                <option value="yes">Yes</option>
                <option value="no" selected>No</option>
              </select>
            </div>
            <input type="hidden" name="page" value="book_delete">
            <input type="hidden" name="caller" value="self">
            <input type="hidden" name="id" value="<?php echo $book[0]["id"]; ?>">
            <input type="submit" value="Delete" class="ui fluid large teal submit button">
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
        <h3>Book deleted</h3>
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
