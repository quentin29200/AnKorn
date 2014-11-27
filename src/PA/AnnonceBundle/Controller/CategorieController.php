<?php

namespace PA\AnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use PA\AnnonceBundle\Entity\Categorie;
use PA\AnnonceBundle\Form\CategorieType;

// CONTROLEUR DE CATEGORIE
// REGROUPE L'ENSEMBLE DES ACTIONS POUVANT ETRE EFFECTUE SUR UNE CATEGORIE
class CategorieController extends Controller
{
    public function creerCategorieAction(Request $request)
    {
    	// Création de l'objet Annonce
    	$categorie = new Categorie();

    	// Création du formulaire a partir de Annonce Type
    	$form = $this->get('form.factory')->create(new CategorieType(), $categorie);

    	// Si quelque chose est renvoyé par la page et que les types correspondent bien
    	if ($form->handleRequest($request)->isValid()) {
    		  // On créé l'Entity Manager
    		  $em = $this->getDoctrine()->getManager();

    		  // On ajoute les données du formulaire à notre objet
      		$em->persist($categorie);

      		// On met la BDD à jour
      		$em->flush();

      		$request->getSession()->getFlashBag()->add('info','Categorie créée');
      		return $this->render('PAAnnonceBundle:Annonce:index.html.twig');
      	}

        return $this->render('PAAnnonceBundle:Categorie:ajoutercategorie.html.twig', array('form' => $form->createView()));
  }
}
