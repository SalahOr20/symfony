<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController{



    /**
     * @Route("/accueil")
     */
    public function ac():Response{
        return $this->render("base.html.twig");
    }
}









?>