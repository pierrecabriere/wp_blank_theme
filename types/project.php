<?php

function wp_custom_type_project() {

	$labelsProject = array(
		'name'                => _x('Projets', ''),
		'singular_name'       => _x('Projet', ''),
		'menu_name'           => __('Projets'),
		'all_items'           => __('Tous les projets'),
		'view_item'           => __('Voir les projets'),
		'add_new_item'        => __('Ajouter un nouveau projet'),
		'add_new'             => __('Ajouter'),
		'edit_item'           => __('Editer le projet'),
		'update_item'         => __('Modifier le projet'),
		'search_items'        => __('Rechercher un projet'),
		'not_found'           => __('Non trouvé'),
		'not_found_in_trash'  => __('Non trouvé dans la corbeille'),
	);

	$argsProject = array(
		'label'               => __('Projets'),
		'description'         => __(''),
		'labels'              => $labelsProject,
		'supports'            => array('title'),
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'show_in_graphql' 	  => true,
		'graphql_single_name' => 'project',
		'graphql_plural_name' => 'projects',
	);

	$labelsTaxonomyProject = array(
		'name'                => _x('Catégories', ''),
		'singular_name'       => _x('Catégorie', ''),
		'menu_name'           => __('Catégories'),
		'all_items'           => __('Toutes les catégories'),
		'view_item'           => __('Voir les catégories'),
		'add_new_item'        => __('Ajouter une nouvelle catégorie'),
		'add_new'             => __('Ajouter'),
		'edit_item'           => __('Editer la catégorie'),
		'update_item'         => __('Modifier la catégorie'),
		'search_items'        => __('Rechercher une catégorie'),
		'not_found'           => __('Non trouvée'),
		'not_found_in_trash'  => __('Non trouvée dans la corbeille'),
	);


	$argsTaxonomyProject = array(
		'label' 			  => __('Catégories'),
		'description'         => __(''),
		'labels'              => $labelsTaxonomyProject,
		'hierarchical' 		  => true,
		'show_in_graphql' 	  => true,
		'graphql_single_name' => 'projectCategory',
		'graphql_plural_name' => 'projectCategories',
	);

	register_post_type('project', $argsProject);
	register_taxonomy('project_category', 'project', $argsTaxonomyProject);

}

add_action('init', 'wp_custom_type_project');