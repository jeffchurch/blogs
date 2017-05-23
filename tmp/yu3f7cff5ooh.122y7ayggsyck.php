<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name ="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/styles.css">
	<title>Blogs</title>
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
		<div class="row col-md-11 col-xs-11 page-container">
		<div class ="row">
			<!-- some sort of for each loop here-->
			<?php foreach (($allBloggers?:[]) as $row): ?>
             <?php foreach (($row?:[]) as $key=>$value): ?>
				<div class ="card-box col-md-4 col-sm-6">
			    <div class="card">
				<img src ="images/user.png" id="bloggerPhoto">
				<p class="center"><?= $value["username"] ?></p>
				<p id="doubleBorder" class="extend">
					<a href ="/328/blogs/user?id=<?= $key ?>">View Blogs</a>
					<span class="pull-right">Total : <?= $blogCount[$key]['COUNT(blogger_id)'] ?></span>
				</p>
				<p>Something from my latest blog: <?= $allRecents[$key]['blog_text'] ?> </p>
				
			</div>
			</div>
				<?php if (($key+1) % 3 === 0): ?>
					</div>
				<?php endif; ?>
			 <?php endforeach; ?>
			<?php endforeach; ?>
		
		
		</div>
    </body>
</html>