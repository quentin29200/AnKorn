<?php

namespace PA\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function afficherIndexAction($name)
    {
        return $this->render('PAGeneralBundle:Default:index.html.twig', array('name' => $name));
    }

    public function afficherTestAction()
    {
        return $this->render('PAGeneralBundle:Default:test.html.twig');
    }

    public function afficherMentionsAction()
    {
        return $this->render('PAGeneralBundle:Default:mentions.html.twig');
    }
}
