<?php

namespace PA\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class UserType extends BaseType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
         parent::buildForm($builder, $options);
         $builder
         ->add('us_civilite')
         ->add('us_nom')
         ->add('us_prenom')
         ->add('us_tel')
         ;
     }
     
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PA\UserBundle\Entity\User'
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pa_userbundle_user';
    }
}
