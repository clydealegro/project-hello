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
     * @var DateTime $isVerified
     *
     * @ORM\Column(name="date_verified", type="datetime")
     */
    private $dateVerified;

    public function __construct()
    {
        $this->dateVerified = new \DateTime('now');
    }

    /**
     * Set dateVerified
     *
     * @param DateTime $dateVerified
     */
    public function setDateVerified($dateVerified)
    {
        $this->dateVerified = $dateVerified;
    }

    /**
     * Get dateVerified
     *
     * @return DateTime
     */
    public function getDateVerified()
    {
        return $this->dateVerified;
    }
}