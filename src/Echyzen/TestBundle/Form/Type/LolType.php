<?php

namespace Echyzen\TestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface; 


use Symfony\Component\Form\FormTypeInterface;

use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

use Echyzen\TestBundle\Form\Type\NumberToStringTransformer;
class LolType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
          'attr' => array('class' => 'lol')
        ));
    }

    public function getName()
    {
        return 'lol';
    }
    public function getParent()
    {
        return 'integer';
    }



}
