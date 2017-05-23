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
            $_COOKIE['blogger_id'] = $_SESSION['blogger_id'];
            return true;
           }else{
            //login failed
            return false;
           }      
        }
        
        function getMyID($userName)
        {
          $select = "SELECT blogger_id FROM bloggers WHERE username ='$userName' ";
            $results = $this->_pdo->query($select);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        function addBlog($title, $text, $id, $date)
        {
           $insert = 'INSERT INTO blogs (blog_title, blog_text, blogger_id, blog_date)
           VALUES(:title, :text, :id, :date)';
           
           $statement = $this->_pdo->prepare($insert);
           $statement->bindValue(':title', $title, PDO::PARAM_STR);
           $statement->bindValue(':text', $text, PDO::PARAM_STR);
           $statement->bindValue(':id', $id, PDO::PARAM_INT);
           $statement->bindValue(':date', $date, PDO::PARAM_INT);
           
           $statement->execute();
        }

        function getAllBlogs()
        {
          $select = 'SELECT * FROM blogs ORDER BY blogger_id';
          $results = $this->_pdo->query($select);
          $resultsArray = array();
          
          while($row = $results->fetchAll(PDO::FETCH_ASSOC)){
            $resultsArray[$row['blogger_id']] = $row;
          }
          return $resultsArray;
        }
        
        function getAllBloggers()
        {
          $select = 'SELECT username, blogger_id FROM bloggers ORDER BY blogger_id';
          $results = $this->_pdo->query($select);
          $resultsArray = array();
          
          while($row = $results->fetchAll(PDO::FETCH_ASSOC)){
            $resultsArray[$row['blogger_id']] = $row;
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
         $select = "SELECT blog_title, blog_text, blog_date FROM blogs WHERE blogger_id = '$id'";
         $results = $this->_pdo->query($select);
         
         while($row = $results->fetchAll(PDO::FETCH_ASSOC)){
            $resultsArray[$row['blogger_id']] = $row;
          }
         return $resultsArray;
        }
        function blogsByUserJustTitles($id)
        {
         $select = "SELECT blog_title FROM blogs WHERE blogger_id = '$id'";
         $results = $this->_pdo->query($select);
         
         while($row = $results->fetchAll(PDO::FETCH_ASSOC)){
            $resultsArray[$row['blogger_id']] = $row;
          }
         return $resultsArray;
        }
        
        function deleteBlog($title)
        {
           $delete = "DELETE FROM `blogs` WHERE `blog_title` = '$title'";
           $this->_pdo->query($delete);
        }
        
        function getUserName($id)
        {
            $select = "SELECT username FROM bloggers WHERE blogger_id = '$id'";
            $results = $this->_pdo->query($select);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            return $row['username'];
        }
        
        function getBio($id)
        {
            $select = "SELECT bio FROM bloggers WHERE blogger_id = '$id'";
            $results = $this->_pdo->query($select);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            return $row['bio'];  
        }
        
        function getBlogText($title)
        {
            $select = "SELECT blog_text FROM blogs WHERE blog_title = '$title'";
            $results = $this->_pdo->query($select);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            return $row['blog_text'];  
        }
        
        function getRecentBlog($id)
        {
         $select = "SELECT blog_title, blog_text FROM blogs WHERE blogger_id = '$id' ORDER BY blog_date DESC";
         $results = $this->_pdo->query($select);
         
         $row = $results->fetch(PDO::FETCH_ASSOC);

         return $row;
        }
        
           function getAllRecents()
        {
         $select = " SELECT * FROM (SELECT blog_text, blogger_id FROM blogs ORDER BY blog_date DESC) AS sub GROUP BY blogger_id";
         $results = $this->_pdo->query($select);
         
         $row = $results->fetchAll(PDO::FETCH_ASSOC);
        return $row;
        }
        
        function countBlogs()
        {
         $select = "SELECT COUNT(blogger_id) FROM blogs GROUP BY blogger_id";
         $results = $this->_pdo->query($select);
         
         $row = $results->fetchAll(PDO::FETCH_ASSOC);
        return $row;
         
        }
    }