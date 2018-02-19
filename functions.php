<?php

use GraphQL\Error\UserError;

//require_once 'configuration/index.php';
//require_once 'types/index.php';
require_once 'graphql/index.php';

function wp_custom_fields_project($fields) {

	$user_logged_in = is_user_logged_in();

//	if ( !$user_logged_in ) {
	$fields['title']['resolve'] = function()  { throw new UserError('Can\'t access this title.'); };
//	}

	return $fields;

}

add_filter('graphql_post_fields', 'wp_custom_fields_project', 11);