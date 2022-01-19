<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 
class SideBarController extends AbstractController
{

    /**
     * @Route("/sidebar/categories", name="sidebar.categories")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function displayCategories()
    {
        return $this->render('side_bar/display_categories.html.twig',
        [
            'categories' => [
                'categorie1',
                'categorie2',
                'categorie3',
                'categorie4',
                'categorie5',
            ]
        ]);
    }
}
