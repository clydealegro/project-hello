<?php

namespace ProjectHello\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use ProjectHello\CoreBundle\Form\Type\CollaboratorType;
use Symfony\Component\Locale\Stub\StubIntlDateFormatter;

class CardType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('creatorName', 'text', array(
                'property_path' => false,
            ))
            ->add('recipientName', 'text', array(
                'property_path' => false,
            ))
            ->add('recipientEmailAddress', 'email', array(
                'property_path' => false,
            ))
            ->add('message', 'textarea', array(
                'property_path' => false,
            ))
            ->add('collaborators', 'collection', array(
                'type' => new CollaboratorType(),
                'property_path' => false,
                'allow_add' => true,
            ))
            ->add('instruction', 'textarea', array(
                'property_path' => false,
            ))
            ->add('sendingDate', 'date', array('widget' => 'single_text', 'format' => StubIntlDateFormatter::SHORT));
    }

    public function getName()
    {
        return 'card';
    }
}