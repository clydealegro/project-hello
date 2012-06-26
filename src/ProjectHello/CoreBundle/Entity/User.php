<?php

namespace ProjectHello\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectHello\CoreBundle\Entity\User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="ProjectHello\CoreBundle\Entity\UserRepository")
 */
class User
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $emailAddress
     *
     * @ORM\Column(name="email_address", type="string", length=100)
     */
    private $emailAddress;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=1000, nullable=true)
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * Get emailAddress
     *
     * @return string 
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
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