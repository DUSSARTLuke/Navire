<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PaysRepository;

/**
 * @Route("/pays", name="pays_")
 */
class PaysController extends AbstractController {

  
  /**
   * 
   * @Route("/voirtous", name="voirtous")
   * @param PaysRepository $repo
   * @return type
   */
  public function voirtous(PaysRepository $repo) {
    $pays = $repo->findAll();

    return $this->render('pays/voirtous.html.twig',
        ['pays' => $pays]);
  }

  
}
