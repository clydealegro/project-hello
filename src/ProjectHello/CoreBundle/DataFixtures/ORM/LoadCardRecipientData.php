<?php

namespace ProjectHello\CoreBundle\DataFixtures\ORM;

use
    Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager,
    ProjectHello\CoreBundle\Entity\CardRecipient
;

/**
 * Fixture for loading card recipient data.
 *
 * @author projecthello
 */
class LoadCardRecipientData extends AbstractFixture implements
        OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // init data
        $data = array (
            array (
                'recipientName' => 'Mon',
            )
        );
        
        // persist data
        foreach ($data as $d) {
            
            $cardRecipient = new CardRecipient();
            $cardRecipient->setRecipientName($d['recipientName']);
            
            // recipient is always mon
            $cardRecipient->setRecipient($manager->merge($this->getReference(
                    'user14')));
            
            $cardRecipient->setCard($manager->merge($this->getReference(
                    'card0')));
            
            $manager->persist($cardRecipient);
            $manager->flush();
        }
    }
    
    // the order in which this fixture will be loaded
    public function getOrder()
    {
        return 3;
    }
}