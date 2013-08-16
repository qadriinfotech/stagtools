<?php

$labels = array(
	'name'               => __( 'Portfolio', 'stag' ),
	'singular_name'      => __( 'Portfolio', 'stag' ),
	'add_new'            => __( 'Add New', 'stag' ),
	'add_new_item'       => __( 'Add New Portfolio', 'stag' ),
	'edit_item'          => __( 'Edit Portfolio', 'stag' ),
	'new_item'           => __( 'New Portfolio', 'stag' ),
	'view_item'          => __( 'View Portfolio', 'stag' ),
	'search_items'       => __( 'Search Portfolio', 'stag' ),
	'not_found'          => __( 'No Portfolios found', 'stag' ),
	'not_found_in_trash' => __( 'No Portfolios found in trash', 'stag' ),
	'parent_item_colon'  => ''
);

$args = array(
	'labels'              => $labels,
	'public'              => true,
	'exclude_from_search' => true,
	'publicly_queryable'  => true,
	'rewrite'             => array('slug' => 'portfolio'),
	'show_ui'             => true,
	'query_var'           => true,
	'capability_type'     => 'post',
	'hierarchical'        => false,
	'menu_position'       => null,
	'supports'            => array( 'title', 'editor', 'thumbnail' )
);

register_post_type( 'portfolio', $args );

register_taxonomy( 'skill', 'portfolio', array(
	'hierarchical'   => true,
	'label'          => __( 'Skills', 'stag' ),
	'singular_label' => __( 'Skill', 'stag' ),
	'rewrite'        => array( 'slug' => 'skill', 'hierarchical' => true)
) );

function stag_portfolio_edit_columns( $columns ) {
	$columns = array(
		"cb" => "<input type=\"checkbox\">",
		"title" => __( 'Portfolio Title', 'stag' ),
		"type" => __( 'Skills', 'stag' ),
		"date" => __('Date', 'stag')
	);
	return $columns;
}

function stag_portfolio_custom_column( $columns ) {
	global $post;
	switch ($columns){
		case 'type':
		echo get_the_term_list($post->ID, 'skill', '', ', ','');
		break;
	}
}

add_filter("manage_edit-portfolio_columns", "stag_portfolio_edit_columns");
add_action("manage_posts_custom_column",  "stag_portfolio_custom_column");
