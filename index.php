<?php

    //require the autoload file
    require_once('vendor/autoload.php');
    session_start();
    //create an instance of the Base class
    $f3 = Base::instance();
    $f3->set('DEBUG', 3);
    //Define a default route

    
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
 
    //Run fat free    
    $f3->run();
    
?>