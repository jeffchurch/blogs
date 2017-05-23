<?php
    //CONNECT
    /**
    * The blogsDB class represents a PDO that handles functions to manage the blogs and bloggers for my blogsite.
    * @author Jeff Church <Jchurch4@mail.greenriver.edu>
    * @copyright 2017
    */
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
        /**
         *A function to see if username and password are correct, if so, begin a session.
         *@return true if successful, false if not.
         */
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
        /**
         *A function to return the ID of a user.
         *@param the username of the user to search for.
         *@return the ID of the user.
         */
        function getMyID($userName)
        {
          $select = "SELECT blogger_id FROM bloggers WHERE username ='$userName' ";
            $results = $this->_pdo->query($select);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        /**
         *A function to create a new blog
         *@param the parameter of strings of the blog title, text, blogger id, and the current date.
         */
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
        /**
         *Returns an array of arrays containing all of the blogs.
         *@return an array of arrays containing all blogs.
         */
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
        /**
         *Returns an array of all blogger usernames and ids.
         *@return an array of blogger usernames and id's.
         */
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
        /**
         *A function to create a new blogger.
         *@param the username, password, picture, and bio for the new user.
         */
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
        /**
         *Returns an array of blogs searched by userid.
         *@param the user id of the users blogs to search for.
         *@return an array containing the blogs posted by that user.
         */
        function blogsByUser($id)
        {
         $select = "SELECT blog_title, blog_text, blog_date FROM blogs WHERE blogger_id = '$id'";
         $results = $this->_pdo->query($select);
         
         while($row = $results->fetchAll(PDO::FETCH_ASSOC)){
            $resultsArray[$row['blogger_id']] = $row;
          }
         return $resultsArray;
        }
        /**
         *A function to return only the blog titles searched by user id.
         *@param the id of the user to search for.
         *@return an array containing the blog titles posted by that user.
         */
        function blogsByUserJustTitles($id)
        {
         $select = "SELECT blog_title FROM blogs WHERE blogger_id = '$id'";
         $results = $this->_pdo->query($select);
         
         while($row = $results->fetchAll(PDO::FETCH_ASSOC)){
            $resultsArray[$row['blogger_id']] = $row;
          }
         return $resultsArray;
        }
        /**
         *A function used to delete a blog.
         *@param the blog title to be deleted.
         */
        function deleteBlog($title)
        {
           $delete = "DELETE FROM `blogs` WHERE `blog_title` = '$title'";
           $this->_pdo->query($delete);
        }
        /**
         *Returns the user name of the blogger based on their id.
         *@param the id of the user used to search their name.
         */
        function getUserName($id)
        {
            $select = "SELECT username FROM bloggers WHERE blogger_id = '$id'";
            $results = $this->_pdo->query($select);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            return $row['username'];
        }
        /**
         *A funciton to return the bio of a user, based off their id number.
         *@param the id of the user to search for.
         */
        function getBio($id)
        {
            $select = "SELECT bio FROM bloggers WHERE blogger_id = '$id'";
            $results = $this->_pdo->query($select);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            return $row['bio'];  
        }
        /**
         *A function to get the blog body searched by the blog title.
         *@param the title of the blog to search for.
         */
        function getBlogText($title)
        {
            $select = "SELECT blog_text FROM blogs WHERE blog_title = '$title'";
            $results = $this->_pdo->query($select);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            return $row['blog_text'];  
        }
        /**
         *Returns the most recent blog searched by user id.
         *@param the user id to search for the most recent blog.
         *@return the most recent blog data posted by that user.
         */
        function getRecentBlog($id)
        {
         $select = "SELECT blog_title, blog_text FROM blogs WHERE blogger_id = '$id' ORDER BY blog_date DESC";
         $results = $this->_pdo->query($select);
         
         $row = $results->fetch(PDO::FETCH_ASSOC);

         return $row;
        }
        /**
         *A function to return all of the most recently posted blogs.
         *@return an array of arrays containing all of the most recent blogs.
         */
        function getAllRecents()
        {
         $select = " SELECT * FROM (SELECT blog_text, blogger_id FROM blogs ORDER BY blog_date DESC) AS sub GROUP BY blogger_id";
         $results = $this->_pdo->query($select);
         
         $row = $results->fetchAll(PDO::FETCH_ASSOC);
        return $row;
        }
        /**
         *A function to figure out how many blogs were posted by all users.
         *@return an array of arrays containing the blog count of each user.
         */
        function countBlogs()
        {
         $select = "SELECT COUNT(blogger_id) FROM blogs GROUP BY blogger_id";
         $results = $this->_pdo->query($select);
         
         $row = $results->fetchAll(PDO::FETCH_ASSOC);
        return $row;
         
        }
    }