<?php

namespace Claroline\ExampleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class ExampleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //The field name is mandatory. This is a non mapped variable of AbstractResource.
        $builder->add('name', 'text', array('constraints' => new NotBlank()));
        $builder->add('text', 'textarea');
    }

    public function getName()
    {
        return 'example_form';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'translation_domain' => 'resource'
            )
        );
    }
}