<?php

namespace ProjectHello\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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

    public function __construct()
    {
        $this->dateSent = new \DateTime('now');
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
}