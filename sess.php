<?
session_start();

	header('content-type:text/plain; charset=utf-8');
	echo
		'_SESSION: ', print_r($_SESSION),
		'_POST: ', print_r($_POST),
		'_GET: ', print_r($_GET),
		'_COOKIE', print_r($_COOKIE)
	;
echo "\n";
echo "\n";


echo "PHP_SELF = " . $_SERVER["PHP_SELF"] . "\n";
echo "DOCUMENT_ROOT = " . $_SERVER["DOCUMENT_ROOT"] . "\n";
echo "dirname( __FILE__ ) = " . dirname( __FILE__ ) . "\n";
echo "HTTP_USER_AGENT = " . $_SERVER["HTTP_USER_AGENT"] . "\n";
echo "HTTP_REFERER = " . $_SERVER["HTTP_REFERER"] . "\n";

echo "\n";

echo "HTTP_HOST = " . $_SERVER["HTTP_HOST"] . "\n";
echo "SERVER_NAME = " . $_SERVER["SERVER_NAME"] . "\n";
echo "SERVER_ADDR = " . $_SERVER["SERVER_ADDR"] . "\n";
echo "REMOTE_ADDR (user IP) = " . $_SERVER["REMOTE_ADDR"] . "\n";
echo "REMOTE_HOST = " . $_SERVER["REMOTE_HOST"] . "\n";
echo "REMOTE_PORT = " . $_SERVER["REMOTE_PORT"] . "\n";
echo "REMOTE_USER = " . $_SERVER["REMOTE_USER"] . "\n";
echo "REDIRECT_REMOTE_USER = " . $_SERVER["REDIRECT_REMOTE_USER"] . "\n";

echo "\n";

echo "REQUEST_METHOD = " . $_SERVER["REQUEST_METHOD"] . "\n";
echo "REQUEST_URI = " . $_SERVER["REQUEST_URI"] . "\n";
echo "SCRIPT_NAME = " . $_SERVER["SCRIPT_NAME"] . "\n";
echo "SCRIPT_FILENAME = " . $_SERVER["SCRIPT_FILENAME"] . "\n";
echo "QUERY_STRING = " . $_SERVER["QUERY_STRING"] . "\n";
echo "PATH_TRANSLATED = " . $_SERVER["PATH_TRANSLATED"] . "\n";
echo "PATH_INFO = " . $_SERVER["PATH_INFO"] . "\n";
echo "ORIG_PATH_INFO = " . $_SERVER["ORIG_PATH_INFO"] . "\n";
echo "REQUEST_TIME = " . $_SERVER["REQUEST_TIME"] . "\n";

echo "\n";

echo "GATEWAY_INTERFACE = " . $_SERVER["GATEWAY_INTERFACE"] . "\n";

echo "SERVER_SOFTWARE = " . $_SERVER["SERVER_SOFTWARE"] . "\n";
echo "SERVER_PROTOCOL = " . $_SERVER["SERVER_PROTOCOL"] . "\n";
echo "SERVER_ADMIN = " . $_SERVER["SERVER_ADMIN"] . "\n";
echo "SERVER_PORT = " . $_SERVER["SERVER_PORT"] . "\n";
echo "SERVER_SIGNATURE = " . $_SERVER["SERVER_SIGNATURE"] . "\n";

echo "\n";

echo "HTTP_CONNECTION = " . $_SERVER["HTTP_CONNECTION"] . "\n";
echo "HTTPS = " . $_SERVER["HTTPS"] . "\n";
echo "HTTP_ACCEPT = " . $_SERVER["HTTP_ACCEPT"] . "\n";
echo "HTTP_ACCEPT_CHARSET = " . $_SERVER["HTTP_ACCEPT_CHARSET"] . "\n";
echo "HTTP_ACCEPT_ENCODING = " . $_SERVER["HTTP_ACCEPT_ENCODING"] . "\n";
echo "HTTP_ACCEPT_LANGUAGE = " . $_SERVER["HTTP_ACCEPT_LANGUAGE"] . "\n";
echo "REQUEST_TIME_FLOAT = " . $_SERVER["REQUEST_TIME_FLOAT"] . "\n";
echo "PHP_AUTH_DIGEST = " . $_SERVER["PHP_AUTH_DIGEST"] . "\n";
echo "PHP_AUTH_USER = " . $_SERVER["PHP_AUTH_USER"] . "\n";
echo "PHP_AUTH_PW = " . $_SERVER["PHP_AUTH_PW"] . "\n";
echo "AUTH_TYPE = " . $_SERVER["AUTH_TYPE"] . "\n";

