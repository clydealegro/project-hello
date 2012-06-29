<?php

namespace ProjectHello\CoreBundle\DataFixtures\ORM;

use
    Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager,
    ProjectHello\CoreBundle\Entity\User
;

/**
 * Fixture for loading user data.
 *
 * @author projecthello
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // init data
        $userData = array (
            array ( // 0
                'email'             => 'farly.taboada@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 1
                'email'             => 'ryan.vy@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 2
                'email'             => 'yan.yan@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 3
                'email'             => 'joy.moreno@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 4
                'email'             => 'jean.abapo@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 5
                'email'             => 'des.blanco@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 6
                'email'             => 'naldz.castellano@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 7
                'email'             => 'eric.burabod@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 8
                'email'             => 'vanessa.santillan@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 9
                'email'             => 'chris.petilla@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 10
                'email'             => 'mercy.honor@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 11
                'email'             => 'neri.celeste@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 12
                'email'             => 'clyde.alegro@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 13
                'email'             => 'noel.bacarisas@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
            array ( // 14
                'email'             => 'mon.abilar@goabroad.com',
                'password'          => 'password123456',
                'dateRegistered'    => new \DateTime(date('Y-m-d')),
            ),
        );
        
        // persist data
        $i = 0;
        foreach ($userData as $u) {
            
            $user = new User();
            $user->setEmailAddress($u['email']);
            $user->setPassword($u['password']);
            $user->setDateRegistered($u['dateRegistered']);
            
            $manager->persist($user);
            $manager->flush();
            
            $this->addReference('user' . $i ++, $user);
        }
    }
    
    // the order in which this fixture will be loaded
    public function getOrder()
    {
        return 1;
    }
}