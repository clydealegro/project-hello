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
     * @var smallint $type
     *
     * @ORM\Column(name="type", type="smallint")
     */
    private $type;

    /**
     * @var datetime $dateCreated
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var date $deadline
     *
     * @ORM\Column(name="deadline", type="date")
     */
    private $deadline;

    /**
     * @var string $invitationMessage
     *
     * @ORM\Column(name="invitation_message", type="string", length=3000)
     */
    private $invitationMessage;

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
     * Set invitationMessage
     *
     * @param string $message
     */
    public function setInvitationMessage($message)
    {
        $this->invitationMessage = $message;
    }

    /**
     * Get invitationMessage
     *
     * @return string 
     */
    public function getInvitationMessage()
    {
        return $this->invitationMessage;
    }
}