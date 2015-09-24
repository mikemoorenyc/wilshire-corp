<?php
/**
 * Template Name: Team Page
 */
?>
<?php get_header();?>

<?php
$args = array(
    'post_type' 		=> 'team',
    'orderby' 			=> 'menu_order',
    'order' 			=> 'ASC',
    'posts_per_page' => -1

  );

$files_in_cat_query = new WP_Query($args);

if ( $files_in_cat_query->have_posts() ) {
$port = $files_in_cat_query->get_posts();
$pcount = count($port);
if($pcount >= 4) {
  $pcount = 'full';
}
?>
<div id="team-bg-holder">
  <?php
$pLooper = 0;
foreach($port as $p) {
  $pid = $p->ID;
  if(has_post_thumbnail($pid) ) {



    $tid = get_post_thumbnail_id($pid);
    $tl = wp_get_attachment_image_src($tid, 'full', false);
    $tl = $tl[0];
    $ts = wp_get_attachment_image_src($tid, 'large', false);
    $ts = $ts[0];
    ?>

      <div class="holder team-bg count-<?php echo $pLooper;?>" data-count="<?php echo $pLooper;?>">
        <img src="" data-lg="<?php echo $tl;?>" data-sm="<?php echo $ts;?>" class="hide dyna-load bg-loader team-loader"/>
      </div>




    <?php
  } else {
    ?>
    <div class="holder team-bg count-<?php echo $pLooper;?>" data-count="<?php echo $pLooper;?>">
      <img src="" data-lg="<?php echo siteDir;?>/assets/imgs/blank.png" data-sm="<?php echo siteDir;?>/assets/imgs/blank.png" class="hide dyna-load bg-loader team-loader"/>
    </div>
    <?php
  }
$pLooper++;
}


  ?>

</div>
<ul class="no-style count-<?php echo $pcount;?>" id="team-list">
<?php
$teamloop = 0;
foreach($port as $p) {
$pid = $p->ID;
?>
<li data-count="<?php echo $teamloop;?>">
<a data-count="<?php echo $teamloop;?>" href="<?php echo get_permalink($pid);?>">
  <div class="head-block">
    <span class="name top"><?php echo $p->post_title;?></span>
    <?php
$meta = get_post_meta( $pid, 'team-member-meta', true );
$meta = $meta[0];
    ?>
    <span class="title sub">
      <?php echo $meta['team-member-title'];?>
    </span>
  </div>
</a>
</li>
<?php
$teamloop++;

}

?>
</ul>
<?php
}

?>
<?php get_footer();?>
