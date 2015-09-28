<?php
/**
 * Template Name: File Archive
 */
?>
<?php
include_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
if($detect->isMobile() == true) {
  $siteURL = get_site_url();
  header("Location: ".$siteURL);
  die();
}

if(!is_user_logged_in()) {
  $siteURL = get_site_url();
  header("Location: ".$siteURL);
  die();
}
?>
<?php get_header();
global $siteTitle;
?>

<?php
$prop_id = intval($_GET["building_id"]);

$po_addon = CUAR_Plugin::get_instance()->get_addon("post-owner");
$po_value = $po_addon->get_meta_query_post_owned_by( get_current_user_id() );

//GET THE CATEGORy
$ppage_terms = get_the_terms($prop_id, 'properties');
$category = $ppage_terms[0];

//CHANGE THE NAME
?>
<script>
document.title = "<?php echo $category->name;?> Archive | <?php echo $siteTitle ;?>";
</script>
<?php

$args = array(
      'post_type' 		=> 'cuar_private_page',
      'orderby' 			=> 'date',
      'order' 			=> 'DESC',
      'posts_per_page' => -1,
      'meta_query' 		=> $po_value

);

?>
<div id="investor-container">
  <div class="investor-header">
    <h1><?php echo $category->name;?> Archive</h1>
    <?PHp
    $totalcap = get_post_meta( $prop_id , "_amount", true );
    if ($totalcap !== ''):?>
    <div class="capital-big">
      <div class="top">Outstanding Invested Capital</div>
      <div class="sub"> <?php echo $totalcap;?> </div>
    </div>
    <?php endif;?>
    <?php
    //GET THE INDIVIDUAL FUNDS
    $funds = get_post_meta( $prop_id , "individual-investment-funds", true );
    if($funds !== ''):
    foreach($funds as $fund):
    ?>
    <div class="fund">
      <?php echo $fund['fund-name'];?>: <strong><?php echo $fund['investment-amount'];?></strong>

    </div>

    <?php
    endforeach;
    endif;?>

    <?php
    $build_post = get_post($prop_id);
    if($build_post->post_content !== '' && $build_post->post_content !== null) :
    ?>
    <div class="user-message">
      <?php echo wpautop($build_post->post_content);?>
    </div>


    <?php

    endif;
    ?>
  </div>



</div>

<?Php get_footer();?>
