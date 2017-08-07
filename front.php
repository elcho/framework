<?php
require_once __DIR__.'/vendor/autoload.php';
//require_once './src/leapYearController.php';
//require_once './src/ageCalculatorcontroller.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;


function render_template(Request $request) //function used to generate a response based on the request information
{
    extract($request->attributes->all(), EXTR_SKIP); //instead of passing all request info as parameters, this will extract all attributes
    ob_start();
    include sprintf(__DIR__.'/src/pages/%s.php', $_route);

    return new Response(ob_get_clean());
}

$request = Request::createFromGlobals(); //creates a request object
$routes = include __DIR__.'/src/app.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

$framework = new Simplex\Framework($matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);

try {
    $request->attributes->add($matcher->match($request->getPathInfo())); //uses the request parameter to get the right page path

    $controller = $controllerResolver->getController($request); //based on the request determines which controller to use
   
    $arguments = $argumentResolver->getArguments($request, $controller); //uses PHP reflection to determine which arguments to send to controller based on the request

    $response = call_user_func_array($controller, $arguments);
} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response = new Response('Not Found', 404);
} catch (Exception $e) {
    echo $e;
    $response = new Response('An error occurred', 500);
}

$response->send();