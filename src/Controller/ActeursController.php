<?php




namespace App\Controller;

use App\Entity\Acteurs;
use App\Entity\Films;
use App\Form\ActeursType;
use App\Repository\ActeursRepository;
use Doctrine\DBAL\Events;
use Doctrine\Migrations\Events as MigrationsEvents;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\Event;
use Vich\UploaderBundle\Event\Event as EventEvent;
use Vich\UploaderBundle\Event\Events as EventEvents;

class ActeursController extends AbstractController{

    /**
     *@Route("/Acteurs" , name="acteurs")
    */
    public function afficher_acteurs(ActeursRepository $res):Response{
         $acteurs=$res->findAll();
         
        return $this->render('/Acteurs/Acteurs.html.twig',[
            'acteurs'=>$acteurs
        ]);
    }
   
        /**
     *@Route("/Acteurs/{id}" , name="acteur")
    */
    public function afficher_acteur(ActeursRepository $res, $id):Response{
        $acteur=$res->find($id);


       return $this->render('/Acteurs/Acteur.html.twig',[
           'acteur'=>$acteur
       ]);
   }
 
    /**
     * @Route("/Acteur/Creation", name="acteurcr")
     */

     public function creation(Request $request):Response{
        $acteur=new Acteurs();
        $form=$this->createForm(ActeursType::class,$acteur);
 
      $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
          $file=$acteur->getPhoto();
          $fileName=$file->getClientOriginalName();
    try {
      $file->move(
          $this->getParameter('photo_directory'),
          $fileName
      );
  } catch (FileException $e) {
   
  }
          $entityManager=$this->getDoctrine()->getManager();
          
      $acteur->setPhoto($fileName);
          $entityManager->persist($acteur);
          $entityManager->flush();
          $this->addFlash('succes',"acteur bien ajouter");
          return $this->redirectToRoute('acteurs');

       }
          return $this->render("Acteurs/Creation.html.twig",[
            'form'=>$form->createView()
        ]);
     }




    /**
     * @Route("/Edit/{id}", name="acteured")
    */
  

    public function edit(Request $request,Acteurs $acteur):Response{
      
        $form=$this->createForm(ActeursType::class,$acteur);
 
      $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
          $file=$acteur->getPhoto();
          $fileName=$file->getClientOriginalName();
    try {
      $file->move(
          $this->getParameter('photo_directory'),
          $fileName
      );
  } catch (FileException $e) {
   
  }
          $entityManager=$this->getDoctrine()->getManager();
          
      $acteur->setPhoto($fileName);
          $entityManager->persist($acteur);
          $entityManager->flush();
          $this->addFlash('succes',"acteur bien ajouter");
          return $this->redirectToRoute('acteurs');

       }
          return $this->render("Acteurs/Creation.html.twig",[
            'form'=>$form->createView()
        ]);
     }

      /**
     * @Route("/Acteurs/{id}/Supprimer", name="acteursup")
    */
    public function delete(Acteurs $id):Response{
      $this->getDoctrine()->getManager()->remove($id);
      $this->getDoctrine()->getManager()->flush();
   
      $this->addFlash('succes',"acteur bien supprimer");

       return $this->redirectToRoute('acteurs');
   }



    
}


?>