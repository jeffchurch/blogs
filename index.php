<?php

    //require the autoload file
    require_once('vendor/autoload.php');
    //create an instance of the Base class
    $f3 = Base::instance();
    $f3->set('DEBUG', 3);
    //Define a default route
    $blogsDB = new blogsDB();
    
    $f3->route('GET /', function() {
        $view = new View;
        echo $view->render('pages/home.html');
    });
 
     $f3->route('GET /about', function() {
        $view = new View;
        echo $view->render('pages/about.html');
    });
     
     $f3->route('GET /login', function() {
        $view = new View;
        echo $view->render('pages/login.html');
    });
     
    $f3->route('POST /login', function() {
        $blogsDB = $GLOBALS['blogsDB'];
        if($_POST['username'] != null && $_POST['password'] != null){
        $loggedIn = $blogsDB->checkUserNamePassword($_POST['username'], $_POST['password']);
        if($loggedIn){
            echo 'logged in succesfully, welcome back!';
        }
        }
        $view = new View;
        echo $view->render('pages/login.html');
    });
     
      $f3->route('GET /create', function() {
        $view = new View;
        echo $view->render('pages/createaccount.html');
    }); 
       $f3->route('POST /create', function() {
        if($_POST['password'] == $_POST['password2']){
        if($_POST['username'] != null && $_POST['password'] != null && $_POST['picture'] != null && $_POST['bio'] != null){
            $blogger = new blogger($_POST['username'], $_POST['password'], $_POST['picture'], $_POST['bio']);
            session_start();
            $_SESSION['username'] = $blogger->getUsername();
            $blogsDB->addBlogger($blogger->getUsername(), $blogger->getPassword(), $blogger->getPicture(), $blogger->getBio());
        }
        } else{
            echo "Passwords did not match!!";
        }
        $view = new View;
        echo $view->render('pages/createaccount.html');
    });
    $f3->route('GET /logout', function() {
        $view = new View;
        echo $view->render('pages/logout.html');
    }); 
    
    $f3->route('GET /user', function($f3) {
        $blogsDB = $GLOBALS['blogsDB'];
        $id =1;
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
        }
        $blogs = $blogsDB->blogsByUser($id);
        $f3->set('blogs', $blogs);
        $view = new View;
        echo Template::instance()->render('pages/user.html');
    });
    
    $f3->route('GET /createblog', function() {
        print_r($_SESSION);
        $view = new View;
        echo $view->render('pages/newblog.html');
    });
    
    $f3->route('POST /createblog', function($f3) {
        $blogsDB = $GLOBALS['blogsDB'];
        if($_POST['blog_title'] != null && $_POST['blog_text'] != null && $_POST['blogger_id'] != null){
            header('Location: http://jchurch.greenrivertech.net/328/blogs/');
            $newBlog = new blogPost($_POST['blog_title'], $_POST['blog_text'], $_POST['blogger_id']);
            $blogsDB->addBlog($newBlog->getTitle(), $newBlog->getText(), $newBlog->getBlogger());
        }
        $view = new View;
        echo $view->render('pages/newblog.html');
    }); 
       
    //Run fat free    
    $f3->run();
    
?>