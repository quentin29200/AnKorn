<?php

namespace PA\AnnonceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnnonceType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('an_titre', 'text', array('label'=>'Titre* : '))
            ->add('an_description', 'textarea', array('label'=>'Description* : '))
            ->add('an_image', 'text', array('label'=>'URL de l\'image : '))
            ->add('an_categorie', 'entity', array('class' => 'PAAnnonceBundle:Categorie', 'property' => 'libelle', 'label'=>'Catégorie* : '))
            ->add('an_type', 'choice', array('label'=>'Type* : ', 'choices'=>array('offre' => 'Offre','demande'=>'Demande')))
            ->add('an_prix', 'integer', array('label'=>'Prix (€): '))
            ->add('an_departement', 'choice', array('label'=>'Département* : ', 'choices'=>array('armor' => 'Côtes d\'armor','finistere' => 'Finistère', 'ile' => 'Ile et Vilaine', 'morbihan' => 'Morbihan')))
            ->add('an_secteur', 'choice', array('empty_value' => '', 'label'=>'Secteur* : ', 'choices'=>array('choix' => '--Veuillez choisir un département--')))
            ->add('an_publie', 'checkbox', array('label'=>'Visible : ', 'required'  => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PA\AnnonceBundle\Entity\Annonce'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pa_annoncebundle_annonce';
    }
}
