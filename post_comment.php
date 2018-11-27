<?php
require('Persistence.php');

$db = new Persistence();
$added = $db->add_post($_POST);

if($added) {
  header( 'Location: social.php' );
}
else {
  header( 'Location: social.php?error=Your post was not posted due to errors in your form submission' );
}
?>
