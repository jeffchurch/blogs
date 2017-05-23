<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name ="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/styles.css">
	<title>My Blogs</title>
	<?php if ($_SESSION['blogger_id'] === $id): ?>
		<?php else: ?><meta http-equiv="refresh" content="1; URL='http://jchurch.greenrivertech.net/328/blogs/myblogs?id=<?= $_SESSION['blogger_id'] ?>'" /><?= $id ?>
	
	<?php endif; ?>
	</head>
    <body>
		<?php if (!isset($_SESSION['username'])): ?>
            
        <div class= "container col-sm-1" id="navi">
      <ul class="nav nav-stacked">
        Blog Site<br/>
        <img src="images/trumpet.png" id="trumpet"/><br/>
        <a href="http://jchurch.greenrivertech.net/328/blogs/">Home </a>><br/>
        <a href="http://jchurch.greenrivertech.net/328/blogs/create">Become a Blogger </a>><br/>
        <a href="http://jchurch.greenrivertech.net/328/blogs/about">About us </a>><br/>
        <a href="http://jchurch.greenrivertech.net/328/blogs/login">Login </a>><br/>
      </ul>    
        </div>
        <?php else: ?>
		<div class= "container col-sm-1" id="navi">
      <ul class="nav nav-stacked">
        Blog Site<br/>
        <img src="images/trumpet.png" id="trumpet"/><br/>
        <a href="http://jchurch.greenrivertech.net/328/blogs/">Home </a>><br/>
        <a href='http://jchurch.greenrivertech.net/328/blogs/myblogs?id='>My Blogs </a>><br/>
		<a href="http://jchurch.greenrivertech.net/328/blogs/createblog">Create Blog </a>><br/>
        <a href="http://jchurch.greenrivertech.net/328/blogs/about">About us </a>><br/>
        <a href="http://jchurch.greenrivertech.net/328/blogs/logout">Logout </a>><br/>
      </ul>    
        </div>
		
        <?php endif; ?>
        <div class="col-sm-8 col-lg-8 col-xs-8" id="loginHeader">
        <h1>My blogs</h1>
        <img src="images/user.png" id="loginLock"><br/>
        </div>
		<div class ="grid">
        <div class ="row">
			<div class="container col-sm-8">
				<table class ="table">
					<tr><th>Blog</th>
					<th>Update</th>
					<th>Delete</th> </tr>
					
					<?php foreach (($blogs?:[]) as $row): ?>
					<?php foreach (($row?:[]) as $key=>$value): ?>
					<?php foreach (($value?:[]) as $key2=>$value2): ?>
					<tr><td><a href ="http://jchurch.greenrivertech.net/328/blogs/blog?blog=<?= $value2 ?>"><?= $value2 ?></a></td>
					<td><img src="images/update.JPG"></td>
					<td><a href ="http://jchurch.greenrivertech.net/328/blogs/delete?delete=<?= $value2 ?>"><img src="images/delete.JPG"></a></td></tr>
					
				<?php endforeach; ?>
              <?php endforeach; ?>
              <?php endforeach; ?>
				</table>
			</div>
			<div class="container col-sm-2">
				<?= $username ?><br/>
				<hr>
				Bio : <?= $bio.PHP_EOL ?>
		</div>
			 </div>
		