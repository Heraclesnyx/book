<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{

/**
* @Route("/create_user", name="admin")
**/ 
    public function adminAction(Request $request)
    {
       $admin = new Users();

       $form = $this->createFormBuilder($admin)
       				->add('email', TextType::class)
       				->add('password', TextType::class)
       				->add('save', SubmitType::class, ['label' => 'Create Admin'])
       				->getForm();

       	return $this->render('base.html.twig',[
       		'form'=> $form->createView(),
       	]);
    }
}
