<?php

namespace PA\AnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use PA\AnnonceBundle\Entity\Annonce;
use PA\AnnonceBundle\Form\AnnonceType;

// CONTROLEUR D'ANNONCE 
// REGROUPE L'ENSEMBLE DES ACTIONS POUVANT ETRE EFFECTUE SUR UNE ANNONCE
class AnnonceController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PAAnnonceBundle:Annonce:index.html.twig', array('name' => $name));
    }
    public function creerAnnonceAction(Request $request)
    {
    	// Création de l'objet Annonce
    	$annonce = new Annonce();

    	// Création du formulaire a partir de Annonce Type
    	$form = $this->get('form.factory')->create(new AnnonceType(), $annonce);

    	// Si quelque chose est renvoyé par la page et que les types correspondent bien
    	if ($form->handleRequest($request)->isValid()) {
    		// On créé l'Entity Manager
    		$em = $this->getDoctrine()->getManager();

    		// On ajoute les données du formulaire à notre objet
      		$em->persist($advert);

      		// On met la BDD à jour
      		$em->flush();

      		$request->getSession()->getFlashBag()->add('info','Annonce créée');
      		return $this->render('PAAnnonceBundle:Default:index.html.twig');
      	}

        return $this->render('PAAnnonceBundle:Annonce:ajouterannonce.html.twig', array('form' => $form->createView()));
    }
	public function supprimerAnnonceAction($annonce)
	{
	        return $this->render('PAAnnonceBundle:Annonce:index.html.twig');
	}

	public function modifierAnnonceAction($annonce)
	{
	        return $this->render('PAAnnonceBundle:Annonce:index.html.twig');
	}

	public function afficherAnnonceAction($annonce)
	{
	        return $this->render('PAAnnonceBundle:Annonce:index.html.twig');
	}

	public function afficherAnnoncesAction()
	{
	        return $this->render('PAAnnonceBundle:Annonce:index.html.twig');
	}
}
