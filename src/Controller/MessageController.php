<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\MessageType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Message;

/**
 * @Route("/message", name="message_")
 */
class MessageController extends AbstractController
{

  /**
   * @Route("/contact", name="contact")
   */
  public function formContact(Request $request)
  {
    $contact = new Message();
    $form = $this->createForm(MessageType::class, $contact);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      $this->addFlash('notification', "Votre message a bien été envoyé");
      $contact = $form->getData();
      $contact->setDateHeureContact(new \DateTime());
      //$gestionContact->creerContact($contact);

      //$gestionContact->envoiMailContact($contact);


      //return $this->redirectToRoute("contact_success");
    }
    return $this->render('message/contact.html.twig', [
        'form' => $form->createView(),
    ]);
  }
}
