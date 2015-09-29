<?php
/**
 * Template Name: Login Page
 */
get_header();?>

<?php
$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
?>

<div id="main-login-form">
<!-- ERROR MESSAGING -->
<?php
if ( $login === "failed" ) {
    echo '<p class="login-msg error"><strong>ERROR:</strong> Invalid Email and/or password. <a class="no-history" href="'.home_url('/reset-password/').'">Forgot your password?</a></p>';
} elseif ( $login === "empty" ) {
    echo '<p class="login-msg error"><strong>ERROR:</strong> Email and/or Password is empty.</p>';
} elseif ( $login === "false" ) {
    echo '<p class="login-msg"><strong>ERROR:</strong> You are logged out.</p>';
}


?>


<?php
$args = array(
    'redirect' => home_url('/investor-dashboard/'),
    'id_username' => 'user',
    'id_password' => 'pass',
  );

//wp_login_form($args); ?>

<form name="loginform" id="loginform" action="<?php echo $homeURL;?>/wp-login.php" method="post">

	<p class="login-username">
		<label for="user">Email</label>
		<input type="text" name="log" id="user" class="input" value="" size="20">
	</p>
	<p class="login-password">
		<label for="pass">Password</label>
		<input type="password" name="pwd" id="pass" class="input" value="" size="20">
	</p>

	<p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label></p>
	<p class="login-submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Log In">
		<input type="hidden" name="redirect_to" value="<?php echo $homeURL;?>/investor-dashboard/">
	</p>

</form>

<div class="bottom-content">
<a class="no-history" href="<?php echo home_url('/reset-password/');?>">Reset your password</a>
</div>

</div>

<?php get_footer();?>
