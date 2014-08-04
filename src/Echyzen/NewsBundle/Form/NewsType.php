<?php

namespace Echyzen\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', new ImageType(), array('required' => true))
            ->add('rubrique', 'entity', array(
                    'class'    => 'EchyzenNewsBundle:Rubrique',
                    'property' => 'nom',
                    'multiple' => false)
            )
            ->add('titre', 'text')
            ->add('contenu', 'textparse')
            ->add('publication', 'checkbox', array('required' => false))
            /*->add('motcles', 'collection', array('type'         => new MotCleType(),
                                              'allow_add'    => true,
                                              'allow_delete' => true));*/
            ->add('motcles', 'entity', array('class' => 'EchyzenNewsBundle:MotCle',
                  'property' => 'nom',
                  'multiple' => true,
                  'by_reference' => false,
                  ));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Echyzen\NewsBundle\Entity\News'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'echyzen_newsbundle_news';
    }
}
