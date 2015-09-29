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
$prop_cat = intval($_GET["building_id"]);

$po_addon = CUAR_Plugin::get_instance()->get_addon("post-owner");
$po_value = $po_addon->get_meta_query_post_owned_by( get_current_user_id() );

//GET THE CATEGORy
//$ppage_terms = get_the_terms($prop_id, 'properties');
//$category = $ppage_terms[0];
$category = get_term($prop_cat,'properties');

//CHANGE THE NAME
?>
<script>
document.title = "<?php echo $category->name;?> File Archive | <?php echo $siteTitle ;?>";
</script>
<?php

$args = array(
      'post_type' 		=> 'cuar_private_page',
      'orderby' 			=> 'date',
      'order' 			=> 'DESC',
      'posts_per_page' => -1,
      'meta_query' 		=> $po_value,
      'tax_query' =>  array(
                        array(
                          'taxonomy' => 'properties',
                          'field'    => 'term_id',
                          'terms'    => $prop_cat ,
                        ),
                      )

);
$files_in_cat_query = new WP_Query($args);
if($files_in_cat_query->have_posts()) :
$ppages = $files_in_cat_query->get_posts();
$ppage = $ppages[0];
$pageexists = true;
endif;?>
<div id="investor-container">
  <div class="investor-header">
    <h1><?php echo $category->name;?> File Archive</h1>
    <?php if ($pageexists == true):?>
      <?PHp
      $totalcap = get_post_meta( $ppage->ID , "_amount", true );
      if ($totalcap !== '' && $totalcap !== null):?>
      <div class="capital-big">
        <div class="top">Outstanding Invested Capital</div>
        <div class="sub"> <?php echo $totalcap;?> </div>
      </div>
      <?php endif;?>

      <?php

      $funds = get_post_meta( $ppage->ID , "individual-investment-funds", true );
      if($funds !== '' && $funds !== null):
      foreach($funds as $fund):
      ?>
      <div class="fund">
        <?php echo $fund['fund-name'];?>: <strong><?php echo $fund['investment-amount'];?></strong>

      </div>

      <?php
      endforeach;
      endif;?>



    <?php endif;?>




    <?php
    if($ppage->post_content !== '' && $ppage->post_content !== null) :
    ?>
    <div class="user-message">
      <?php echo wpautop($ppage->post_content);?>
    </div>


    <?php

    endif;
    ?>
  </div>

  <?php
  //GET ALL FILES
  $docTypeArray = array();
  $fileArray = array();

  //GET THE PRIVATE FILES
  $args = array(
    'post_type' 		=> 'cuar_private_file',
    'orderby' 			=> 'date',
    'order' 			=> 'DESC',
    'posts_per_page' => -1,
    'meta_query' 		=> $po_value,
    'tax_query' =>  array(
                      array(
                        'taxonomy' => 'properties',
                        'field'    => 'term_id',
                        'terms'    => $prop_cat ,
                      ),
                    )
  );
  $pfiles_query = new WP_Query($args);
  if ( $pfiles_query->have_posts()):
    $pfiles = $pfiles_query->get_posts();
    foreach($pfiles as $pf):

      //PUT IT IN THE DOC ARRAY
      $docType = get_the_terms($pf->ID,'doc_type');
      if(count($docType) > 0 && $docType !== false){
        $docType = $docType[0]->slug;
      } else {
        $docType = 'misc';
      }
      if(!(in_array($docType, $docTypeArray))) {
        array_push( $docTypeArray, $docType);
      }

      //PUT IT IN THE $fileArray
      array_push($fileArray, array(
        'isoDate' => intval(get_the_date( "Ymd", $pf->ID )),
        'fileID' => $pf->ID,
        'fileType' => 'private-file',
        'docType' => $docType,
        'year' => intval(get_the_date( "Y", $pf->ID ))
      ));


    endforeach;


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
                        'field'    => 'term_id',
                        'terms'    => $prop_cat ,
                      ),
                    )
  );
  $pfiles_query = new WP_Query($args);
  if ( $pfiles_query->have_posts()):
    $pfiles = $pfiles_query->get_posts();
    foreach ($pfiles as $pf):

      //PUT IT IN THE DOC ARRAY
      $docType = get_the_terms($pf->ID,'doc_type');
      if(count($docType) > 0 && $docType !== false){
        $docType = $docType[0]->slug;
      } else {
        $docType = 'misc';
      }
      if(!(in_array($docType, $docTypeArray))) {
        array_push( $docTypeArray, $docType);
      }

      //PUT IT IN THE $fileArray
      array_push($fileArray, array(
        'isoDate' => intval(get_the_date( "Ymd", $pf->ID )),
        'fileID' => $pf->ID,
        'fileType' => 'group-file',
        'docType' => $docType,
        'year' => intval(get_the_date( "Y", $pf->ID ))
      ));

    endforeach;
  endif;


//MAKE CHRONILOGICAL
usort($fileArray, 'cmp');
$fileArray = array_reverse($fileArray);

function cmp($a, $b) {
if ($a['isoDate'] == $b['isoDate']) {
    return 0;
}
return ($a['isoDate'] < $b['isoDate']) ? -1 : 1;
}

//CHECK IF misc is in array
if(in_array('misc',$docTypeArray)) {
  $miscExists = true;
}


  ?>
<?php

function archiveLooper($theDocType, $theFiles) {
  $docSArray = array();
  $yearArray = array();
  foreach ($theFiles as $fa):
    if($fa['docType'] == $theDocType):
      array_push($docSArray, $fa);
      //PUSH TO YEAR ARRAY
      if(!(in_array($fa['year'],$yearArray))):
        array_push($yearArray, $fa['year']);
      endif;
    endif;
  endforeach;

  $looper = 0;
  foreach($yearArray as $ya):
  ?>
    <div class="date-opener section-<?php echo $looper;?>">
      <h4>
        <a href="#">
            <span class="copy">
              <?php echo $ya;?>
              <span class="arrow"><svg><use xlink:href="#down-arrow-sm" /></svg></span>
            </span>
        </a>
      </h4>
      <ul class="file-list archive no-style">
        <?php foreach($docSArray as $dsa):?>
          <?php if($dsa['year'] == $ya):?>

              <?php downloadMaker($dsa['fileID'],$dsa['fileType']);?>

          <?php endif;?>
        <?php endforeach;?>
      </ul>
    </div>
  <?php
  $looper++;
  endforeach;
}

//CHECK
if(count($fileArray)>0 && count($docTypeArray) > 0 ):
?>
<div id="file-container">
  <ul id="archive-list" class="no-style">
    <?php foreach($docTypeArray as $dt):
    if($dt !== 'misc'): ?>
      <li class="documents">
        <div class="prop-header">
          <?php $theDoc = get_term_by('slug', $dt, "doc_type"); ?>
          <h2><?php echo $theDoc->name;?></h2>
        </div>

        <?php archiveLooper($dt,$fileArray);?>



      </li>



    <?php endif;
    endforeach;?>
    <?php if($miscExists == true):?>
      <li class="documents">
        <div class="prop-header">
          <h2>Misc</h2>
        </div>
        <?php archiveLooper('misc',$fileArray);?>

      </li>

    <?php endif;?>
  </ul>



</div>

<div id="back-to-home">
  <a href="<?php echo $homeURL;?>/investor-dashboard" class="no-history">Back to Investor Home</a>

</div>
<?php
endif;
?>


</div>

<?Php get_footer();?>
