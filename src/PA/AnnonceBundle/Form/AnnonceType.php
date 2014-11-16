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
            ->add('an_titre')
            ->add('an_description')
            ->add('an_datePublication')
            ->add('an_dateSupression')
            ->add('an_dateAcquisition')
            ->add('an_publie')
            ->add('an_image')
            ->add('an_categorie')
            ->add('an_user')
            ->add('an_prix')
            ->add('an_type')
            ->add('an_departement')
            ->add('an_cp')
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
