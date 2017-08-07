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

function is_leap_year($year = null) {
    if (null === $year) {
        $year = date('Y');
    }

    return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
}

$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', array(
    'year' => null,
    '_controller' => 'LeapYearController::indexAction',
)));

function my_age_in_2050($age = null) {
    if (null === $age) {
        $age = 0;
    }
    $year_now = date('Y');
    return (2050 - $year_now) + $age;
}

$routes->add('my_age_in_2050', new Routing\Route('/my_age_in_2050/{age}', array(
    'age' => null,
    '_controller' => function ($request) {
        
        return new Response(my_age_in_2050($request->attributes->get('age')));
    }
)));

return $routes;