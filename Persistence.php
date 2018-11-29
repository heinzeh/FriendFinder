<?php
date_default_timezone_set('UTC');

class Persistence {
  
  private $data = array();
  
  /*function __construct() {
    session_start();
    
    if( isset($_SESSION['blog_comments']) == true ){
      $this->data = $_SESSION['blog_comments'];
    }
  }*/
  
  /**
   * Get all comments for the given post.
   */
  function get_posts($pageID) {
    $posts = array();

      $con = mysqli_connect('localhost','root','Capstone18','FFF');
      if (!$con) {
          die('Could not connect: ' . mysqli_error($con));
      }
      
      mysqli_select_db($con,"Database");
      $query = "SELECT * FROM posts ORDER BY postID DESC";
      $result=mysqli_query($con, $query);
      
      while($row = mysqli_fetch_assoc($result)){
          
          // add each row returned into an array
          $posts[] = $row;
      }

    /*if( isset($this->data[$comment_post_ID]) == true ) {
      $comments = $this->data[$comment_post_ID];
    }*/
     
    mysqli_close();
      
    return $posts;
  }
  
  /**
   * Get all comments.
   */
  function get_all_posts() {
    return $this->data;
  }
  
  /**
   * Store the comment.
   */
  function add_post($vars) {
    
    $added = false;
    
      $con = mysqli_connect('localhost','root','Capstone18','FFF');
      if (!$con) {
          die('Could not connect: ' . mysqli_error($con));
      }
      
      $imageCode;
      $videoCode;
      
      if($vars['postVideo'] != ""){
          $step1=explode('v=', $vars['postVideo']);
          $step2 =explode('&',$step1[1]);
          $videoCode = $step2[0];
      } else{
          $videoCode="";
      }
      
      if($vars['postImage'] != ""){
          $step1=explode('gallery/', $vars['postImage']);
          $imageCode = $step1[1];
      } else{
          $imageCode="";
      }
      
      mysqli_select_db($con,"Database");
      
      $postID = $vars['postID'];
      $username = mysqli_real_escape_string($con, $vars['username']);
      $postImage = mysqli_real_escape_string($con, $imageCode);
      $postText = mysqli_real_escape_string($con, $vars['postText']);
      $pageID = 1;
      $postVideo = mysqli_real_escape_string($con, $videoCode);
      $avatar = $vars['avatar'];
      
    
      $input = array(
     'postID' => $postID,
     'username' => $username,
     'postVideo' => $postVideo,
     'postText' => $postText,
     'pageID' => $pageID,
     'postImage' => $postImage,
      'avatar' => $avatar);
    
    if($this->validate_input($input) == true) {
      if( isset($this->data[$pageID]) == false ) {
        $this->data[$pageID] = array();
      }
      
      $input['id'] = uniqid('post_');
      
      $this->data[$pageID][] = $input;
      
       
        $sql="INSERT INTO posts (postID, username, postText, postVideo, pageID, postImage, avatar) VALUES ('$postID', '$username', '$postText', '$postVideo', '$pageID', '$postImage', '$avatar');";
        
        mysqli_query($con,$sql);
        
        
        
      $this->sync();
      
      $added = $input;
        
    mysqli_close();
    }
      
    return $added;
  }
  
  function delete_all() {
    $this->data = array();
    $this->sync();
  }
  
  private function sync() {
    $_SESSION['blog_posts'] = $this->data;
  }
  
  /**
   * TODO: much more validation and sanitization. Use a library.
   */  
  private function validate_input($input) {
    
    $input['username'] = substr($input['username'], 0, 70);
    if($this->check_string($input['username']) == false) {
      return false;
    }
    $input['username'] = htmlentities($input['username']);

    $input['postText'] = substr($input['postText'], 0, 250);
    if($this->check_string($input['postText'], 1) == false) {
      return false;
    }
    $input['postText'] = htmlentities($input['postText']);

    $input['pageID'] = filter_var($input['pageID'], FILTER_VALIDATE_INT);
    if (filter_var($input['pageID'], FILTER_VALIDATE_INT) == false) {
      return false;
    }

    return true;
  }
  
  private function check_string($string, $min_size = 1) {
    return strlen(trim($string)) >= $min_size;
  }
}

?>
