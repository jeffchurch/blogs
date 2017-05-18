<?php
class blogger
{
    protected $username;
    protected $password;
    protected $picture;
    protected $bio;
    
    function __construct($username, $password, $picture, $bio){
        $this->username = $username;
        $this->password = $password;
        $this->picture = $picture;
        $this->bio = $bio;
    }
    
    function getUsername(){
        return $this->username;
    }
    
    function getPassword(){
        return $this->password;
    }
    
    function getPicture(){
        return $this->picture;
    }
    
    function getBio(){
        return $this->bio;
    }
}