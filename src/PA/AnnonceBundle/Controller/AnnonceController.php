<?php

namespace PA\AnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;

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

  	public function supprimerAnnonceAction($id, Request $request)
  	{
  	      $em = $this->getDoctrine()->getManager(); 
          // Récupération d'une annonce
          $annonce = $em->getRepository('PAAnnonceBundle:Annonce')->find($id);
          // Récupération de l'ID de l'utilisateur
          $utilisateur = $this->container->get('security.context')->getToken()->getUser()->getId();
          $isadmin = $this->get('security.context')->isGranted('ROLE_ADMIN');
          if ($annonce->getAnUser()->getId() == $utilisateur || $isadmin) {
              $annonce->setAnSupprimer(true);
              $em->persist($annonce);
              $em->flush();
              $request->getSession()->getFlashBag()->add('info','Votre annonce a bien été supprimée.');
              return $this->redirect($this->generateUrl('pa_annonce_afficher_mesannonces'));
          } else {
              $request->getSession()->getFlashBag()->add('warning','Vous n\'êtes pas autorisé à supprimer cette annonce');
              return $this->redirect($this->generateUrl('pa_annonce_afficher_mesannonces'));
          } 
  	}

    public function rechercherAnnonceAction($page, Request $request)
    {      
          $session = $request->getSession();
          $i = 0;        

          if($request->getMethod() == 'POST') {
              $secteurs = array();
              $nom = null;
              $type = null;
              $cat = null;
              // Récupération des données du formulaire de recherche
              if (isset($_POST['nom'])) {
                  $nom = $_POST['nom'];
              }
              if (isset($_POST['sect']) && !empty($_POST['sect'])) {
                foreach ($_POST['sect'] as $sect) {
                  $secteurs[$i] = $sect;
                  $i++;
                } 
              }
              if (isset($_POST['type'])) {
                  $type = $_POST['type']; 
              }
              if (isset($_POST['cat'])) {
                  $cat = $_POST['cat']; 
              }

              /*  Passage en session des paramètres de recherche */
              $session->clear();
              $session->set('nom', $nom);
              $session->set('secteurs', $secteurs);
              $session->set('type', $type);
              $session->set('cat', $cat);

          } else {
              
              if ($session->has('nom')) {
                $nom =  $session->get('nom');
              } else {
                $nom = null;
              }
              if ($session->has('secteurs')) {
                $secteurs =  $session->get('secteurs');
              } else {
                $secteurs = null;
              }
              if ($session->has('type')) {
                $type =  $session->get('type');
              } else {
                $type = null;
              }
              if ($session->has('cat')) {
                $cat =  $session->get('cat');
              } else {
                $cat = null;
              }

          }

          // On compte le nombre d'annonces à récupérer en fonction des paramètres
          $nbannonces = $this->getDoctrine()->getRepository("PAAnnonceBundle:Annonce")->countann(array("an_titre"=>$nom,"an_secteur"=>$secteurs, "an_type"=>$type, "an_categorie"=>$cat)); 


          // Récupération des annonces
          $annonces = $this->getDoctrine()->getRepository("PAAnnonceBundle:Annonce")->pagination(21, $page, "an_datePublication", "ASC",array("an_titre"=>$nom,"an_secteur"=>$secteurs, "an_type"=>$type, "an_categorie"=>$cat)); 

         // Récupération des catégories
          $categories = $this->affichercategorie();
         
          // Pagination
          $pagination = array(
              'page' => $page,
              'route' => 'afficher_resultat_annonce',
              'pages_count' => ceil($nbannonces[1] / 21)
          );


          if ($annonces != null) {
             return $this->render('PAAnnonceBundle:Annonce:listeannonces.html.twig', array('annonces'=> $annonces, 'pagination'=>$pagination, 'categories'=> $categories));
          } else {
             $request->getSession()->getFlashBag()->add('warning','Pas d\'annonces trouvées.');
             return $this->render('PAAnnonceBundle:Annonce:listeannonces.html.twig', array('annonces'=> $annonces, 'pagination'=>$pagination, 'categories'=> $categories));
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

  	public function afficherAnnoncesOffreAction($page, Request $request)
  	{
        $session = $request->getSession();
        $session->clear();
        $session->set('type', "offre");

        // On compte le nombre d'annonces à récupérer en fonction des paramètres
          $nbannonces = $this->getDoctrine()->getRepository("PAAnnonceBundle:Annonce")->countann(array("an_type"=>"offre")); 

        // Récupération des annonces
          $annonces = $this->getDoctrine()->getRepository("PAAnnonceBundle:Annonce")->pagination(21, $page, "an_datePublication", "ASC",array("an_type"=>"offre")); 

        // Récupération des catégories
          $categories = $this->affichercategorie();

        // Pagination
          $pagination = array(
              'page' => $page,
              'route' => 'afficher_resultat_annonce',
              'pages_count' => ceil($nbannonces[1] / 21)
          );

        return $this->render('PAAnnonceBundle:Annonce:listeannonces.html.twig',array('annonces'=> $annonces, 'pagination'=>$pagination, 'categories'=> $categories));
  	}

    public function afficherAnnoncesDemandeAction($page, Request $request)
    {
        $session = $request->getSession();
        $session->clear();
        $session->set('type', "demande");

        // On compte le nombre d'annonces à récupérer en fonction des paramètres
          $nbannonces = $this->getDoctrine()->getRepository("PAAnnonceBundle:Annonce")->countann(array("an_type"=>"demande")); 

        // Récupération des annonces
          $annonces = $this->getDoctrine()->getRepository("PAAnnonceBundle:Annonce")->pagination(21, $page, "an_datePublication", "ASC",array("an_type"=>"demande")); 

        // Récupération des catégories
          $categories = $this->affichercategorie();


        // Pagination
          $pagination = array(
              'page' => $page,
              'route' => 'afficher_resultat_annonce',
              'pages_count' => ceil($nbannonces[1] / 21)
          );
          
        return $this->render('PAAnnonceBundle:Annonce:listeannonces.html.twig',array('annonces'=> $annonces, 'pagination'=>$pagination, 'categories'=> $categories));
    }
      

      /* -- Vue autoremplie avec les donnees de l'annonce --- */
      /* ================================================================================ */
      /* ================================================================================ */
      /* --- A MODIFIER ! JE NE DOIS RECUPERER QUE L'ANNONCE QUI APPARTIENT AU BOUTON --- */
      /* ================================================================================ */
      /* ================================================================================ */
    public function afficherDetailAnnonceAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('PAAnnonceBundle:Annonce')->recupannonce($id);
        return $this->render('PAAnnonceBundle:Annonce:detailAnnonce.html.twig', array('annonce'=>$annonce));
    }

    public function affichercategorie()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('PAAnnonceBundle:Categorie')->findAll();
        return $categories;
    }
}
