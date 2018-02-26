<?php

require_once 'mutations.php';

add_filter('graphql_jwt_auth_secret_key', function() {
	return 'F52sPxcr,AX6N%mTw&tTA6tKMQE&jphOcAd|ThMt}d%(ZsaE=:x3/U>eke!#1)aM';
});