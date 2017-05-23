<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name ="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/styles.css">
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
		<div class="row col-md-11 col-xs-11 page-container">
            
            <div id="blog_title"><strong><?= $blog_title ?></strong></div>
            <hr>
            <div class="col-md-9 col-xs-9" id="blog_body"><?= $blog_text ?></div><img src="images/user.png" id="blog_pic" class="col-md-1 col-xs-1">