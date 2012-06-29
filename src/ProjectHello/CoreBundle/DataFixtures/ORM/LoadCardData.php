<?php

namespace ProjectHello\CoreBundle\DataFixtures\ORM;

use
    Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager,
    ProjectHello\CoreBundle\Entity\Card
;

/**
 * Fixture for loading card data.
 *
 * @author projecthello
 */
class LoadCardData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // init data
        $data = array (
            array (
                'sendingDate'   => new \DateTime(date('Y-m-d')),
                'dateCreated'   => new \DateTime(date('Y-m-d H:i:s')),
            )
        );
        
        // persist data
        $i = 0;
        foreach ($data as $d) {
            
            $card = new Card();
            $card->setSendingDate($d['sendingDate']);
            $card->setDateCreated($d['dateCreated']);
            
            // creator is always clyde
            $card->setCreator($manager->merge($this->getReference('user12')));
            
            $manager->persist($card);
            $manager->flush();
            
            $this->addReference('card' . $i ++, $card);
        }
    }
    
    // the order in which this fixture will be loaded
    public function getOrder()
    {
        return 2;
    }
}