<?php
    /**
    * The blogger class represents a user that will be blogging on the blog site..
    * @author Jeff Church <Jchurch4@mail.greenriver.edu>
    * @copyright 2017
    */
class blogger
{
    protected $username;
    protected $password;
    protected $picture;
    protected $bio;
    /**
     *A function used to construct a new blogger for the site.
     */
    function __construct($username, $password, $picture, $bio){
        $this->username = $username;
        $this->password = $password;
        $this->picture = $picture;
        $this->bio = $bio;
    }
    /**
     *A function to return the username of a blogger.
     *@return the user name to return.
     */
    function getUsername(){
        return $this->username;
    }
    /**
     *A function used to return the password of a blogger.
     *@return the password to return.
     */
    function getPassword(){
        return $this->password;
    }
    /**
     *A function used to return the picture of a blogger.
     *@return the picture to return.
     */
    function getPicture(){
        return $this->picture;
    }
    /**
     *A function to return the bio of a blogger.
     *@return the bio to return.
     */
    function getBio(){
        return $this->bio;
    }
}