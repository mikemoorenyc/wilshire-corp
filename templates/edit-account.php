<?php
/**
 * Template Name: Edit Account
 */
include_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
if($detect->isMobile() == true) {
  $siteURL = get_site_url();
  header("Location: ".$siteURL);
  die();
}
if(!is_user_logged_in()) {
  $siteURL = get_site_url();
  header("Location: ".$siteURL);
  die();
}



 //$wpdb->hide_errors(); auth_redirect_login(); nocache_headers();
global $userdata; get_currentuserinfo(); // grabs the user info and puts into vars
// check to see if the form has been posted. If so, validate the fields
if(!empty($_POST['action'])) {
require_once(ABSPATH . 'wp-admin/includes/user.php');
require_once(ABSPATH . WPINC . '/registration.php');
check_admin_referer('update-profile_' . $user_ID);
$errors = edit_user($user_ID);
if ( is_wp_error( $errors ) ) {
foreach( $errors->get_error_messages() as $message )
$errmsg = "$message";
//exit;
}
// if there are no errors, then process the ad updates
if($errmsg == '')
{
do_action('personal_options_update');
$d_url = $_POST['dashboard_url'];
wp_redirect( get_option("siteurl").'?page_id='.$post->ID.'&updated=true' );
}
else {
$errmsg = '<p class="login-msg error">' . $errmsg . '</p>';
$errcolor = 'style="background-color:#FFEBE8;border:1px solid #CC0000;"';
}
}
?>

<?php get_header();?>
<div id="investor-container">





		<div class="content-holder">
			<div class="investor-header">
<h1><?php the_title(); ?></h1>

      </div>
			<div class="content">



<form class="custom-editor" name="profile" action="" method="post">

  <?php if ( isset($_GET['updated']) && $errmsg == '') {
    $d_url = $_GET['d'];?>
    <p class="login-msg">Your profile has been updated</p>
  <?php } ?>
  <?php echo $errmsg; ?>
<?php wp_nonce_field('update-profile_' . $user_ID) ?>
<input type="hidden" name="from" value="profile" />
<input type="hidden" name="action" value="update" />
<input type="hidden" name="checkuser_id" value="<?php echo $user_ID ?>" />
<input type="hidden" name="dashboard_url" value="<?php echo get_option("dashboard_url"); ?>" />
<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_ID; ?>" />
  <div class="form-group">
    <label for="first_name"><?php _e('First Name','cp') ?></label>
    <input type="text" name="first_name" class="mid2" id="first_name" value="<?php echo $userdata->first_name ?>" size="35" maxlength="100" />
  </div>
  <div class="form-group">
    <label for="last_name"><?php _e('Last Name','cp') ?></label>
    <input type="text" name="last_name" class="mid2" id="last_name" value="<?php echo $userdata->last_name ?>" size="35" maxlength="100" />
  </div>
  <div class="form-group">
    <label for="email"><?php _e('Primary Email','cp') ?></label>
    <input type="text" name="email" class="mid2" id="email" value="<?php echo $userdata->user_email ?>" size="35" maxlength="100" />
  </div>




<?php
do_action('profile_personal_options');
?>


<?php
$show_password_fields = apply_filters('show_password_fields', true);
if ( $show_password_fields ) :
?>
  <h3 class="pass">Update your Password</h3>
  <div class="form-group">
    <label for="pass1"><?php _e('New Password','cp'); ?></label>
    <input type="password" name="pass1" class="mid2" id="pass1" size="35" maxlength="50" value="" />
    <span class="help-block">Leave this field blank unless you'd like to change your password.</span>
  </div>
  <div class="form-group">
    <label for="pass2"><?php _e('Confirm New Password','cp'); ?></label>
    <input type="password" name="pass2" class="mid2" id="pass2" size="35" maxlength="50" value="" />
    <span class="help-block">Type your new password again.</span>
  </div>

<?php endif; ?>
  <div class="form-group">
    <div class='submit-container clearfix'>

<input type="submit" class="button" value="Update profile" name="submit" />
    </div>
  </div>

</form>


	</div>
	</div>



  <div id="back-to-home">
    <a href="<?php echo $homeURL;?>/investor-dashboard" class="no-history">Back to Investor Home</a>

  </div>


</div>

<?php get_footer(); ?>








<?php get_footer();?>
