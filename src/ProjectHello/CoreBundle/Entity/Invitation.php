<?php

namespace ProjectHello\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * ProjectHello\CoreBundle\Entity\Invitation
 *
 * @ORM\Table(name="invitations")
 * @ORM\Entity(repositoryClass="ProjectHello\CoreBundle\Entity\InvitationRepository")
 */
class Invitation
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
     * @var string $instruction
     *
     * @ORM\Column(name="instruction", type="string", length=5000)
     */
    private $instruction;

    /**
     * @var datetime $dateSent
     *
     * @ORM\Column(name="date_sent", type="datetime")
     */
    private $dateSent;

    /**
     * @var Card $card
     *
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(name="card_id", referencedColumnName="id", nullable=false)
     */
    private $card;

    /**
     * @var ArrayCollection $recipients
     *
     * @ORM\ManyToMany(targetEntity="MessageAuthor")
     * @ORM\JoinTable(
     *      name="invitees", 
     *      joinColumns={@ORM\JoinColumn(name="invitation_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="invitee_id", referencedColumnName="id")}
     * )
     */
    private $invitees;

    public function __construct()
    {
        $this->dateSent = new \DateTime('now');
        $this->invitees = new ArrayCollection();
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
     * Set instruction
     *
     * @param string $instruction
     */
    public function setInstruction($instruction)
    {
        $this->instruction = $instruction;
    }

    /**
     * Get instruction
     *
     * @return string 
     */
    public function getInstruction()
    {
        return $this->instruction;
    }

    /**
     * Set dateSent
     *
     * @param datetime $dateSent
     */
    public function setDateSent($dateSent)
    {
        $this->dateSent = $dateSent;
    }

    /**
     * Get dateSent
     *
     * @return datetime 
     */
    public function getDateSent()
    {
        return $this->dateSent;
    }

    /**
     * Set card
     *
     * @param Card $card
     */
    public function setCard(Card $card)
    {
        $this->card = $card;
    }

    /**
     * Get card
     *
     * @return Card
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * Get invitees
     *
     * @return ArrayCollection
     */
    public function getInvitees()
    {
        return $this->invitees;
    }

    /**
     * Add invitee
     *
     * @param MessageAuthor $invitee
     */
    public function addInvitee(MessageAuthor $invitee)
    {
        $this->invitees[] = $invitee;
    }
}