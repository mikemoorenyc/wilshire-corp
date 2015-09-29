<?php
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/css/login-main.css?v='.time() );
}

add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );




function login_failed() {
    $login_page  = home_url( '/login/' );
    wp_redirect( $login_page . '?login=failed' );
    exit;
}
add_action( 'wp_login_failed', 'login_failed' );

function verify_username_password( $user, $username, $password ) {
    $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);

function logout_page() {
    $login_page  = home_url( '/login/' );
    wp_redirect( home_url());
    exit;
}
add_action('wp_logout','logout_page');



/**
 * Redirect non-admin users to home page
 *
 * This function is attached to the 'admin_init' action hook.
 */


//INVESTOR VARIABLES
function add_custom_query_var( $vars ){
  $vars['1'] = "doc_id";
	$vars['2'] = "building_id";
  $vars['3'] = "doc_type";
  return $vars;
}
add_filter( 'query_vars', 'add_custom_query_var' );

function downloadMaker($id, $fileType) {
  global $siteDir;
  ?>
  <!-- FOR PRIVATE FILE  -->
  <li class="dl-assembly">
  <?php if($fileType == 'private-file'):

  $attached_files = cuar_get_the_attached_files($id);

    ?>

    <div class="date"><?php echo get_the_date('m-d-Y', $id );?> </div>
    <div class="title"><?php echo get_the_title($id);?></div>

    <?php foreach ($attached_files as $file_id => $newFile) : ?>
    <a class="dl-link no-history" target="_blank" href="<?php echo get_permalink($id).'/download/'.$file_id; ?>">
      Click to download
    </a>

    <?php endforeach;?>

  <?php endif;?>

  <!-- FOR GROUP FILE -->
  <?php if($fileType=='group-file'):?>
    <div class="date"><?php echo get_the_date('m-d-Y', $id );?> </div>
    <div class="title"><?php echo get_the_title($id);?></div>

    <?php
    $filelink = get_post_meta( $id, "group-file", true );
    $filelink = $filelink[0];
    $filelink = wp_get_attachment_url( $filelink['file'], 'full' );


    ?>

    <form target="_blank" class="download-submitter" method="post" action="<?php echo $siteDir;?>/downloader.php">
     <input type="submit" class="dl-link" value="Click here to download"/>
     <input type="hidden" value="<?php echo $filelink;?>" name="download-id" />
     <input type="hidden" value="groupfile" name="download-type" />
   </form>
</li>
  <?php endif;?>
  <?php
}


?>
