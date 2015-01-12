<?php

namespace PA\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{

    /* -- Page d index, d accueil --- */
    public function afficherIndexAction($page, Request $request)
    {
         $session = $request->getSession();
         $session->clear();
        // On compte le nombre d'annonces à récupérer en fonction des paramètres
          $nbannonces = $this->getDoctrine()->getRepository("PAAnnonceBundle:Annonce")->countann(); 

        // Récupération des annonces
          $annonces = $this->getDoctrine()->getRepository("PAAnnonceBundle:Annonce")->pagination(21, $page, "an_datePublication", "ASC"); 
    
        // Pagination
          $pagination = array(
              'page' => $page,
              'route' => 'afficher_resultat_annonce',
              'pages_count' => ceil($nbannonces[1] / 21)
          );

        return $this->render('PAGeneralBundle:Default:index.html.twig', array('annonces'=>$annonces, 'pagination'=>$pagination));
    }

    /* -- Page de mon compte --- */
    public function afficherMonCompteAction()
    {
        return $this->render('PAGeneralBundle:Default:monCompte.html.twig');
    }

    /* -- Page de contact --- */
    public function afficherContactAction()
    {
        return $this->render('PAGeneralBundle:Default:contact.html.twig');
    }

    /* --- Page des mentions legales --- */
    public function afficherMentionsAction()
    {
        return $this->render('PAGeneralBundle:Default:mentions.html.twig');
    }

    /* --- Page de connexion --- */
    public function connexionAction()
    {
        return $this->redirect('/anKorn/web/app_dev.php/login');
    }

    /* --- Page d'inscription --- */
    public function afficheInscriptionAction()
    {
       return $this->redirect('/anKorn/web/app_dev.php/register/');
    }

    /* --- Page des liens --- */
    public function afficheLiensAction()
    {
        return $this->render('PAGeneralBundle:Default:liens.html.twig');
    }

    /* --- Page de deconnexion --- */
    public function deconnexionAction()
    {
        return $this->redirect('/anKorn/web/app_dev.php/logout');
    }

    /* --- Page de l'interface administrateur --- */
    public function afficheInterfaceAction()
    {
        // On affiche l'interface de gestion
        return $this->render('PAGeneralBundle:Default:interfaceGestion.html.twig');
    }

}