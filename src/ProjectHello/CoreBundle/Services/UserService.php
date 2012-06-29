<?php

namespace ProjectHello\CoreBundle\Services;

use Doctrine\ORM\EntityManager;

class UserService
{
    private $manager;

    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    public function retrieveUserByEmailAddress($email)
    {
        return $this->manager->getRepository('ProjectHelloCoreBundle:User')->findOneBy(array(
            'emailAddress' => $email
        ));
    }
}