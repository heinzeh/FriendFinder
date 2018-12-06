<?php

    session_start();
    if($_SESSION['loggedin'] == FALSE){
        header("Location:index.php");
    }

    require('Persistence.php');
    $pageID = 1;
    $db = new Persistence();
    $posts = $db->get_posts($pageID);
    $total_posts = count($posts);
?>
<html>
    <head>
<title>FFF Group Social Media Template</title>

<meta charset="UTF-8">
<link href="app.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        </head>
<body class="w3-theme-l5">

<!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
            <a class="w3-bar-item w3-button w3-padding-large w3-theme-d4" href='social.php'><i class="fa fa-home w3-margin-right"></i>Home</a>
<!-- change link to account editing-->
            <a class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="My Account" href="user_form.php">
                <img src="<?php echo("avatars/" . $_SESSION['avatar'] . ".jpg")?>" class="w3-circle" style="height:23px;width:23px" alt="Profile">
            </a>
            <button class="w3-bar-item w3-button w3-left w3-padding-large" onclick="location.href='friendQuery.php';">FriendFinder</button>
            <button class="w3-bar-item w3-button w3-right w3-padding-large" onclick="location.href='logout.php';">Log Out</button>
        </div>
    </div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">My Profile</h4>
        <a title="My Account" href="profile.php?username=<?php echo $_SESSION['loggedin'];?>">
                <p class="w3-center"><img src="<?php echo("avatars/" . $_SESSION['avatar'] . ".jpg")?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
        </a>
         <hr>
         <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['loggedin']; ?></p>
         <p><i class="fa fa-address-book fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName'];?></p>
         <p><i class="fa fa-gamepad fa-fw w3-margin-right w3-text-theme"></i><?php echo strtoupper($_SESSION['console']); ?></p>
        </div>
      </div>
      <br>

      <!-- Accordion -->
<!--
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
          <div id="Demo1" class="w3-hide w3-container">
            <p>Some text..</p>
          </div>
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Highlights</button>
          <div id="Demo2" class="w3-hide w3-container">
            <p>Some other text..</p>
          </div>
          <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Friends</button>
          <div id="Demo3" class="w3-hide w3-container">
         <div class="w3-row-padding">
         <br>
           <div class="w3-half">
             <img src="/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
         </div>
          </div>
        </div>
      </div>
-->

      <!-- Interests -->
      <div class="w3-card w3-round w3-white w3-hide-small" style="padding: 0px;">
        <div class="w3-container">
          <p>Fortnite Events:</p>
          <img src="unnamed.jpg" alt="fortnite" style="width:100%;" onclick="location.href='https://fortniteintel.com/events/';">
          <p>Click image for Fortnite Events page</p>
        </div>
      </div>
      <!-- Alert Box -->
<!--
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
          <i class="fa fa-remove"></i>
        </span>
        <p><strong>Hey!</strong></p>
        <p>People are looking at your profile. Find out who.</p>
      </div>
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Friend Request</p>
          <img src="henry.jpg" alt="henry" style="width:50%"><br>
          <span>Henry Heinze</span>
          <div class="w3-row w3-opacity">
            <div class="w3-half">
              <button class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button>
            </div>
            <div class="w3-half">
              <button class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
            </div>
          </div>
        </div>
      </div>
-->

    <!-- End Left Column -->
    </div>

    <!-- Middle Column -->
    <div class="w3-col m7">


    <section id="comments" class="body" style="padding-left: 10px; padding-right: 10px;">
    <div class="w3-card w3-round w3-white" style="padding: 10px;">
        <header>
        <h2>Make a Post</h2>
        </header>
        <div id="respond">

        <form action="post_comment.php" method="post" id="commentform">

        <input type="hidden" name="username" id="username" value="<?php echo($_SESSION['loggedin']); ?>" required="required">

        <input type="hidden" name="avatar" id="avatar" value="<?php echo($_SESSION['avatar']); ?>" required="required">

        <textarea name="postText" id="postText" rows="4" required="required" style="width: 100%; padding-right: 10; margin-bottom: 20; resize: none;"></textarea>

        <input type="hidden" name="pageID" value="<?php echo($pageID); ?>" id="postID" />

        <label for="postImage" style="margin-bottom: 20;">Imgur Link
            <input type="text" name="postImage" id="postImage" value="" />
        </label>

        <label for="postVideo" style="margin-bottom: 20;">Youtube Link
            <input type="text" name="postVideo" id="postVideo" value="" />
        </label>

        <input type="hidden" name="postID" value="<?php echo(++$total_posts); ?>" id="postID" />

        <input name="submit" type="submit" value="Post" class="w3-button w3-theme">

        </form>

        </div>
    </div>
        <ol id="comments-list" style="list-style-type:none; padding-left: 0;">
        <?php
        foreach ($posts as &$post) {
                ?>
            <li>
            <div class="w3-container w3-card w3-white w3-round w3-margin" id="post_<?php echo($post['id']); ?>"><br>
            <a href= <?php echo "'profile.php?username=" . $post['username'] . "'"?> >
                <img src="<?php echo("avatars/" . $post['avatar'] . ".jpg");?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
            </a>
            <h4><?php echo("<a href='profile.php?username=" . $post['username'] . "' style = 'color: inherit;'> " . $post['username'] . "</a>") ?></h4><br>
            <hr class="w3-clear">
            <p><?php echo($post['postText']);?></p>

            <?php
                if($post['postImage'] != ""){
                
                
                    echo('<blockquote class="imgur-embed-pub" lang="en" data-id="a/' . $post['postImage'] . '" data-context="false"><a href="//imgur.com/' . $post['postImage'] . '">title</a></blockquote><script async src="//s.imgur.com/min/embed.js" charset="utf-8"></script>');
                }
                
            ?>

        <?php
                if($post['postVideo'] != ""){
                    
                    echo('<div style="position: relative; padding-bottom: 56.25%; padding-top: 25px; height: 0;"> <iframe src="http://www.youtube.com/embed/' . $post['postVideo'] . '" frameborder="0" allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe></div>');
                }

            ?>

        </div>
        </li>
        <?php
            }
            ?>

        </ol>


</section>
    <!-- End Middle Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-dark-gray w3-center">
        <div class="w3-rest">
<a class="twitter-timeline" data-height="1500" data-theme="dark" data-link-color="#2B7BB9" href="https://twitter.com/FortniteGame?ref_src=twsrc%5Etfw">Tweets by FortniteGame</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>        </div>
      </div>
      <br>

      <br>
      <br>

    <!-- End Right Column -->
    </div>

  <!-- End Grid -->
  </div>

<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <blockquote class="blockquote">
            <p>Created by FFF Group</p>
            <footer><a href="mailto:FFFGroupContact@gmail.com">Email Us!</a></footer>
        </blockquote>
</footer>

<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html>
