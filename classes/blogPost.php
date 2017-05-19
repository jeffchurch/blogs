<?php

   class blogPost
   {
   protected $blog_title;
   protected $blog_text;
   protected $blogger_id;
   
   function __construct($blog_title, $blog_text, $blogger_id){
      $this->blog_title = $blog_title;
      $this->blog_text = $blog_text;
      $this->blogger_id = $blogger_id;
   }
   
   function getTitle(){
      return $this->blog_title;
   }
   
   function getText(){
      return $this->blog_text;
   }
   
   function getBlogger(){
      return $this->blogger_id;
   }
   
   }