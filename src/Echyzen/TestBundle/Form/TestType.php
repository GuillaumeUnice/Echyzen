<?php

namespace Echyzen\TestBundle\Form;

use Echyzen\NewsBundle\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TestType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', new ImageType(), array('required' => true))
            
            ->add('titre', 'text')
            ->add('avis', 'text')
            ->add('dateSortie', 'datetime')
            ->add('publicConcerne', 'text')
            ->add('adaptation', 'text')
            ->add('contenu', 'textparse')
            ->add('publication', 'checkbox', array('required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Echyzen\TestBundle\Entity\Test'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'echyzen_testbundle_test';
    }
}
