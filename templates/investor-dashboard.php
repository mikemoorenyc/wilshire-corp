<?php
/**
 * Template Name: Investor Dashboard
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



<?php get_header();?>



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

function cmp($a, $b) {
  if ($a['isoDate'] == $b['isoDate']) {
      return 0;
  }
  return ($a['isoDate'] < $b['isoDate']) ? -1 : 1;
}

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
        array_push($propertyArray, array(
          'slug' => $prop[0]->slug,
          'id' => $p->ID
        ));
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
                      'terms'    => $pa['slug'],
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
                          'terms'    => $pa['slug'],
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
  'property-slug' => $pa['slug'],
  'property-id' => $pa['id'],
  'files' => $fileArray
));
endforeach;





?>
<div id="file-container">
<?php
//WHAT HAPPENS IF THERE'S NO FILES
if (count($siloArray) == 0) :

echo '<h2> You have no files for view at this time.</h2>';

endif;
//WE HAVE FILES!
if(count($siloArray) > 0):?>
<ul class="clearfix no-style">
<?php foreach($siloArray as $s):?>
  <li class="property">
    <div class="prop-header">
      <?php $catInfo = get_term_by('slug', $s['property-slug'], 'properties'); ?>
      <h2>
        <?php echo $catInfo->name; ?>
      </h2>
      <?php
      // GET THE FUND STUFF
      // GET TOTAL CAPITAL
      $total = get_post_meta( $s['property-id'], "_amount", true );
      if ($total !== ''):?>
      <div class="fund outstanding">
      Invested Capital: <strong><?php echo $total;?></strong>
      </div>
      <?php endif;

      //GET THE INDIVIDUAL FUNDS
      $funds = get_post_meta( $s['property-id'], "individual-investment-funds", true );
      if($funds !== ''):
      foreach($funds as $fund):
      ?>
      <div class="fund">
        <?php echo $fund['fund-name'];?>: <strong><?php echo $fund['investment-amount'];?></strong>

      </div>

      <?php
      endforeach;
      endif;?>

    </div> <!-- PROP HEADER -->
    <div class="prop-body">
    <?php
    // GET FILES
    $files = $s['files'];
    if (count($files) == 0) :
      echo '<h2 class="no-files">You have no files for this property</h2>';

    //END FOR NO FILES
    endif;


    if (count($files) > 0):
      usort($files, 'cmp');
      $files = array_reverse($files);

    ?>

    <ul class="file-list no-style">

      <?php

      if(count($files) > 3) {
        $looper = 3;
      } else {
        $looper = count($files);
      }

      ?>


    <?php for($i = 1; $i <= $looper; $i++):
      $file = $files[$i-1];
      ?>
   <?php

      downloadMaker($file['fileID'], $file['fileType'] );
      ?>


    <?php endfor;?>
    </ul>

    <a class="no-history archive" href="<?php echo home_url('/file-archive/?building_id='.$catInfo->term_id);?>">
<?php echo $catInfo->name;?> Archive
    </a>

    <?php
    //END FOR YES FILES
    endif;?>

  </div>

  </li>
<?php endforeach;?>
</ul>

<?php endif;?>



</div>













</div>


<div id="investor-footer-links">
<a class="edit no-history" href="<?php echo home_url('/edit-account/');?>">Edit Account</a>

<?php
if (  current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
  ?>
  <a class="admin no-history" href="<?php echo home_url('/wp-admin/');?>">Admin</a>

  <?php
}


?>
</div>








<?php get_footer();?>
