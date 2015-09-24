<?php
/**
 * Template Name: Edit Account
 */
?>
<?php

if(!is_user_logged_in()) {
  $siteURL = get_site_url();
  header("Location: ".$siteURL);
  die();
}

?>

<?php get_header();?>


<?php
/**
 * Template Name: Account Details Page
 *
 */


 $wpdb->hide_errors(); auth_redirect_login(); nocache_headers();
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
$errmsg = '<p class="alert alert-warning">' . $errmsg . '</p>';
$errcolor = 'style="background-color:#FFEBE8;border:1px solid #CC0000;"';
}
}
?>


<?php get_header(); ?>

	<?php if ( ! have_posts() ) : ?>
						<h1><?php _e( '404 - I&#39;m sorry but the page can&#39;t be found' ); ?></h1>
						<p><a href="/">Go Home</a></p>
	<?php endif; ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<div class="content-holder">
			<h1><?php the_title(); ?></h1>
			<div class="content">



<form class="custom-editor" name="profile" action="" method="post">

  <?php if ( isset($_GET['updated']) && $errmsg == '') {
    $d_url = $_GET['d'];?>
    <p class="alert alert-info">Your profile has been updated</p>
  <?php } ?>
  <?php echo $errmsg; ?>
<?php wp_nonce_field('update-profile_' . $user_ID) ?>
<input type="hidden" name="from" value="profile" />
<input type="hidden" name="action" value="update" />
<input type="hidden" name="checkuser_id" value="<?php echo $user_ID ?>" />
<input type="hidden" name="dashboard_url" value="<?php echo get_option("dashboard_url"); ?>" />
<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_ID; ?>" />
  <div class="form-group">
    <label for="user_login"><?php _e('Username','cp'); ?></label>
    <input type="text" name="user_login" class="mid2" id="user_login" value="<?php echo $userdata->user_login; ?>" size="35" maxlength="100" disabled readonly="readonly" />
    <span class="help-block">Your username cannot be changed.</span>
  </div>
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

  <h3 class="pass">Contact Information</h3>

  <div class="form-group">
    <label for="address">Mailing Address</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'ADDRESS');
    ?>
    <textarea name="cimy_uef_ADDRESS" class="mid2" id="address" rows="8" cols="50"><?php echo cimy_uef_sanitize_content($value); ?></textarea>
  </div>
  <div class="form-group">
    <label for="officephone">Office Phone Number</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'OFFICEPHONE');
    ?>
    <input type="text" name="cimy_uef_OFFICEPHONE" class="mid2" id="officephone" value="<?php echo cimy_uef_sanitize_content($value); ?>" size="35" maxlength="30" />
  </div>
  <div class="form-group">
    <label for="officephone">Mobile Phone Number</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'MOBILEPHONE');
    ?>
    <input type="text" name="cimy_uef_MOBILEPHONE" class="mid2" id="mobilephone" value="<?php echo cimy_uef_sanitize_content($value); ?>" size="35" maxlength="30" />
  </div>
  <div class="form-group">
    <label for="officephone">Home Phone Number</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'HOMEPHONE');
    ?>
    <input type="text" name="cimy_uef_HOMEPHONE" class="mid2" id="homephone" value="<?php echo cimy_uef_sanitize_content($value); ?>" size="35" maxlength="30" />
  </div>

  <h3 class="pass">Required CC<small>s</small></h3>
  <div class="form-group">
    <label for="email1">Email Address 1</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'EMAIL1');
    ?>
    <input type="text" name="cimy_uef_EMAIL1" class="mid2" id="email1" value="<?php echo cimy_uef_sanitize_content($value); ?>" size="35" maxlength="100" />
  </div>
  <div class="form-group">
    <label for="email2">Email Address 2</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'EMAIL2');
    ?>
    <input type="text" name="cimy_uef_EMAIL2" class="mid2" id="email2" value="<?php echo cimy_uef_sanitize_content($value); ?>" size="35" maxlength="100" />
  </div>
  <div class="form-group">
    <label for="email3">Email Address 3</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'EMAIL3');
    ?>
    <input type="text" name="cimy_uef_EMAIL3" class="mid2" id="email3" value="<?php echo cimy_uef_sanitize_content($value); ?>" size="35" maxlength="100" />
  </div>
  <div class="form-group">
    <label for="phone1">Phone Number 1</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'PHONE1');
    ?>
    <input type="text" name="cimy_uef_PHONE1" class="mid2" id="phone1" value="<?php echo cimy_uef_sanitize_content($value); ?>" size="35" maxlength="100" />
  </div>
  <div class="form-group">
    <label for="phone2">Phone Number 2</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'PHONE2');
    ?>
    <input type="text" name="cimy_uef_PHONE2" class="mid2" id="phone2" value="<?php echo cimy_uef_sanitize_content($value); ?>" size="35" maxlength="100" />
  </div>

  <h3 class="pass">Primary Wiring Information</h3>
  <div class="form-group">
    <label for="accountname">Account Name</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'ACCOUNTNAME');
    ?>
    <input type="text" name="cimy_uef_ACCOUNTNAME" class="mid2" id="accountname" value="<?php echo cimy_uef_sanitize_content($value); ?>" size="35" maxlength="100" />
  </div>
  <div class="form-group">
    <label for="accountnumber">Account Number</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'ACCOUNTNUMBER');
    ?>
    <input type="text" name="cimy_uef_ACCOUNTNUMBER" class="mid2" id="accountnumber" value="<?php echo cimy_uef_sanitize_content($value); ?>" size="35" maxlength="100" />
  </div>
  <div class="form-group">
    <label for="routingnumber">Routing Number</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'ROUTINGNUMBER');
    ?>
    <input type="text" name="cimy_uef_ROUTINGNUMBER" class="mid2" id="routingnumber" value="<?php echo cimy_uef_sanitize_content($value); ?>" size="35" maxlength="100" />
  </div>
  <div class="form-group">
    <label for="routingnumber">Bank Name</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'BANKNAME');
    ?>
    <input type="text" name="cimy_uef_BANKNAME" class="mid2" id="bankname" value="<?php echo cimy_uef_sanitize_content($value); ?>" size="35" maxlength="100" />
  </div>

  <div class="form-group">
    <label for="bankaddress">Bank Address &amp; Telephone Number</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'BANKADDRESS');
    ?>
    <textarea name="cimy_uef_BANKADDRESS" class="mid2" id="bankaddress" rows="8" cols="50"><?php echo cimy_uef_sanitize_content($value); ?></textarea>
  </div>
  <div class="form-group">
    <label for="bankother">Other Information</label>
    <?php
    $value = get_cimyFieldValue($user_ID, 'BANKOTHER');
    ?>
    <textarea name="cimy_uef_BANKOTHER" class="mid2" id="bankother" rows="8" cols="50"><?php echo cimy_uef_sanitize_content($value); ?></textarea>
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
    <div class='submit-container'>

<input type="submit" class="button" value="Update profile" name="submit" />
    </div>
  </div>

</form>


	</div>
	</div>


	<?php endwhile; ?>




<?php get_footer(); ?>








<?php get_footer();?>
