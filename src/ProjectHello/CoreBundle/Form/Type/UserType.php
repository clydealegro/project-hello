<?php

namespace ProjectHello\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
        	->add('emailAddress', 'email', array(
                'max_length' => 100
            ))
            ->add('password', 'password', array(
                'max_length' => 15
            ))
            ->add('confirmPassword', 'password', array(
                'property_path' => false,
                'max_length'    => 15
            ));
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'ProjectHello\CoreBundle\Entity\User',
        );
    }

    public function getName()
    {
        return 'user';
    }
}