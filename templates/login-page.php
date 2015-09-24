<?php
/**
 * Template Name: Login Page
 */
?>
<?php get_header();?>

<?php
$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
?>

<div id="main-login-form">
<!-- ERROR MESSAGING -->
<?php
if ( $login === "failed" ) {
    echo '<p class="login-msg error"><strong>ERROR:</strong> Invalid username and/or password. <a class="no-history" href="'.home_url('/wp-admin/').'">Forgot your password?</a></p>';
} elseif ( $login === "empty" ) {
    echo '<p class="login-msg error"><strong>ERROR:</strong> Username and/or Password is empty.</p>';
} elseif ( $login === "false" ) {
    echo '<p class="login-msg"><strong>ERROR:</strong> You are logged out.</p>';
}


?>


<?php
$args = array(
    'redirect' => home_url('/wp-admin/'),
    'id_username' => 'user',
    'id_password' => 'pass',
  );

wp_login_form($args); ?>

<div class="bottom-content">
<a class="no-history" href="<?php echo home_url('/reset-password/');?>">Reset your password</a>
</div>

</div>

<?php get_footer();?>
