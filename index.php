<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>php-sdk</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Whats on our Mind</title>
<link rel="stylesheet" type="text/css" href="src/view.css" media="all">
<script type="text/javascript" src="src/view.js"></script>
  </head>
  <body id="main_body">
<?php

require '/src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '1400569390162590',
  'secret' => '905279329d9655c570a3f35e14b0113a',
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
	
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
 //redirect user to authorize dialog
   $login_url = $facebook->getLoginUrl($params = array('scope' => "publish_stream"));

    echo ("<script> top.location.href='".$login_url."'</script>");
}


?>
<img id="top" src="images/top.png" alt="">
	<div id="form_container">
	
		<h1><a>Whats on our Mind</a></h1>
		<form id="form_545340" class="appnitro"  method="post" action="process.php">
					<div class="form_description">
			<h2>Whats on our Mind</h2>
			<p>Update your facebook status easily.</p>
		</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1"> </label>
		<div>
			<textarea id="txtstatus" name="txtstatus" class="element textarea small"></textarea> 
		</div> 
		</li>
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="545340" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Publish" />
		</li>
			</ul>
		</form>	
		<div id="footer">
			<?php if ($user): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>
		</div>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
  </body>
</html>
