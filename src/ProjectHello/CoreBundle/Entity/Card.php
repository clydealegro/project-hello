<?php

namespace ProjectHello\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;

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
     * @var smallint $type
     *
     * @ORM\Column(name="type", type="smallint")
     */
    private $type;

    /**
     * @var datetime $dateCreated
     *
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $dateCreated;

    /**
     * @var date $deadline
     *
     * @ORM\Column(name="deadline", type="date")
     */
    private $deadline;

    /**
     * @var AccountOwner $proponent
     *
     * @ORM\ManyToOne(targetEntity="AccountOwner")
     * @ORM\JoinColumn(name="proponent_id", referencedColumnName="id", nullable=false)
     */
    private $proponent;

    /**
     * @var ArrayCollection $recipients
     *
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(
     *      name="card_recipients", 
     *      joinColumns={@ORM\JoinColumn(name="card_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="recipient_id", referencedColumnName="id")}
     * )
     */
    private $recipients;

    public function __construct()
    {
        $this->dateCreated = new \DateTime('now');
        $this->recipients = new ArrayCollection();
        $this->type = 1; // temporary
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
     * Set type
     *
     * @param smallint $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return smallint 
     */
    public function getType()
    {
        return $this->type;
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
     * Set deadline
     *
     * @param date $deadline
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }

    /**
     * Get deadline
     *
     * @return date 
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set proponent
     *
     * @param AccountOwner $proponent
     */
    public function setProponent(AccountOwner $proponent)
    {
        $this->proponent = $proponent;
    }

    /**
     * Get proponent
     *
     * @return AccountOwner
     */
    public function getProponent()
    {
        return $this->proponent;
    }

    /**
     * Get recipients
     *
     * @return ArrayCollection
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * Add recipient
     *
     * @param User $recipient
     */
    public function addRecipient(User $recipient)
    {
        $this->recipients[] = $recipient;
    }
}