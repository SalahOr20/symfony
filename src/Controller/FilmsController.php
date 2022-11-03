<?php



namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Films;
use App\Entity\Search;
use App\Form\FilmsType;
use App\Form\SearchType;
use App\Repository\FilmsRepository;
use App\Repository\GenresRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class FilmsController extends AbstractController{

    /**
     *@Route("/Films" , name="films")
    */
    public function Afficher_films(FilmsRepository $res,Request $request):Response{
         $films=$res->findAll();
      


        return $this->render('/Films/Films.html.twig',[
            'films'=>$films,
          
        ]);
    }
   
        /**
     *@Route("/Film/{id}" , name="film")
    */
    public function Afficher_film(FilmsRepository $res, $id):Response{
        $film=$res->find($id);
   
     
       
        return $this->render('/Films/film.html.twig',[
           'film'=>$film
       ]);
   }
         /**
     *@Route("/Film/{id}/genre" , name="listg")
    */
    public function list_genre(FilmsRepository $res, $id):Response{
      $film=$res->find($id);
    $search=  $film->getGenre()->getId();
  
      $recherches=$res->findBySearch($search);

      
      return $this->render('/Films/search.html.twig',[
         'recherches'=>$recherches
     ]);
 }




    /**
     * @Route("/Films/Creation", name="filmadd")
     */
    public function creation(EntityManagerInterface $manager, Request $request):Response{
        $film=new Films();
        $form=$this->createForm(FilmsType::class,$film);
       
      $form->handleRequest($request);
      if($form->isSubmitted()&& $form->isValid()){
    

        $file=$film->getAffiche();
        $fileName=$file->getClientOriginalName();
        try {
          $file->move(
              $this->getParameter('photo_directory'),
              $fileName
          );
      } catch (FileException $e) {
       
      }
              
          $film->setAffiche($fileName);
   

        $manager->persist($film);
        $manager->flush();
    $this->addFlash('succes',"bien ajouter");
    return $this->redirectToRoute("films");
          }
     
          return $this->render("Films/Creation.html.twig",[
            'form'=>$form->createView()
        ]);
     }
       /**
     * @Route("/Films/{id}/Edit", name="filmed")
     */
    public function edit(Request $request, Films $film):Response{
      
        $form=$this->createForm(FilmsType::class,$film);
      
      $form->handleRequest($request);
      if($form->isSubmitted()&& $form->isValid()){
        $file=$film->getAffiche();
        $fileName=$file->getClientOriginalName();
  try {
    $file->move(
        $this->getParameter('photo_directory'),
        $fileName
    );
} catch (FileException $e) {
 
}
    $film->setAffiche($fileName);
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($film);
        $entityManager->flush();
        $this->addFlash('succes'," film bien modifier");
        return $this->redirectToRoute('films');
      

     }
          return $this->render("Films/Creation.html.twig",[
            'form'=>$form->createView()
        ]);
     }


    /**
     * @Route("/Films/{id}/Supprimer", name="filmsup")
    */
    public function delete(EntityManagerInterface $manager,Films $id):Response{
        $manager->remove($id);
        $manager->flush();
        $this->addFlash('succes',"film bien supprimer");
      
 
         return $this->redirectToRoute('films');
     }
  
}

?>