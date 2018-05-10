<?php

namespace UsuarioBundle\Controller;

use UsuarioBundle\Entity\Usuario;
use UsuarioBundle\Form\UsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('UsuarioBundle:Default:index.html.twig');
    }
    /**
     * @Route("/form")
     */
    public function newAction(Request $request)
	{
    
    	$user = new Usuario();
    	$error = $authenticationUtils->getLastAuthenticationError();
    	$form = $this->createForm(UsuarioType::class);
   		$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {
	        $form->getData();

	        $user = $form->getData();

	        $em = $this->getDoctrine()->getManager();
	        $em->persist($user);
	        $em->flush();

        	return $this->redirectToRoute('task_success');

        
    	}
    	return $this->render('UsuarioBundle:Default/index.html.twig', array('form' => $form->createView()));
	}
}