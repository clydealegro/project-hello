<?php

namespace ProjectHello\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectHello\CoreBundle\Entity\User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="ProjectHello\CoreBundle\Entity\UserRepository")
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="smallint")
 * @ORM\DiscriminatorMap({1 = "AccountOwner", 2 = "MessageAuthor"})
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
     * @var string $firstName
     *
     * @ORM\Column(name="first_name", type="string", length=50)
     */
    private $firstName;

    /**
     * @var string $lastName
     *
     * @ORM\Column(name="last_name", type="string", length=50)
     */
    private $lastName;

    /**
     * @var string $emailAddress
     *
     * @ORM\Column(name="email_address", type="string", length=100)
     */
    private $emailAddress;

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
     * Set firstName
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
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
}