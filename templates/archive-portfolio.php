<?php get_header();?>

<?php
$args = array(
    'post_type' 		=> 'portfolio',
    'orderby' 			=> 'menu_order',
    'order' 			=> 'ASC',
    'posts_per_page' => -1

  );

$files_in_cat_query = new WP_Query($args);

if ( $files_in_cat_query->have_posts() ) {
$port = $files_in_cat_query->get_posts();
$portcount = count($port);
if($portcount >= 4) {
  $portcount = 'full';
}
?>
<ul id="port-list" class="no-style clearfix count-<?php echo $portcount;?>">
<?php
foreach($port as $p) {
  $pid = $p->ID;
  ?>
  <li>
    <a href="<?php echo get_permalink($pid);?>">
      <?php
      if(has_post_thumbnail($pid) ) {
        $tid = get_post_thumbnail_id($pid);
        $ts = wp_get_attachment_image_src($tid, 'large', false);
        $ts = $ts[0];
        ?>
        <span class="img-holder">

          <img class="hide" src="" data-thumb="<?php echo $ts;?>" />
        </span>
        <?php
      } else{
        ?>
        <span class="img-holder">

          <img class="hide" src="" data-thumb="<?php echo $siteDir;?>/assets/imgs/blank.png" />
        </span>
        <?php
      }


      ?>
      <span class="overlay"></span>

      <span class="title head-block">
        <span class="top"><?php echo $p->post_title;?></span>
      </span>


    </a>
  </li>


  <?php
}

?>
</ul>
<?php
}
?>
<?php get_footer();?>
