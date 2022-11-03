<?php

namespace App\Controller;

use App\Repository\GenresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Genres;
use App\Entity\Search;
use App\Form\GenresType;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

    class GenresController extends AbstractController{

        /**
         *@Route("/Genres" , name="genres")
        */
        public function Afficher_genres(GenresRepository $res,EntityManagerInterface $manager,Request $request):Response{
             $genres=$res->findAll();
        
             
             
            return $this->render('/Genres/Genres.html.twig',[
                'genres'=>$genres
               
            ]);
        }
        /**
         *@Route("/Genres/Creation" , name="genreadd")
        */
        public function add_genre(EntityManagerInterface $manager ,Request $request){
             $genre=new Genres();
             $form=$this->createForm(GenresType::class,$genre);
             $form->handleRequest($request);
             if($form->isSubmitted()&& $form->isValid()){
            $genre=$form->getData();
            $manager->persist($genre);
            $manager->flush();
            $this->addFlash('succes',"genre bien ajouter");

              
            return $this->redirectToRoute('genres');

        }
    
         return $this->render("Genres/create.html.twig",[
           'form'=>$form->createView()
         ]);
             }
             /**
     * @Route("/Genres/{id}/Edit", name="genreedit")
     */
    public function edit(Request $request, Genres $genre):Response{
      
        $form=$this->createForm(GenresType::class,$genre);
      
      $form->handleRequest($request);
      if($form->isSubmitted()&& $form->isValid()){
        $genre=$form->getData();
        $entityManager=$this->getDoctrine()->getManager();
        
        $entityManager->persist($genre);
        $entityManager->flush();
        $this->addFlash('succes',"genre bien modifier");
        return $this->redirectToRoute('genres');

     }
          return $this->render("Genres/edit.html.twig",[
            'form'=>$form->createView()
        ]);
     }


             
    /**
     * @Route("/Genres/{id}/Supprimer", name="genresup")
    */
    public function delete(EntityManagerInterface $manager,Genres $id):Response{
        $manager->remove($id);
        $manager->flush();
        $this->addFlash('succes',"genre bien supprimer");
      
 
         return $this->redirectToRoute('genres');
     }
        

}




?>