<?php
/**
 * Template Name: Strategy Page
 */
?>
<?php global $siteDir; global $homeURL;?>

<?php get_header(); ?>

<?php
$args = array(
    'post_type' 		=> 'strategy',
    'orderby' 			=> 'menu_order',
    'order' 			=> 'ASC',
    'posts_per_page' => -1

  );

$files_in_cat_query = new WP_Query($args);

if ( $files_in_cat_query->have_posts() ) {
$strategy = $files_in_cat_query->get_posts();

?>
<div class="hide" id="strat-imgs">
  <?php
  $imgLooper = 0;
foreach($strategy as $si) {
  $iid = $si->ID;
  if(has_post_thumbnail($iid)) {
    $tid = get_post_thumbnail_id($iid);
    $tl = wp_get_attachment_image_src($tid, 'full', false);
    $tl = $tl[0];
    $ts = wp_get_attachment_image_src($tid, 'large', false);
    $ts = $ts[0];
    ?>
    <div class="bg-flipper holder strat count-<?php echo $imgLooper;?>">
      <img src="" data-lg="<?php echo $tl;?>" data-sm="<?php echo $ts;?>" class="hide preload dyna-load bg-loader"/>
    </div>

    <?php
  }
  $imgLooper++;
}



  ?>

</div>
<div id="strat-content" class="interior-holder">
<?php

  $looper =0;
foreach($strategy as $s) {
  $sid = $s->ID;

  ?>
  <div class="strat-block" data-count="<?php echo $looper;?>">
    <h1 class="strat-title"><a href="#"><?php echo $s->post_title;?></a></h1>
    <?php
    $meta = get_post_meta( $sid, 'strategy-content-blocks', true );
    $l = count($meta);


    if($l < 2) {
      $meta = $meta[0];
      ?>
      <div class="content">
        <?php echo $meta['the-content'];?>

      </div>

      <?php
    }
    if($l >= 2) {
      ?>
      <div class="content">
      <div class="headers">
        <?php
        $sublooper= 0;
        foreach($meta as $m) {
          if($m['title'] !== '' && $m['title']!== null) {
            $title = $m['title'];
          } else {
            $title = 'NULL';
          }
          ?>
          <h2 class="sub-header"><a href="#" data-count="<?php echo $sublooper;?>"><?php echo $title;?></a></h2>
          <?php
          $sublooper++;
        }

        ?>

      </div>


        <?php
        $sublooper = 0;
        foreach($meta as $m) {
          ?>
          <div class="sub-content" data-count="<?php echo $sublooper;?>">
<?php echo content_cleaner($m['the-content']);?>
          </div>
          <?php
          $sublooper++;
        }
        ?>

      </div>

      <?php

    }

    ?>



  </div>


  <?php


$looper++;
}



}


?>

</div>



<?php get_footer(); ?>
