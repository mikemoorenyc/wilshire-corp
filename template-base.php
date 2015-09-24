<?php
/**
 * Template Name: Home Page
 */
?>
<?php global $siteDir; global $homeURL;?>

<?php get_header(); ?>
  <div id="home-page-content" class="interior-holder">
    <?php the_content();?>

  </div>
<?php get_footer(); ?>
