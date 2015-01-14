<?php

namespace PA\PanierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use PA\AnnonceBundle\Entity\Annonce;
use PA\PanierBundle\Entity\Panier;

// CONTROLEUR DU PANIER 
// REGROUPE L'ENSEMBLE DES ACTIONS POUVANT ETRE EFFECTUE SUR UN PANNIER
class PanierController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PAPanierBundle:Panier:index.html.twig', array('name' => $name));
    }

    public function afficherPanierAction() {
    	/* EntityManager */
        $em = $this->getDoctrine()->getManager();

        /* Récupération des informations */
        $utilisateur = $this->container->get('security.context')->getToken()->getUser()->getId();
        $monpanier = $em->getRepository('PAPanierBundle:Panier')->affichermonpanier($utilisateur);

        return $this->render('PAPanierBundle:Panier:index.html.twig', array('panier' => $monpanier));


    }

    public function ajouterAnnonceAction(Request $request, $id) {
    	/* EntityManager */
    	$em = $this->getDoctrine()->getManager();

    	/* Récupération des informations */
    	$utilisateur = $this->container->get('security.context')->getToken()->getUser()->getId();
    	$annonce = $em->getRepository('PAAnnonceBundle:Annonce')->find($id);
    	$monpanier = $em->getRepository('PAPanierBundle:Panier')->recupmonpanier($utilisateur);

    	/* On ajoute l'annonce dans le pannier */
    	$monpanier->addPaAnnonce($annonce);

    	/* On met à jour la BDD */
    	$em->flush();
        $request->getSession()->getFlashBag()->add('info','Annonce ajoutée au panier');
    	return $this->render('PAPanierBundle:Panier:index.html.twig', array('panier' => $monpanier));
    }

    public function retirerAnnonceAction(Request $request, $id) {
    	/* EntityManager */
        $em = $this->getDoctrine()->getManager();

        /* Récupération des informations */
        $utilisateur = $this->container->get('security.context')->getToken()->getUser()->getId();
        $annonce = $em->getRepository('PAAnnonceBundle:Annonce')->find($id);
        $monpanier = $em->getRepository('PAPanierBundle:Panier')->recupmonpanier($utilisateur);

        /* On ajoute l'annonce dans le pannier */
        $monpanier->removePaAnnonce($annonce);

        /* On met à jour la BDD */
        $em->flush();
        $request->getSession()->getFlashBag()->add('info','Annonce retirée du panier');
        return $this->render('PAPanierBundle:Panier:index.html.twig', array('panier' => $monpanier));
    }
}
