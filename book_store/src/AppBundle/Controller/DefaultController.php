<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class DefaultController extends Controller
{

/**
 * @Route("/", name="home")
 **/
    public function indexAction()
    {
      return $this->render('default/index.html.twig', [
        'base_dir' => 'default/index.html.twig'
      ]);
    }


    public function createAdminAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
       $admin = new User();
       $form = $this->createForm(UserType::class, $admin);

      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          
        $password = $passwordEncoder->encodePassword($admin, $admin->getPlainPassword());
        $admin->setPassword($password);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($admin);
        $entityManager->flush();
        return $this->redirectToRoute('login');
    }
        return $this->render('Auth/register.html.twig',[
          'form'=> $form->createView(),
          'loginPage' => 1
        ]);
    }
/**
* @Route("/login", name="login")
**/

/*Rediriger la route vers une nouvelle URL*/
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('Auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
}
