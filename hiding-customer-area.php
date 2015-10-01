<?php
add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
  echo '<style>
    #cuar_private_page_categorydiv, #cuar_private_file_categorydiv, li#toplevel_page_wpca{
      display: none;
    }
    #wpadminbar, #adminmenu, #adminmenuback, #adminmenuwrap {
      background: #003052;
    }
    html {
      background:white;
    }
    #wp-admin-bar-wp-logo {
      display: none;
    }
    #wp-content-editor-tools {
      background: white;
    }
    body.customer-area_page_wpca-list-content-cuar_private_file li#toplevel_page_admin-page-wpca-list-2Ccontent-2Ccuar_private_file a {
      background: #0073aa;
      color: white;
    }
    body.customer-area_page_wpca-list-content-cuar_private_page li#toplevel_page_admin-page-wpca-list-2Ccontent-2Ccuar_private_page a {
      background: #0073aa;
      color: white;
    }
    ul#adminmenu a.wp-has-current-submenu:after, ul#adminmenu>li.current>a.current:after {
      display: none;
    }
  </style>';
}


function sideBarFixes() {
  add_menu_page( 'Private Pages', 'Private Pages', 'manage_options' ,'admin.php?page=wpca-list%2Ccontent%2Ccuar_private_page', '', get_bloginfo('template_url').'/assets/imgs/private-page-icon-2.png', '2.1');
  add_menu_page( 'Private Files', 'Private Files', 'manage_options', 'admin.php?page=wpca-list%2Ccontent%2Ccuar_private_file', '', get_bloginfo('template_url').'/assets/imgs/private-file-icon.png', '2.2');
  add_menu_page( 'Group Files', 'Group Files', 'manage_options', 'edit.php?post_type=group-files', '', get_bloginfo('template_url').'/assets/imgs/group-file-icon.png', '2.3');
    //admin.php?page=wpca-list%2Ccontent%2Ccuar_private_file
}






add_action( 'admin_menu', 'sideBarFixes' );
?>
