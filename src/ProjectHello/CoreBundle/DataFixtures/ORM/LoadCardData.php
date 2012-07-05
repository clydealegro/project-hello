<?php

namespace ProjectHello\CoreBundle\DataFixtures\ORM;

use
    Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager,
    ProjectHello\CoreBundle\Entity\Card,
    Symfony\Component\DependencyInjection\ContainerAwareInterface,
    Symfony\Component\DependencyInjection\ContainerInterface
;

/**
 * Fixture for loading card data.
 *
 * @author projecthello
 */
class LoadCardData extends AbstractFixture implements OrderedFixtureInterface,
        ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container = null;
    
    // implementing ContainerAware allows us to use service container
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
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
            
            $token = $this->container->get('token_service')->getEncryptedToken(
                    array (
                        'creator_id'    => $card->getCreator()->getId(),
                        'date_created'  => date('Y-m-d H:i:s')
                    ));
            $card->setGuestToken($token);
            
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