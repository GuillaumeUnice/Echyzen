<?php

namespace Echyzen\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Echyzen\NewsBundle\Form\ImageType;
use Echyzen\TestBundle\Form\TestType;
class TestEditType extends TestType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // On fait appel à la méthode buildForm du parent, qui va ajouter tous les champs à $builder
        parent::buildForm($builder, $options);

        // On supprime celui qu'on ne veut pas dans le formulaire de modification
        $builder->remove('image');
        $builder->add('image', new ImageType(), array('required' => false));

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'echyzen_testbundle_testedit';
    }
}
