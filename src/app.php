<?php
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;

$routes = new Routing\RouteCollection();

$routes->add('hello', new Routing\Route('/hello/{name}', array(
    'name' => 'World',
    '_controller' => 'render_template',
)));

$routes->add('bye', new Routing\Route('/bye/{name}', array(
    'name' => 'World',
    '_controller' => 'render_template',
)));


$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', array(
    'year' => null,
    '_controller' => 'Calendar\Controller\LeapYearController::indexAction',
)));

$routes->add('my_age_in_2050', new Routing\Route('/my_age_in_2050/{age}', array(
    'age' => null,
    '_controller' => 'Calendar\Controller\AgeCalculatorController::indexAction',
)));
return $routes;