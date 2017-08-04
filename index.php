<?php
require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

//can now access the full API with the Request class:
// the URI being requested (e.g. /about) minus any query parameters
$request->getPathInfo();

// retrieve GET and POST variables respectively
$request->query->get('foo');
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

if ($myIp === $request->getClientIp(true)) {
    // the client is a known one, so give it some more privilege
}

//simulate a request:
$input = $request->get('name', 'World');

//can now access the full API with the Response class:
$response = new Response(sprintf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')));

//or change around the response:
$response->setContent('Hello world!');
$response->setStatusCode(200);
$response->headers->set('Content-Type', 'text/html');

// configure the HTTP cache headers
$response->setMaxAge(10);

$response->send();