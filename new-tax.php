<?php
function create_doctype() {
	register_taxonomy(
		'doc_type',
		array(
      'cuar_private_file',
      'group-files'
    ),
		array(
			'label' => 'Document Types',
      'labels' => array(
        'name' => 'Document Types',
        'singular_name' => 'Document Type',
        'add_new_item' => 'Add New Document Type',
        'popular_items' => 'Popular Document Types'
      ),
      'public' => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'hierarchical' => false
		)
	);
}
add_action( 'init', 'create_doctype' );

function create_property_cat() {
	register_taxonomy(
		'properties',
		array(
      'cuar_private_file',
      'group-files',
      'cuar_private_page',
      'portfolio'
    ),
		array(
			'label' => 'Properties',
      'labels' => array(
        'name' => 'Properties',
        'singular_name' => 'Property',
        'add_new_item' => 'Add New Property',
        'popular_items' => 'Popular Properties'
      ),
      'public' => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'hierarchical' => false
		)
	);
}
add_action( 'init', 'create_property_cat' );

//UNREGISTER shit
function unregister_private_files(){
    register_taxonomy('cuar_private_file_category', array());
}
add_action('init', 'unregister_private_files');
function unregister_private_pages(){
    register_taxonomy('cuar_private_page_category', array());
}
add_action('init', 'unregister_private_pages');


 ?>
