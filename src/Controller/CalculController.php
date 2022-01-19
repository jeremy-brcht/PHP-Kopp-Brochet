<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CalculController
{
    /**
     * @Route ("/solve/{nb1}+{nb2}")
     */
    public function solve($nb1,$nb2)
    {
        $resultat=$nb1+$nb2;
        return new Response($resultat);
    }

    /**
     * @Route ("/solve/{nb1}-{nb2}")
     */
    public function solvemoins($nb1,$nb2)
    {
        $resultat=$nb1-$nb2;
        return new Response($resultat);
    }
    /**
     * @Route ("/solve/{nb1}*{nb2}")
     */
    public function solvefois($nb1,$nb2)
    {
        $resultat=$nb1*$nb2;
        return new Response($resultat);
    }

    /**
     * @Route ("/solve/{nb1}/{nb2}")
     */
    public function solvedivise($nb1,$nb2)
    {
        $resultat=$nb1/$nb2;
        return new Response($resultat);
    }

    /**
     * @Route ("/solve/{nb1}carree")
     */
    public function carre($nb1)
    {
        $resultat=$nb1*$nb1;
        return new Response($resultat);
    }

}