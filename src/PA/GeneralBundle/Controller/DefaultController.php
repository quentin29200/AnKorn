<?php

namespace PA\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    /* -- Page d index, d accueil --- */
    public function afficherIndexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $annonces = $em->getRepository('PAAnnonceBundle:Annonce')->recupannonces();
        return $this->render('PAGeneralBundle:Default:index.html.twig', array('entities'=>$annonces));
    }

    /* -- Page des offres --- */
    public function afficherOffresAction()
    {
        $em = $this->getDoctrine()->getManager();
        $annonces = $em->getRepository('PAAnnonceBundle:Annonce')->recupannonces();
        return $this->render('PAGeneralBundle:Default:offres.html.twig', array('entities'=>$annonces));
    }

    /* -- Page des demandes --- */
    public function afficherDemandesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $annonces = $em->getRepository('PAAnnonceBundle:Annonce')->recupannonces();
        return $this->render('PAGeneralBundle:Default:demandes.html.twig', array('entities'=>$annonces));
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
        return $this->redirect('/anKorn/web/app_dev.php/login');
    }

    /* --- Page d'inscription --- */
    public function afficheInscriptionAction()
    {
        return $this->render('PAGeneralBundle:Default:inscription.html.twig');
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

    /* --- Redirection vers la page de connexion --- */
    public function redirectConnexionAction(){
        return $this->redirect($this->generateUrl('welcome'), 301);
    }

    /* --- Affichage des annonces --- */
    public function afficherAnnoncesAction()
    {
      $em = $this->getDoctrine()->getManager();
      $annonces = $em->getRepository('PAAnnonceBundle:Annonce')->recupannonces();
      return $this->render('PAAnnonceBundle:Annonce:listeannonces.html.twig',array('entities'=> $annonces));
    }

    /* --- Page de l'interface administrateur --- */
    public function afficheInterfaceAction()
    {
        // On affiche l'interface de gestion
        return $this->render('PAGeneralBundle:Default:interfaceGestion.html.twig');
    }

}