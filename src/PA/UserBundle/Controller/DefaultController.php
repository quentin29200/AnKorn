<?php

namespace PA\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use PA\UserBundle\Entity\User;
use PA\UserBundle\Form\UserType;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PAUserBundle:layout.html.twig');
    }

    public function modifierUserAction()
  	{
        $em = $this->getDoctrine()->getManager();

        // Récupération de l'ID de l'utilisateur
        $userid = $this->container->get('security.context')->getToken()->getUser()->getId();

        // Récupération de l'user
        $user = $em->getRepository('PAUserBundle:User')->find($userid);
        
        return $this->render('PAUserBundle:User:monCompte.html.twig', array('user' => $user));
        	
    }
}
