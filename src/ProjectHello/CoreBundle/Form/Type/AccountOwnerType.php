<?php

namespace ProjectHello\CoreBundle\Form\Type;


class AccountOwnerType extends UserType
{
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'ProjectHello\CoreBundle\Entity\AccountOwner',
        );
    }
    
    public function getName()
    {
        return 'accountOwner';
    }
}