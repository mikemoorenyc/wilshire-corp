<?php global $siteDir; global $homeURL;?>


</div><!-- MAIN CONTENT -->
</div><!-- INNER -->
</div><!-- SCROLLING FRAME -->
<script>
ga('send', 'pageview', '<?php echo get_page_link();?>');
</script>
</div><!-- DYANMIC PAGE CONTENT-->
</div><!-- AJAX CATCHER -->


  <script async="true" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script id="inline-scripts"><?php $inlinejs = file_get_contents($siteDir.'/js/inline-load.js'); dirReplacer($inlinejs);?></script>


  </body>
</html>
