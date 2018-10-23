<?php
	if($before_login)
	{
?>
<div class="ui attached stackable menu">
  <div class="ui container">
    <a class="item" href="index.php?page=index">
      <i class="home icon"></i> Home
    </a>
    <a class="item" href="index.php?page=register">
      <i class="archive icon"></i> Register
    </a>
    <a class="item" href="index.php?page=login">
      <i class="user icon"></i> Log in
    </a>
		<a class="item" href="index.php?page=forgot_password">
      <i class="key icon"></i> Forgot password
    </a>
  </div>
</div>
<?php
	}
	else if($after_login)
	{
?>
<div class="ui attached stackable menu">
  <div class="ui container">
    <a class="item" href="index.php?page=home">
      <i class="home icon"></i> Home
    </a>
    <a class="item" href="index.php?page=profile">
      <i class="user icon"></i> Profile
    </a>
    <a class="item" href="index.php?page=book_add">
      <i class="book icon"></i> Add book
    </a>
		<a class="item" href="index.php?page=book_list">
      <i class="list alternate icon"></i> Book list
    </a>
		<a class="item" href="index.php?page=logout">
      <i class="sign out icon"></i> Log out
    </a>
  </div>
</div>
<?php
	}
?>
