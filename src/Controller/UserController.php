<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Security\EmailVerifier;
use App\Security\LoginFormAuthenticator;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use App\Service\GestionContact;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Role;

/**
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController {

  private $emailVerifier;

  /* public function __construct(EmailVerifier $emailVerifier)
    {
    $this->emailVerifier = $emailVerifier;
    } */

  /**
   * @Route("/inscription", name="inscription")
   */
  public function register(Role $role, GestionContact $inscrit, Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator): Response {
    $user = new User();
    $form = $this->createForm(userFormType::class, $user);
    $form->handleRequest($request);
    $role = new Role();
    $role->getLibelle('ROLE_ADMIN');

    if ($form->isSubmitted() && $form->isValid()) {
      // encode the plain password
      $user->setPassword(
        $passwordEncoder->encodePassword(
          $user,
          $form->get('plainPassword')->getData()
        )
      );
      $user->addLesRole($role);

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($user);
      $entityManager->flush();

      $inscrit->envoiMailConfirmation($user);

      return $guardHandler->authenticateUserAndHandleSuccess(
          $user,
          $request,
          $authenticator,
          'main' // firewall name in security.yaml
      );
    }

    return $this->render('user/register.html.twig', [
        'registrationForm' => $form->createView(),
    ]);
  }

  /**
   * 
   * @Route("/administration", name="administration")
   * @IsGranted("ROLE_ADMIN")
   */
  public function administrationUser(UserRepository $repo) {
    $users = $repo->findAll();

    return $this->render('administration/voirtous.html.twig',
        ['users' => $users]);
  }

  /**
   * 
   * @Route("/modifier/{id}", name="modification")
   * @IsGranted("ROLE_ADMIN")
   */
  public function modifierDetailsUser(Request $request, EntityManagerInterface $manager, int $id, UserRepository $repo) {
    $user = $repo->find($id);
    $form = $this->createForm(UserFormType::class, $user);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $user->setPassword(
        $passwordEncoder->encodePassword(
          $user,
          $form->get('plainPassword')->getData()
        )
      );
      $user->setRoles($form->get('roles')->getData());
      $manager->persist($user);
      $manager->flush();
      return $this->redirectToRoute('home');
    }
    return $this->render('administration/modificationUser.html.twig',
        ['form' => $form->createView() ]);
  }

  /**
   * @Route("/verify/email", name="app_verify_email")
   */
  /* public function verifyUserEmail(Request $request): Response
    {
    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    // validate email confirmation link, sets User::isVerified=true and persists
    try {
    $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
    } catch (VerifyEmailExceptionInterface $exception) {
    $this->addFlash('verify_email_error', $exception->getReason());

    return $this->redirectToRoute('app_register');
    }

    // @TODO Change the redirect on success and handle or remove the flash message in your templates
    $this->addFlash('success', 'Your email address has been verified.');

    return $this->redirectToRoute('app_register');
    } */
}
