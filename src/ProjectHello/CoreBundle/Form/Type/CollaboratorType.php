<?php

namespace ProjectHello\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CollaboratorType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
        	->add('name', 'text', array(
                'max_length' => 15,
                'property_path' => false,
            ))
        	->add('email', 'email', array(
                'max_length' => 100,
                'property_path' => false,
            ));
    }
    
    /*public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => array(),
        );
    }*/

    public function getName()
    {
        return 'collaborator';
    }
}