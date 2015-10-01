<?php get_header();?>


<?php
$meta = get_post_meta( $post->ID, 'team-member-meta', true );
$meta = $meta[0];
?>

<div id="team-inside">
  <div class="mobile-img dt-hide">
    <?php
    $tid = get_post_thumbnail_id();
    $tl = wp_get_attachment_image_src($tid, 'full', false);
    $tl = $tl[0];
    $ts = wp_get_attachment_image_src($tid, 'large', false);
    $ts = $ts[0];
    if(!(has_post_thumbnail())) {
      $ts = $siteDir.'/assets/imgs/blank.png';
      $tl = $siteDir.'/assets/imgs/blank.png';
    }
    ?>
    <img src="" data-lg="<?php echo $tl;?>" data-sm="<?php echo $ts;?>" class="hide preload dyna-load bg-loader"/>

  </div>

  <div class="content <?php echo $meta['portrait-side'];?>">
    <div class="head-block">
      <h1 class="top"><?php the_title();?></h1>
      <div class="title sub">
        <?php echo $meta['team-member-title'];?>
      </div>
    </div>
    <div class="main">
      <?php
      the_content();
      if($meta['email'] !== '' && $meta['email']!== null) {
        //GET FIRST NAME
        $name = $post->post_title;
        $split = explode(' ',trim($name));
        ?>
        <p>
          Contact <?php echo $split[0];?>
          <br/>
          <a href="mailto:<?php echo $meta['email'];?>"><?php echo $meta['email'];?></a>

        </p>
        <?php
      }

      ?>
      <p class="back">
        <a href="<?php echo $homeURL;?>/team">Back to team</a>
      </p>
    </div>
  </div>

</div>

<?php get_footer();?>
