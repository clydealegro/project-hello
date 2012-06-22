<?php

namespace ProjectHello\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectHello\CoreBundle\Entity\MessageAuthor
 *
 * @ORM\Table(name="message_authors")
 * @ORM\Entity(repositoryClass="ProjectHello\CoreBundle\Entity\MessageAuthorRepository")
 */
class MessageAuthor extends User
{
    /**
     * @var boolean $isVerified
     *
     * @ORM\Column(name="is_verified", type="boolean")
     */
    private $isVerified;

    public function __construct()
    {
        $this->isVerified = false;
    }

    /**
     * Set isVerified
     *
     * @param boolean $isVerified
     */
    public function setIsVerified($isVerified)
    {
        $this->isVerified = $isVerified;
    }

    /**
     * Get isVerified
     *
     * @return boolean 
     */
    public function isVerified()
    {
        return $this->isVerified;
    }
}