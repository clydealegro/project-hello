<?php

namespace ProjectHello\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectHello\CoreBundle\Entity\Card
 *
 * @ORM\Table(name="cards")
 * @ORM\Entity(repositoryClass="ProjectHello\CoreBundle\Entity\CardRepository")
 */
class Card
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
     * @var date $sendingDate
     *
     * @ORM\Column(name="sending_date", type="date")
     */
    private $sendingDate;
    
    /**
     * @var string $guestToken
     *
     * @ORM\Column(name="guest_token", type="string", length=255)
     */
    private $guestToken;

    /**
     * @var datetime $dateCreated
     *
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id", nullable=false)
     */
    private $creator;

    public function __construct()
    {
        $this->dateCreated = new \DateTime('now');
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
     * Set sendingDate
     *
     * @param date $sendingDate
     */
    public function setSendingDate($sendingDate)
    {
        $this->sendingDate = $sendingDate;
    }

    /**
     * Get sendingDate
     *
     * @return date 
     */
    public function getSendingDate()
    {
        return $this->sendingDate;
    }

    /**
     * Set dateCreated
     *
     * @param datetime $dateCreated
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * Get dateCreated
     *
     * @return datetime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set creator
     *
     * @param User $creator
     */
    public function setCreator(User $creator)
    {
        $this->creator = $creator;
    }

    /**
     * Get creator
     *
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set guestToken
     *
     * @param string $guestToken
     */
    public function setGuestToken($guestToken)
    {
        $this->guestToken = $guestToken;
    }

    /**
     * Get guestToken
     *
     * @return string 
     */
    public function getGuestToken()
    {
        return $this->guestToken;
    }
}