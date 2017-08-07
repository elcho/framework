<?php
namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Calendar\Model\AgeCalculator;

class AgeCalculatorController
{        
    public function indexAction($age) //takes the properly typed request object as a parameter
    {  
        $ageCalculator = new AgeCalculator();
        return new Response($ageCalculator->myAgeIn2050($age));
    }
}