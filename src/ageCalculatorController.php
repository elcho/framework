<?php
use Symfony\Component\HttpFoundation\Response;

class AgeCalculatorController
{        
    public function indexAction($age) //takes the properly typed request object as a parameter
    {        
        return new Response(my_age_in_2050($age));
    }
}