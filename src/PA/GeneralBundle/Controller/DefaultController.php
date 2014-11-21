<?php

namespace PA\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    /* -- Page d index, d accueil --- */
    public function afficherIndexAction()
    {
        return $this->render('PAGeneralBundle:Default:index.html.twig');
    }

    /* -- Page des offres --- */
    public function afficherOffresAction()
    {
        return $this->render('PAGeneralBundle:Default:offres.html.twig');
    }

    /* -- Page des demandes --- */
    public function afficherDemandesAction()
    {
        return $this->render('PAGeneralBundle:Default:demandes.html.twig');
    }

    /* -- Page des mes annonces --- */
    public function afficherMesAnnoncesAction()
    {
        return $this->render('PAGeneralBundle:Default:mesAnnonces.html.twig');
    }

    /* -- Page de mon compte --- */
    public function afficherMonCompteAction()
    {
        return $this->render('PAGeneralBundle:Default:monCompte.html.twig');
    }

    /* -- Page de mon compte --- */
    public function afficherPanierAction()
    {
        return $this->render('PAGeneralBundle:Default:panier.html.twig');
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
        return $this->render('PAGeneralBundle:Default:connexion.html.twig');
    }

    /* --- Page de deconnexion --- */
    public function deconnexionAction()
    {
        return $this->render('PAGeneralBundle:Default:deconnexion.html.twig');
    }

    /* --- PAGE VIDE A REMPLACER --- */
    public function afficherVIDEAction()
    {
        return $this->render('PAGeneralBundle:Default:vide.html.twig');
    }

}