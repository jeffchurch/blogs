<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name ="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/styles.css">
    <script type="text/javascript" src="js/scripts.js"></script>
	<title>blog</title>
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
        
        <div class="col-sm-8" id="loginHeader">
        <h2><?= $username ?>'s Blogs</h2>
        </div>
		<div class="row col-md-11 col-xs-11 page-container">
             <div class="row col-sm-10 col-md-10 col-lg-10">
             <a href="http://jchurch.greenrivertech.net/328/blogs/blog?blog=<?= $recent[blog_title] ?>"><h4>My most recent blog:</h4></a>
             <?= $recent[blog_title] ?>: <?= $recent["blog_text"] ?><br/>
            </div>
            <div class= "container col-sm-1" id="navi">
               <img src ="images/user.png" id="userPhoto">
               <?= $username.PHP_EOL ?>
               <hr>
               Bio: <?= $bio.PHP_EOL ?>
            </div>
        </div>
        <div class="row col-md-11 col-xs-11 page-container">
            <h4>My blogs:</h4>
              <?php foreach (($blogs?:[]) as $row): ?>
             <?php foreach (($row?:[]) as $key=>$value): ?>
                <?php if ($value[blog_title]  ==  $recent[blog_title]): ?>
                <?php else: ?><a href="http://jchurch.greenrivertech.net/328/blogs/blog?blog=<?= $value[blog_title] ?>"><?= $value[blog_title] ?></a> - word count
                 <script language="javascript">
                  document.write(WordCount("<?= $value[blog_text] ?>"));</script>
                -<?= $value[blog_date] ?> <br/>
                <?= $value[blog_text] ?> <br/><br/>
                <?php endif; ?>
              <?php endforeach; ?>
              <?php endforeach; ?>
        </div>
    </body> 