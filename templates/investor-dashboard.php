<?php
/**
 * Template Name: Investor Dashboard
 */
?>

<?php

if(!is_user_logged_in()) {
  $siteURL = get_site_url();
  header("Location: ".$siteURL);
  die();
}

?>



<?php get_header();?>

<!-- REDIRECTS -->
<?php
if($mobile == true) {
  ?>
<script>
window.location = '<?php echo home_url();?>';
</script>

  <?php
}
?>

<div id="investor-container">
  <div class="investor-header">
<?php
if ( is_user_logged_in() ) {
  $user_ID = get_current_user_id();
  $username = get_user_meta( $user_ID, 'first_name', true);
  if ($username == '') {
    $username = 'Investor';
  }
  $maintitle = "Welcome ".$username;


$outstandingcapital = get_user_meta( $user_ID, 'capital', true );
$usermessage = get_user_meta( $user_ID, 'usermessage', true );

} else {
  $maintitle = "Welcome Investor";
}
?>
  <h1><?php echo $maintitle;?></h1>
  <?php if($outstandingcapital !== ''): ?>
  <div class="capital-big">
    <div class="top">Outstanding Invested Capital</div>
    <div class="sub"> <?php echo $outstandingcapital;?> </div>
  </div>
  <?php endif;?>

  <?php if($usermessage !== ''): ?>
  <div class="user-message">
    <?php echo wpautop($usermessage);?>
  </div>
  <?php endif;?>




  </div>

  <!-- RELEASE THE FILE GETTER -->

<?php
//GET ALL PROPERTY PAGES AND GET THEIR ASSOCIATED PROPERTY CATEGORY
$siloArray = array();
$propertyArray = array();

$po_addon = CUAR_Plugin::get_instance()->get_addon("post-owner");
$po_value = $po_addon->get_meta_query_post_owned_by( get_current_user_id() );

$args = array(
      'post_type' 		=> 'cuar_private_page',
      'orderby' 			=> 'title',
      'order' 			=> 'ASC',
      'meta_query' 		=> $po_value,
      'posts_per_page' => -1

    );

$files_in_cat_query = new WP_Query($args);
if($files_in_cat_query->have_posts()) {

  $pages = $files_in_cat_query->get_posts();
  foreach($pages as $p) {
    $prop = get_the_terms( $p->ID, 'properties' );
    if($prop) {
      if( !(in_array($prop[0]->slug, $propertyArray))) {
        array_push($propertyArray, $prop[0]->slug);
      }
    }
  }
}


/// ROLL TRU EACH PROP ARRAY
foreach($propertyArray as $pa):
//CREATE FILE ARRAY
$fileArray = array();

//GET PRIVATE FILES
$args = array(
  'post_type' 		=> 'cuar_private_file',
  'orderby' 			=> 'date',
  'order' 			=> 'DESC',
  'posts_per_page' => -1,
  'meta_query' 		=> $po_value,
  'tax_query' =>  array(
                    array(
                      'taxonomy' => 'properties',
                      'field'    => 'slug',
                      'terms'    => $pa,
                    ),
                  )
);
$pfiles_query = new WP_Query($args);
if ( $pfiles_query->have_posts()):

  $pfiles = $pfiles_query->get_posts();

  foreach($pfiles as $pf):
    array_push($fileArray, array(
      'isoDate' => intval(get_the_date( "Ymd", $pf->ID )),
      'fileID' => $pf->ID,
      'fileType' => 'private-file'
    ));
  endforeach;


//ENDING IF THE PRIVATE FILE IF
endif;


//GET THE GROUP FILES
$args = array(
      'post_type' 		=> 'group-files',
      'orderby' 			=> 'date',
      'order' 			=> 'DESC',
      'posts_per_page' => -1,
      'tax_query' =>  array(
                        array(
                          'taxonomy' => 'properties',
                          'field'    => 'slug',
                          'terms'    => $pa,
                        ),
                      )
    );
$gfiles_query = new WP_Query($args);
if ( $gfiles_query->have_posts()) :
$gfiles = $gfiles_query->get_posts();

//var_dump($gfiles);
  foreach ($gfiles as $gf) :
    // GET META CONTENT
    $thefile = get_post_meta( $gf->ID, 'group-file', true );
    $thefile = $thefile[0];
    if($thefile !== '' && $thefile !== null):
      array_push($fileArray, array(
        'isoDate' => intval(get_the_date( "Ymd", $gf->ID )),
        'fileID' => $gf->ID,
        'fileType' => 'group-file'
      ));
    endif;
  endforeach;


endif;
//END IF FOR GROUP FILES

//ENDING THE PROPERTY FOREACH
array_push($siloArray, array(
  'property' => $pa,
  'files' => $fileArray
));
endforeach;

//var_dump($siloArray);
$siloArray = array();



?>
<div id="file-container">
<?php
//WHAT HAPPENS IF THERE'S NO FILES
if (count($siloArray) == 0) :

?>

<h2> You have no files for view at this time.</h2>


<?php endif;?>

</div>













</div>










<?php get_footer();?>
