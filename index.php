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
            $blogsDB = $GLOBALS['blogsDB'];
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
       
    //Run fat free    
    $f3->run();
    
?>