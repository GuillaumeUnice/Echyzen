<?php

namespace Echyzen\TestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface; 


use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;


class NumberFieldType extends AbstractType
{
/**
     * {@inheritDoc}
     */
    public function getDefaultOptions(array $options)
    {
        $options = parent::getDefaultOptions($options);
        return $options;
    }

public function setDefaultOptions(OptionsResolverInterface $resolver){
    
    $resolver->setDefaults(array( 'min' => 0));
    $resolver->setDefaults(array( 'max' => 100));
    $resolver->setDefaults(array( 'step' => 0));
    $resolver->setDefaults(array( 'value' => 0));


}

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAttribute('min', $options['min']);
        $builder->setAttribute('max', $options['max']);
        $builder->setAttribute('step', $options['step']);
        $builder->setAttribute('value', $options['value']);
    }
 
    /*public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->set('min', $form->getAttribute('min'));
    }*/
        public function buildView (FormView $view, FormInterface $form, array $options)
    {
         //$form->offsetSet('min', 3);
        $view->vars['min'] = $options['min'];
        $view->vars['max'] = $options['max'];
        $view->vars['step'] = $options['step'];
        $view->vars['value'] = $options['value'];
       
    }
 
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'number_field';
    }


}
