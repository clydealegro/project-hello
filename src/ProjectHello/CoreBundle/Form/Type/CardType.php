<?php

namespace ProjectHello\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CardType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
        	->add('proponent', new AccountOwnerType())
        	->add('recipients', 'collection', array(
        		'type' => new UserType(),
        	))
        	->add('messages', 'collection', array(
        		'type' => new MessageType(), 
        		'property_path' => false,
        	))
        	->add('collaborators', 'collection', array(
        		'type' => new UserType(), 
        		'property_path' => false,
        		'allow_add' => true,
        	))
        	->add('invitations', 'collection', array('type' => new InvitationType(), 'property_path' => false));
    }

    public function getName()
    {
        return 'card';
    }
}