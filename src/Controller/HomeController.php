<?php


namespace App\Controller;

use App\Repository\FilmsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class HomeController extends AbstractController{

  /**
     * @Route("/Home", name="Home")
     */
  public function home(FilmsRepository $res):Response{
   $films=$res->findAll();
    return $this->render("Home.html.twig",[
        'films'=>$films
    ]
);
  }
  


}










?>