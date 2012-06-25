<?php

namespace ProjectHello\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectHello\CoreBundle\Entity\AccountOwner
 *
 * @ORM\Table(name="card_creators")
 * @ORM\Entity(repositoryClass="ProjectHello\CoreBundle\Entity\CardCreatorRepository")
 */
class CardCreator extends User
{
    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=1000)
     */
    private $password;

    /**
     * @var datetime $dateRegistered
     *
     * @ORM\Column(name="date_registered", type="datetime")
     */
    private $dateRegistered;

    public function __construct()
    {
        $this->dateRegistered = new \DateTime('now');
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set dateRegistered
     *
     * @param datetime $dateRegistered
     */
    public function setDateRegistered($dateRegistered)
    {
        $this->dateRegistered = $dateRegistered;
    }

    /**
     * Get dateRegistered
     *
     * @return datetime 
     */
    public function getDateRegistered()
    {
        return $this->dateRegistered;
    }
}