<?php
/**
 * Template Name: Reset Password Page
 */
 get_header();?>



<div id="main-login-form">
  <div class="wrapper">

      <?php
          global $wpdb;

          $error = '';
          $success = '';

          // check if we're in reset form
          if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] )
          {
              $email = trim($_POST['user_login']);

              if( empty( $email ) ) {
                  $error = 'Enter an e-mail address..';
              } else if( ! is_email( $email )) {
                  $error = 'Invalid e-mail address.';
              } else if( ! email_exists( $email ) ) {
                  $error = 'There is no user registered with that email address.';
              } else {

                  $random_password = wp_generate_password( 12, false );
                  $user = get_user_by( 'email', $email );

                  $update_user = wp_update_user( array (
                          'ID' => $user->ID,
                          'user_pass' => $random_password
                      )
                  );

                  // if  update user return true then lets send user an email containing the new password
                  if( $update_user ) {
                      $to = $email;
                      $subject = '[Wilshire Capital] New Password';
                      $sender = get_option('blogname');
                      $senderemail = get_option('admin_email');

                      $message = 'Your new password is: '.$random_password;

                      $emailheaders = 'MIME-Version: 1.0' . "\r\n";
                      $emailheaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                      $emailheaders .= "X-Mailer: PHP \r\n";
                      $emailheaders .= 'From: '.$sender.' < '.$senderemail.'>' . "\r\n";

                      $mail = wp_mail( $to, $subject, $message, $emailheaders);
                      if( $mail )
                          $success = 'Check your email address for your new password.';

                  } else {
                      $error = 'Oops something went wrong updating your account.';
                  }

              }

              if( ! empty( $error ) )
                  echo '<p class="login-msg error"><strong>ERROR:</strong> '. $error .'</p>';

              if( ! empty( $success ) )
                  echo '<p class="login-msg"><strong>SUCCESS:</strong>'. $success .'</p>';
          }
      ?>

      <!--html code-->
      <?php
      if( !(isset( $_POST['action'] ) && 'reset' == $_POST['action']) ) {
        ?>
        <p class="login-msg">Please enter your email address. You will receive your new password via email.</p>
        <?php
      }


      ?>

      <form method="post">
              <p><label for="user_login">Email</label>
                  <input type="text" name="user_login" id="user_login" value="" /></p>
              <p class="login-submit">
                  <input type="hidden" name="action" value="reset" />
                  <input type="submit" value="Get New Password" class="button" id="submit" />
              </p>

      </form>
  </div>
</div>

<?php get_footer();?>
