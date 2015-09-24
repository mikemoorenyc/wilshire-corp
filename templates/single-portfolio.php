<?php get_header();?>


<div id="port-header" class="dt-hide">
  <h1 class="title" id="portfolio-title">
  <?php echo get_the_title();?>

  </h1>

<?php
$args = array(
    'post_type' 		=> 'portfolio',
    'orderby' 			=> 'menu_order',
    'order' 			=> 'ASC',
    'posts_per_page' => -1

  );

$files_in_cat_query = new WP_Query($args);
$port = $files_in_cat_query->get_posts();
$portArray = array();
$previousPage = true;
$nextPage = true;
$portLength = count($port);
foreach ($port as $p) {
  array_push($portArray, $p->ID);
}
$currentKey = array_search($post->ID, $portArray);
if($currentKey == 0) {
  $previousPage = false;
}
if($currentKey == ($portLength - 1)) {
  $nextPage = false;
}

?>

<!-- ASSEMBLE THE HEADER -->
<?php
if($previousPage == true) {
?>
<a href="<?php echo get_permalink($portArray[$currentKey-1]);?>" class="arrow left">
<svg>
  <use xlink:href="#left-arrow-sm" />
</svg>
</a>
<?php
}
?>



<?php
if($nextPage == true) {
?>
<a href="<?php echo get_permalink($portArray[$currentKey+1]);?>" class="arrow right">
<svg>
  <use xlink:href="#right-arrow-sm" />
</svg>
</a>
<?php
}
?>




</div>

<div id="port-gallery">
  <div class="the-gallery">
    <?php
    $gallery = get_post_meta( $post->ID, 'property-gallery', true );
    if($gallery !== '') {
      $looper = 0;
      foreach($gallery as $g) {
        ?>
        <div class="slide count-<?php echo $looper;?>">
          <?php
          $ts = wp_get_attachment_image_src($g['image'], 'medium', false);
          $ts = $ts[0];
          ?>
          <img data-src="<?php echo $ts;?>" />
        </div>

        <?php
        $looper++;
      }

    } else {
      echo '<div class="slide count-1"></div>';
    }
?>


  </div>

  <a class="port-x mob-hide" href="<?php echo $homeURL;?>/portfolio">
    <svg>
      <use xlink:href="#gal-close-btn" />
    </svg>

  </a>


</div>

<div id="port-content" class="dt-hide">
  <div class="inner">
    <div id="port-copy-main">
      <?php the_content();?>

    </div>

  </div>
</div>




<?php get_footer();?>
