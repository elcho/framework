<?php
namespace Calendar\Model;

class AgeCalculator 
{
    public function myAgeIn2050($age = null) 
    {
        if (null === $age) {
            $age = 0;
        }
        
        $year_now = date('Y');
        
        return (2050 - $year_now) + $age;
    }
}