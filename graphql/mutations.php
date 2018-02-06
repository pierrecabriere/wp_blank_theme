<?php

use GraphQLRelay\Relay;
use WPGraphQL\Types;
use Timber\Timber;

function wp_contact_mutation($fields) {
	$fields['contact'] = Relay::mutationWithClientMutationId([
		'name' => 'Contact',
		'isPrivate' => false,
		'description' => __( 'Send mail contact' ),
		'inputFields' => [
			'email' => [
				'type' => Types::non_null( Types::string() ),
				'description' => __( '' ),
			],
			'fullname' => [
				'type' => Types::non_null( Types::string() ),
				'description' => __( '' ),
			],
			'message' => [
				'type' => Types::non_null( Types::string() ),
				'description' => __( '' ),
			],
		],
		'outputFields' => [
		],
		'mutateAndGetPayload' => function( $input ) {
			$to = $input['email'];
			$subject = 'Accusé de réception automatique';
			$headers = array('Content-Type: text/html; charset=UTF-8');

			$context = Timber::get_context();
			$context['input'] = $input;
			$body = Timber::compile('templates/mail.accuse_reception.twig', $context);

			wp_mail($to, $subject, $body, $headers);
		},
	]);
	return $fields;
}

add_filter('graphql_rootMutation_fields', 'wp_contact_mutation');