<?php
    //CONNECT
    class blogsDB
    {
    private $_pdo;
        /**
         *Function that creates a new PDO to manage the DB connection/
         */
         function __construct()
        {
          require_once("../../../config.php");

          try{
            //make the thing
             $this->_pdo = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
             $this->_pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
             $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
         catch(PDOException $e){
             die("Error!: ". $e->getMessage());
         } 
         

        }
        
        function checkUserNamePassword($userName, $password)
        {
            $select = "SELECT blogger_id, username, password FROM bloggers WHERE username ='$userName' AND password ='$password' ";
            $results = $this->_pdo->query($select);
            $row = $results->fetch(PDO::FETCH_ASSOC);
           if($row['username'] == $userName && $password == $row['password']){
            session_start();
            
            $_SESSION['username'] = $userName;
            $_SESSION['blogger_id'] = $row['blogger_id'];
            return true;
           }else{
            //login failed
            return false;
           }      
        }

        function addBlog($title, $text, $id)
        {
           $insert = 'INSERT INTO blogs (blog_title, blog_text, blogger_id)
           VALUES(:title, :text, :id)';
           
           $statement = $this->_pdo->prepare($insert);
           $statement->bindValue(':title', $title, PDO::PARAM_STR);
           $statement->bindValue(':text', $text, PDO::PARAM_STR);
           $statement->bindValue(':id', $id, PDO::PARAM_INT);

           
           $statement->execute();
        }

        function allBlogs()
        {
          $select = 'SELECT member_id, fname, lname, age FROM blogs ORDER BY member_id';
          $results = $this->_pdo->query($select);
          $resultsArray = array();
          
          while($row = $results->fetch(PDO::FETCH_ASSOC)){
            $resultsArray[$row['member_id']] = $row;
          }
          return $resultsArray;
        }
        
        function addBlogger($username, $password, $picture, $bio)
        {
            $insert = 'INSERT INTO bloggers (username, password, picture, bio)
           VALUES(:username, :password, :picture, :bio)';
           
           $statement = $this->_pdo->prepare($insert);
           $statement->bindValue(':username', $username, PDO::PARAM_STR);
           $statement->bindValue(':password', $password, PDO::PARAM_STR);
           $statement->bindValue(':picture', $picture, PDO::PARAM_STR);
           $statement->bindValue(':bio', $bio, PDO::PARAM_STR);
           $statement->execute();
        }
        
        function blogsByUser($id)
        {
         $select = "SELECT blogger_id, blog_title, blog_text FROM blogs WHERE blogger_id = '$id'";
         $results = $this->_pdo->query($select);
         while($row = $results->fetch(PDO::FETCH_ASSOC)){
            $resultsArray[$row['blogger_id']] = $row;
          }
         return $resultsArray;
        }
        
    }