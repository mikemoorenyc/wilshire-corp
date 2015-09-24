<?php
add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
  echo '<style>
    #cuar_private_page_categorydiv, #cuar_private_file_categorydiv{
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
  </style>';
}

?>
