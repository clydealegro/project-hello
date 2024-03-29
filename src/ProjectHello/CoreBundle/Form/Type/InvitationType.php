<?php

namespace ProjectHello\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class InvitationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('instruction', 'textarea', array('max_length' => 255));
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'ProjectHello\CoreBundle\Entity\Invitation',
        );
    }

    public function getName()
    {
        return 'invitation';
    }
}