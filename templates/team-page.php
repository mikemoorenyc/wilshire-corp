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
?>
<ul class="no-style" id="team-list">
<?php
$teamloop = 0;
foreach($port as $p) {
$pid = $p->ID;
?>
<li data-count="<?php echo $teamloop;?>">
<a data-count="<?php echo $teamloop;?>" href="<?php echo get_permalink($pid);?>">
  <span class="name"><?php echo $p->post_title;?></span>
    <?php
$meta = get_post_meta( $pid, 'team-member-meta', true );
$meta = $meta[0];
    ?>
    <span class="title">
      <?php echo $meta['team-member-title'];?>
    </span>

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
