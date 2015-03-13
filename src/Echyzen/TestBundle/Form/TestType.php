<?php

namespace Echyzen\TestBundle\Form;

use Echyzen\NewsBundle\Form\ImageType;
use Echyzen\TestBundle\Form\Type\LolType;
use Echyzen\TestBundle\Form\Type\NumberFieldType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\DataTransformer\IntegerToLocalizedStringTransformer;
use Symfony\Component\Intl\NumberFormatter\NumberFormatter;
class TestType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $now = new \DateTime();
        $builder
            ->add('image', new ImageType(), array('required' => true))
            
            ->add('titre', 'text')
            ->add('dateSortie', 'date')       
            ->add('adaptation', 'text', array('required' => false))
            ->add('genres', 'entity', array('class' => 'EchyzenTestBundle:Genre',
                  'property' => 'nom',
                  'multiple' => true,
                  'by_reference' => false,
                  )) 
                            
            ->add('publicConcerne', 'text')
            //->add('avis', new LolType())
            ->add('avis', 'number', array('precision' => 2))
            /*->add('avis', 'number', array(
                'min' => 0,
                'max' => 5,
                'step' => 0.1,
                'value' => 0,
                ))*//*
            ->add('avis', 'integer', 
              array('attr' => array('max' => '5', 'min' => '0', 'step' => '0.1', 'value' => '0'),
                'precision' => 2,
                ))*/
            
            ->add('publication', 'checkbox', array('required' => false))

            ->add('contenu', 'textparse')
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
