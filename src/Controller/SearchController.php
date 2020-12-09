<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Repository\NavireRepository;

/**
 * @Route("/search", name="search_")
 */
class SearchController extends AbstractController
{

  public function searchBar(){
    $form = $this->createFormBuilder()
            ->setAction($this->generateUrl("search_handlesearch"))
            ->add('cherche', TextType::class)
            ->add('envoiimo', SubmitType::class)
            ->add('envoimmsi', SubmitType::class)
            ->getForm()
      ;
    return $this->render('elements/searchbar.html.twig', [
                  'formSearch' => $form->createView()
    ]);
  }
  
  
  /**
   * 
   * @Route("/handlesearch", name="handlesearch")
   * @param Request $request
   * @param NavireRepository $repo
   * @return Response
   */
  public function handleSearh(Request $request, NavireRepository $repo) : Response {
    $valeur = $request->request->get('form')['cherche'];
    if(isset($request->request->get('form')['envoiimo'])){
      $critere = "imo Recherché : " . $valeur;
    } else {
      $critere = "mmsi recherché " . $valeur;
    }
    return new Response("<h1> $critere </h1>");
  }
}
