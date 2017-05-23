<?php
    /**
    * The blogPost class represents a blog that will be posted on my blog site.
    * @author Jeff Church <Jchurch4@mail.greenriver.edu>
    * @copyright 2017
    */
   class blogPost
   {
   protected $blog_title;
   protected $blog_text;
   protected $blogger_id;
   /**
    * A function used to construct a new blog post.
    */
   function __construct($blog_title, $blog_text, $blogger_id){
      $this->blog_title = $blog_title;
      $this->blog_text = $blog_text;
      $this->blogger_id = $blogger_id;
   }
   /**
    *A function to return the title of the blog
    *@return returns the title of the blog.
    */
   function getTitle(){
      return $this->blog_title;
   }
   /**
    *A function to return the body of a blog
    *@return the text of the blog to return.
    */
   function getText(){
      return $this->blog_text;
   }
   /**
    *A function to return the blogger id of the blogger who posted the blog.
    *@return the id of the blogger who posted the blog to return.
    */
   function getBlogger(){
      return $this->blogger_id;
   }
   
   }