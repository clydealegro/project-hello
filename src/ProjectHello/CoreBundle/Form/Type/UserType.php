<?php

namespace ProjectHello\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
        	->add('firstName', 'text')
        	->add('emailAddress', 'email');
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