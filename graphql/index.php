<?php

require_once 'mutations.php';

add_filter('graphql_jwt_auth_secret_key', function() {
	return 'F52sPxcr,AX6N%mTw&tTA6tKMQE&jphOcAd|ThMt}d%(ZsaE=:x3/U>eke!#1)aM';
});

add_filter('graphql_jwt_auth_expire', function () {
	// token is valid for 3 months
	$expires = mktime(date("H")-1, date("i"), date("s"), date("m")+3, date("d"), date("Y"));
	return $expires;
});