<?php 
	include_once "header.php";
	if($logged_in)
	{
		$after_login=true;
		include_once "menu.php";
?>
  <div class="ui container" style="padding-left:50px; padding-right:50px; padding-top:20px;">
		<table border="1" width="50%" align="center" class="ui selectable celled table">
			<tr align="center">
				<th>Title</th>
				<th>Author</th>
				<th>Description</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
<?php
		foreach($books as $book)
		{
?>
			<tr>
				<td><?php echo $book["title"]; ?></th>
				<td><?php echo $book["author"]; ?></th>
				<td><?php echo $book["description"]; ?></th>
				<td><a href="index.php?page=book_edit&id=<?php echo $book["id"]; ?>"><i class="edit icon">Edit</i></a></th>
				<td><a href="index.php?page=book_delete&id=<?php echo $book["id"]; ?>"><i class="delete icon">Delete</i></a></th>
			</tr>
<?php
		}
?>
		</table>
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
