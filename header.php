<?php
//MOBILE
include_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;

if($detect->isMobile() == true) {
  $mobile = true;
  $mobileFront = 'true';
} else {
  $mobile == false;
  $mobileFront = 'false';
}

//Investor Section
$investorPage = intval(get_post_meta( $post->ID , "_investor-section", true ));
if($investorPage == 1 && $mobile == true) {
  $siteURL = get_site_url();
  header("Location: ".$siteURL);
  die();
}

//GET POST SLUG
global $post;
$slug = $post->post_name;
$navslug = $slug;
//GET POST PARENT
$parentID = $post->post_parent;
$parentslug = get_post($parentID)->post_name;

//GET POST TYPE
$posttype = get_post_type();

if($posttype!=="page" && $posttype!=="post") {
  $navslug = $posttype;

}


if(is_front_page()) {
  $navslug = 'profile';
}

if(is_archive()) {
  $archiveOb = get_queried_object();
  $navslug = $archiveOb->query_var;
  $interior = 'archive';
}
if(is_single()) {
  $interior = 'interior';
}

//CLEANUP NAV SLUG
$navslug = str_replace("-","",$navslug);

//GET THEME DIRECTORY
global $siteDir;
$siteDir = get_bloginfo('template_url');

//GET HOME URL
global $homeURL;
$homeURL = esc_url( home_url(  ) );

//DECLARE THE SITE TITLE, SAVE A DB QUERY
global $siteTitle;
$siteTitle = 'WILSHIRE CAPITAL PARTNERS';

//DECLARE THE PAGE EXCERPT
global $siteDesc;
$siteDesc = '';
?>
<!DOCTYPE html>
<html lang="en" data-parent-slug="<?php echo $parentslug;?>" class="slug-<?php echo $slug;?> __page-loading">
<head>

<!-- LOADING IN ALL CSS AT ONCE -->
<link rel="stylesheet" href="<?php echo $siteDir;?>/css/main.css?v=prod1.1" />


<?php


if ( is_front_page() ) {
  $namer = "Home";
  ?>
  <title><?php echo $siteTitle;?></title>
  <?php
} else {
  $namer = get_the_title();
  if(is_archive()) {
    $namer = $archiveOb->labels->name;
  }


  ?>

  <title><?php echo $namer;?> | <?php echo $siteTitle;?></title>
  <?php
}
?>

<!-- HERE'S WHERE WE GET THE SITE DESCRIPTION -->
<meta name="description" content="<?php if (have_posts() && is_single() OR is_page()):while(have_posts()):the_post();



  if (get_the_excerpt()) {
    $out_excerpt = str_replace(array("\r\n", "\r", "\n", "[&hellip;]"), "", get_the_excerpt());
    //echo apply_filters('the_excerpt_rss', $out_excerpt);
    $siteDesc = $out_excerpt;
  } else {
    $siteDesc =  get_bloginfo('description');
  }

  if($siteDesc == '') {
    $siteDesc =  get_bloginfo('description');
  }

endwhile;

else: ?>
<?php $siteDesc = get_bloginfo('description'); ?>
<?php endif; ?><?php echo $siteDesc;?>" />

<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">



<!-- icons & favicons -->
<link rel="shortcut icon" href="<?php echo $siteDir;?>/assets/imgs/icons/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="<?php echo $siteDir;?>/assets/imgs/icons/apple-touch-icon.png" />
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $siteDir;?>/assets/imgs/imgs/icons/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $siteDir;?>/assets/imgs/icons/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $siteDir;?>/assets/imgs/icons/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $siteDir;?>/assets/imgs/icons/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $siteDir;?>/assets/imgs/icons/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $siteDir;?>/assets/imgs/icons/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $siteDir;?>/assets/imgs/icons/apple-touch-icon-152x152.png" />
<!-- For Nokia -->
<link rel="shortcut icon" href="<?php echo $siteDir;?>/assets/imgs/icons/apple-touch-icon.png">
<!-- For everything else -->
<link rel="shortcut icon" href="<?php echo $siteDir;?>/assets/imgs/icons/favicon.ico">

<!--  STUFF FOR IE8 WILL GET REMOVED ON COMPILATION // REMOVE THIS LINE TO RENDER IT
<!--[if lte IE 8]>
<link rel="stylesheet" href="<?php echo $siteDir;?>/css/expanded.css" />
	<link href='<?php echo $siteDir;?>/css/ie-fixes.css?ts=<?php echo time();?>' rel='stylesheet' type='text/css'>
  	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->


<!-- FACEBOOK TAGS REMOVED ON COMPILATION UNLESS YOU UNCOMMENT-->
<!--
<meta property="og:site_name" content="<?php echo $siteTitle;?>" />
<meta property="og:title" content="<?php echo get_bloginfo('description');?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $homeURL;?>" />
<meta property="og:image" content="<?php echo $siteDir;?>/assets/blue-pin.jpg" />
<meta property="og:description" content="<?php echo $siteDesc;?>" />
-->

<script>
mobileDetect = '<?php echo $mobileFront;?>';

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-67984898-1', 'auto');
</script>

</head>

<body id="top">
<div class="hide" id="svg-block">
<?php include 'assets/svgs.svg';?>
</div>
<div id="css-checker"></div>


<!-- INCLUDE THE HEADER -->
<?php include 'topSection.php';?>


<!-- AJAX CATCHER -->
<div class="ajax-catcher">
<!-- DYNAMIC PAGE CONTENT-->
<div id="dynamic-page-content" data-navslug="<?php echo $navslug;?>" >


  <!-- BACKGROUND IMAGE -->
  <div id="background-image" class="<?php echo $navslug;?> <?php echo $interior;?>">



  <?php
  $teamthumb = kc_get_option( 'meta-images', 'Images', 'team-img' );

  if(has_post_thumbnail() || ($navslug == 'team' && is_archive() )) {

    if($navslug == 'team' && $interior == 'interior') {
      $portside = get_post_meta($post->ID, 'team-member-meta', true);
      $portside = $portside[0];
      $portside = $portside['portrait-side'];
    } else {
      $portside = '';
    }

    $tid = get_post_thumbnail_id();
    if($navslug == 'team' && is_archive() ) {
      $tid = $teamthumb;
    }
    $tl = wp_get_attachment_image_src($tid, 'full', false);
    $tl = $tl[0];
    $ts = wp_get_attachment_image_src($tid, 'large', false);
    $ts = $ts[0];
    ?>

      <div class="holder <?php echo $portside;?>">
        <img src="" data-lg="<?php echo $tl;?>" data-sm="<?php echo $ts;?>" class="hide preload dyna-load bg-loader"/>
      </div>




    <?php
  }

  //GET THE IMAGE if it's a file archive
  if($navslug == 'filearchive'):
    $prop_cat_id = intval($_GET["building_id"]);
    $args = array(
          'post_type' 		=> 'portfolio',
          'orderby' 			=> 'date',
          'order' 			=> 'DESC',
          'posts_per_page' => -1,
          'tax_query' =>  array(
                            array(
                              'taxonomy' => 'properties',
                              'field'    => 'term_id',
                              'terms'    => $prop_cat_id ,
                            ),
                          )
        );
    $gfiles_query = new WP_Query($args);
    if ( $gfiles_query->have_posts()) :
      $gfiles = $gfiles_query->get_posts();
      if(count($gfiles > 0)) {
        $backid = $gfiles[0]->ID;
        if(has_post_thumbnail($backid)):
          $tid = get_post_thumbnail_id($backid);
          $tl = wp_get_attachment_image_src($tid, 'full', false);
          $tl = $tl[0];
          $ts = wp_get_attachment_image_src($tid, 'large', false);
          $ts = $ts[0];
          ?>
          <div class="holder">
            <img src="" data-lg="<?php echo $tl;?>" data-sm="<?php echo $ts;?>" class="hide preload dyna-load bg-loader"/>
          </div>
          <?php
        endif;
      }

    endif;

  endif;

  ?>
  </div>
  <div id="background-content">

  </div>
<div id="scrolling-frame">
<div class="inner scrollbar-macosx">
<div class="spacer"></div>
<div id="main-content" class="<?php echo $navslug;?> <?php echo $interior;?>">
