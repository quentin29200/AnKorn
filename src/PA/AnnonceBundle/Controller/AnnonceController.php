<?php

namespace PA\AnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use PA\AnnonceBundle\Entity\Annonce;
use PA\AnnonceBundle\Form\AnnonceType;
use PA\UserBundle\Entity\User;

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
        $utilisateur = new User();

      	// Création du formulaire a partir de Annonce Type
      	$form = $this->createForm(new AnnonceType, $annonce);

      	// Si quelque chose est renvoyé par la page et que les types correspondent bien
      	if ($form->handleRequest($request)->isValid()) {
      		  // On créé l'Entity Manager
      		  $em = $this->getDoctrine()->getManager();

            // Récupération de l'ID de l'utilisateur
            $iduser = $this->container->get('security.context')->getToken()->getUser()->getId();
            $utilisateur = $em->getRepository('PAUserBundle:User')->find($iduser);
      		  $annonce->setanuser($utilisateur);

            // On ajoute les données du formulaire à notre objet
        		$em->persist($annonce);

        		// On met la BDD à jour
        		$em->flush();

        		$request->getSession()->getFlashBag()->add('info','Votre annonce a bien été créée.');
        		return $this->redirect($this->generateUrl('pa_annonce_afficher_mesannonces'));
        	}

          return $this->render('PAAnnonceBundle:Annonce:formvuannonce.html.twig', array('form' => $form->createView(), 'iscreation' => true));
    }

    public function affSecteurAction()
    {
        $request = $this->container->get('request');
        $departement = $request->request->get('depart'); // On récupère le département passé en POST en AJAX

        if ($departement != null) {
          $secteurs = new JsonResponse(); // On créé un JSON
          switch ($departement) {
            case "armor" :      $secteurs->setData(array( 
                                    'lan' => "Lannion",
                                    'guimp' => "Guingamp",
                                    'brieuc' => "Saint Brieuc",
                                    'lam' => "Lamballe"
                                ));
                                break;
            case "finistere" :  $secteurs->setData(array(
                                    'bre' => "Brest",
                                    'quimp' => "Quimper",
                                    'mor' => "Morlaix",
                                    'chat' => "Chateaulin/Crozon",
                                    'car' => "Carhaix"
                                ));
                                break;
            case "ile" :        $secteurs->setData(array(
                                    'ren' => "Rennes",
                                    'foug' => "Fougère",
                                    'malo' => "Saint Malo",
                                    'red' => "Redon"
                                ));
                                break;
            case "morbihan" :   $secteurs->setData(array(
                                    'lor' => "Lorient",
                                    'van' => "Vannes",
                                    'ploer' => "Ploërmel",
                                    'pont' => "Pontivy"
                                ));
          }
          return $secteurs; //On renvoie un JSON à la vue courante
        }
        return null;
    }

  	public function supprimerAnnonceAction($annonce)
  	{
  	        return $this->render('PAAnnonceBundle:Annonce:index.html.twig');
  	}

    public function rechercherAnnonceAction($page, Request $requete)
    {
        
        
          $secteurs = array();
          $i = 0;

          if($requete->getMethod() == 'POST') {
              // Récupération des données du formulaire de recherche
              $nom = $_POST['nom']; 
              if (isset($_POST['sect']) && !empty($_POST['sect'])) {
                foreach ($_POST['sect'] as $sect) {
                  $secteurs[$i] = $sect;
                  $i++;
                } 
              }
              $type = $_POST['type']; 
              $cat = $_POST['cat']; 

              $em = $this->getDoctrine()->getManager(); 

              // Récupération des annonces
              $annonces = $em->getRepository('PAAnnonceBundle:Annonce')->searchannonces($page, $nom, $secteurs, $type, $cat);
              $nombreannonces = count($annonces);

              // Pagination
              $pagination = array(
                  'page' => $page,
                  'route' => 'afficher_resultat_annonce',
                  'pages_count' => ceil($nombreannonces / 21),
                  'route_params' => array()
              );

              if ($annonces != null) {
                 return $this->render('PAAnnonceBundle:Annonce:listeannonces.html.twig', array('annonces'=> $annonces,'pagination'=> $pagination));
              } else {
                 $request->getSession()->getFlashBag()->add('warning','Pas d\'annonces trouvées.');
                 return $this->render('PAAnnonceBundle:Annonce:listeannonces.html.twig', array('annonces'=> $annonces,'pagination'=> $pagination));
              }
          }
    }

  	public function modifierAnnonceAction($id, Request $request)
  	{
  	        $em = $this->getDoctrine()->getManager(); 
            // Récupération d'une annonce
            $annonce = $em->getRepository('PAAnnonceBundle:Annonce')->find($id);
            // Récupération de l'ID de l'utilisateur
            $utilisateur = $this->container->get('security.context')->getToken()->getUser()->getId();
            $isadmin = $this->get('security.context')->isGranted('ROLE_ADMIN');
            if ($annonce->getAnUser()->getId() == $utilisateur || $isadmin){
                // Formulaire d'édition
                $formeditannonce = $this->createForm(new AnnonceType, $annonce);
                if ($formeditannonce->handleRequest($request)->isValid()) {
                    // Test de validation

                    // On ajoute les données du formulaire à notre objet
                    $em->persist($annonce);

                    // On met la BDD à jour
                    $em->flush();

                    $request->getSession()->getFlashBag()->add('info','Votre annonce a bien été modifée.');
                    return $this->redirect($this->generateUrl('pa_annonce_afficher_mesannonces'));
                }
                return $this->render('PAAnnonceBundle:Annonce:formvuannonce.html.twig', array('form' => $formeditannonce->createView(),'idannonce' =>$id, 'iscreation' => false));
            } else{
                $request->getSession()->getFlashBag()->add('warning','Vous n\'êtes pas autorisé à modifier cette annonce');
                return $this->redirect($this->generateUrl('pa_annonce_afficher_mesannonces'));
            }	
    }

  	public function afficherAnnonceAction($annonce)
  	{
  	        return $this->render('PAAnnonceBundle:Annonce:index.html.twig');
  	}

    public function afficherMesAnnoncesAction()
    {
        $em = $this->getDoctrine()->getManager();

        // Récupération de l'ID de l'utilisateur
        $utilisateur = $this->container->get('security.context')->getToken()->getUser()->getId();

        $annonces = $em->getRepository('PAAnnonceBundle:Annonce')->recupmesannonces($utilisateur);
        return $this->render('PAAnnonceBundle:Annonce:mesannonces.html.twig', array('annonces'=> $annonces));
    }

  	public function afficherAnnoncesOffreAction()
  	{
        $em = $this->getDoctrine()->getManager();
        $annonces = $em->getRepository('PAAnnonceBundle:Annonce')->recupannoncesoffre();
        return $this->render('PAAnnonceBundle:Annonce:listeannonces.html.twig',array('annonces'=> $annonces));
  	}

    public function afficherAnnoncesDemandeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $annonces = $em->getRepository('PAAnnonceBundle:Annonce')->recupannoncesdemande();
        return $this->render('PAAnnonceBundle:Annonce:listeannonces.html.twig',array('annonces'=> $annonces));
    }
      /* -- Vue autoremplie avec les donnees de l'annonce --- */
      /* ================================================================================ */
      /* ================================================================================ */
      /* --- A MODIFIER ! JE NE DOIS RECUPERER QUE L'ANNONCE QUI APPARTIENT AU BOUTON --- */
      /* ================================================================================ */
      /* ================================================================================ */
    public function afficherDetailAnnonceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('PAAnnonceBundle:Annonce')->recupannonces();
        return $this->render('PAAnnonceBundle:Annonce:detailAnnonce.html.twig', array('annonce'=>$annonce));
    }
}
