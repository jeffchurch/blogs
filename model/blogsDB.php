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
            $userName = mysql_real_escape_string($userName); 
            $password = mysql_real_escape_string($password);
            $select = "SELECT username, password FROM bloggers WHERE username ='$userName' AND password ='$password' ";
            $results = $this->_pdo->query($select);
           if(mysql_num_rows($Results) > 0)){
            session_start();
            
            $_SESSION['username'] = $username;
            return true;
           }else{
            //login failed
            return false;
           }      
        }

        function addBlog($fname, $lname, $age)
        {
           $insert = 'INSERT INTO Blogs (fname, lname, age)
           VALUES(:fname, :lname, :age)';
           
           $statement = $this->_pdo->prepare($insert);
           $statement->bindValue(':fname', $fname, PDO::PARAM_STR);
           $statement->bindValue(':lname', $lname, PDO::PARAM_STR);
           $statement->bindValue(':age', $age, PDO::PARAM_INT);

           
           $statement->execute();
        }

        function allBlogs()
        {
          $select = 'SELECT member_id, fname, lname, age FROM Blogs ORDER BY member_id';
          $results = $this->_pdo->query($select);
          $resultsArray = array();
          
          while($row = $results->fetch(PDO::FETCH_ASSOC)){
            $resultsArray[$row['member_id']] = $row;
          }
          return $resultsArray;
        }
        
    }