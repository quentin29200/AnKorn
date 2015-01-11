<?php
namespace PA\GeneralBundle\Twig;
 
use \Symfony\Component\DependencyInjection\ContainerInterface;
 
class PAExtension extends \Twig_Extension {
 
    /**
     * Retourne le nom de l'extension.
     *
     * @return array
     */
    public function getName() {
 
        return 'Retourne';
    }
 
    /**
     * PAExtension la liste des Filtres de template à ajouter à Twig.
     *
     * @return array
     */
    public function getFilters() {
 
        return array(
            'truncate' => new \Twig_Filter_Method( $this, 'truncate' ),
        );
    }
 
    /**
     * Tronque le texte en argument.
     * Si la longueur du texte est supérieure à $maxLength, $suffix est ajouté à la chaîne.
     *
     * @param string $text Chaîne à tronquer
     * @param int $maxLength Longueur maximale autorisée pour la chaîne
     * @param string $suffix Le sufixe à ajouter si besoin
     * @return string
     */
    public static function truncate( $text, $maxLength, $suffix = '...' ) {
 
        $truncatedText = $text;
 
        mb_internal_encoding( 'UTF-8' );
 
        $length      = mb_strlen( $text );
        $sufixlength = mb_strlen( $suffix );
 
        // Si le texte est trop long
        if ( $length > $maxLength && $length >= $sufixlength ) {
 
            $truncatedText = mb_substr( $text, 0, $maxLength - $sufixlength ) . $suffix;
        }
        return $truncatedText;
    }
}