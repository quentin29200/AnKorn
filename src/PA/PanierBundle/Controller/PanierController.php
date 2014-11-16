<?php

namespace PA\PanierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


// CONTROLEUR DU PANIER 
// REGROUPE L'ENSEMBLE DES ACTIONS POUVANT ETRE EFFECTUE SUR UN PANNIER
class PanierController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PAPanierBundle:Panier:index.html.twig', array('name' => $name));
    }
}
