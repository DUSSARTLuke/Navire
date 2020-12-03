<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/aisshiptype/", name="aisshiptype")
     */
class AisShipTypeController extends AbstractController
{
    /**
     * @Route("index", name="index")
     */
    public function index(): Response
    {
        return $this->render('ais_ship_type/index.html.twig', [
            'controller_name' => 'AisShipTypeController',
        ]);
    }
}
