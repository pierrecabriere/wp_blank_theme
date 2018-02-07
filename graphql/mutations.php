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
			'phone' => [
				'type' => Types::string(),
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
			'captchaToken' => [
				'type' => Types::non_null( Types::string() ),
				'description' => __( '' ),
			],
		],
		'outputFields' => [
		],
		'mutateAndGetPayload' => function( $input ) {

			// vérification du captcha
			$secret = "6LcDGkUUAAAAAC7F7m1Lo7g5oZ4z73dsRw1QBznu";
			$response = $input['captchaToken'];

			$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $response;

			$decode = json_decode(file_get_contents($api_url), true);

			if ($decode['success'] !== true) {
				throw new \Exception('Invalid captcha');
			}

			$input['message'] = nl2br($input['message']);

			// notification email sent to admin
			$to = get_bloginfo('admin_email');
			$subject = 'Pierrecabriere.fr - Contact de ' . $input['fullname'];
			$headers = array('Content-Type: text/html; charset=UTF-8');

			$context = Timber::get_context();
			$context['input'] = $input;
			$body = Timber::compile('templates/mail.contact.twig', $context);

			wp_mail($to, $subject, $body, $headers);

			// confirmation email sent to customer
			$to = $input['email'];
			$subject = 'Accusé de réception automatique';
			$headers = array('Content-Type: text/html; charset=UTF-8');

			$context = Timber::get_context();
			$context['input'] = $input;
			$body = Timber::compile('templates/mail.contact.accuse_reception.twig', $context);

			wp_mail($to, $subject, $body, $headers);
		},
	]);
	return $fields;
}

add_filter('graphql_rootMutation_fields', 'wp_contact_mutation');