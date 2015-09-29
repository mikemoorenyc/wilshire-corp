<?php
function redirect_non_admin_users() {
	if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
		wp_redirect( home_url('/investor-dashboard/') );
		exit;
	}
}
add_action( 'admin_init', 'redirect_non_admin_users' );
function redirect_login_page() {
    $login_page  = home_url( '/login/' );
    $page_viewed = basename($_SERVER['REQUEST_URI']);

    if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}
add_action('init','redirect_login_page');
add_theme_support( 'menus' );

//$siteDir = '/wp-content/themes/w25th-build';
add_post_type_support('page', 'excerpt');


//CUSTOM POST TYPES
include 'custom-post-types.php';

//HIDING CUSTOMER AREA THINGS
include 'hiding-customer-area.php';


//LOGIN SCREEN
include 'login-screen.php';

//NEW TAXONOMIES
include 'new-tax.php';



// Custom functions

// Tidy up the <head> a little. Full reference of things you can show/remove is here: http://rjpargeter.com/2009/09/removing-wordpress-wp_head-elements/
remove_action('wp_head', 'wp_generator');// Removes the WordPress version as a layer of simple security

add_theme_support('post-thumbnails');




add_action( 'admin_init', 'my_theme_add_editor_styles' );
function my_theme_add_editor_styles() {
    add_editor_style( 'editor-styles.css' );
}

// DIRECTORY REPLACER

function dirReplacer($string) {
  global $siteDir;
  $time = time();
  $newString = str_replace('***REPLACEWITHTHEMEDIRECTORY***', $siteDir, $string);
  $newString = str_replace('***TIMESTAMP***', $time ,$newString);
  echo $newString;
}
//CONTENT CLEANER
function content_cleaner($content) {

    // Remove inline styling
    $content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $content);

    // Remove font tag
    $content = preg_replace('/<font[^>]+>/', '', $content);

    // Remove empty tags
    $post_cleaners = array('<p></p>' => '', '<p> </p>' => '', '<p>&nbsp;</p>' => '', '<span></span>' => '', '<span> </span>' => '', '<span>&nbsp;</span>' => '', '<span>' => '', '</span>' => '', '<font>' => '', '</font>' => '');
    $content = strtr($content, $post_cleaners);

    return $content;
}
 add_filter('the_content', 'content_cleaner',20);
?>
