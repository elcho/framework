<?php
require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

//can now access the full API with the Request class:
// the URI being requested (e.g. /about) minus any query parameters
$request->getPathInfo();

// retrieve GET and POST variables respectively
$name = $request->query->get('name');

$age = $request->query->get('age');

$request->request->get('bar', 'default value if bar does not exist');

// retrieve SERVER variables
$request->server->get('HTTP_HOST');

// retrieves an instance of UploadedFile identified by foo
$request->files->get('foo');

// retrieve a COOKIE value
$request->cookies->get('PHPSESSID');

// retrieve an HTTP request header, with normalized, lowercase keys
$request->headers->get('host');
$request->headers->get('content_type');

$request->getMethod();    // GET, POST, PUT, DELETE, HEAD
$request->getLanguages(); // an array of languages the client accepts

$myIp = $request->getClientIp(true);

if ($myIp === $request->getClientIp(true)) { //just for demonstration only, it is always true
    echo "Your IP address matches our records!</br>";
    // the client is a known one, so give it some more privilege
} else {
    echo "Your IP is unidentified";
}

//simulate a request:
$input = $request->get('name', 'World');

//can now access the full API with the Response class:
$response = new Response(sprintf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')));

//or change around the response:
$response->setContent('Hello ' . $name . '!');
$response->setStatusCode(200);
$response->headers->set('Content-Type', 'text/html');

// configure the HTTP cache headers
$response->setMaxAge(10);

$response->send();