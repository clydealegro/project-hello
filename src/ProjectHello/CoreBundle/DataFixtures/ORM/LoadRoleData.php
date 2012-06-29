<?php

namespace ProjectHello\CoreBundle\DataFixtures\ORM;

use ProjectHello\CoreBundle\Entity\Role;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRoleData extends AbstractFixture
{
    /**
     * Loads fixtures
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $memberRole = new Role();
        $memberRole->setName('ROLE_MEMBER');

        $manager->persist($memberRole);
        $manager->flush();
    }
}