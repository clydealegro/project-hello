<?php

namespace ProjectHello\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectHello\CoreBundle\Entity\Token
 *
 * @ORM\Table(name="tokens")
 * @ORM\Entity(repositoryClass="ProjectHello\CoreBundle\Entity\TokenRepository")
 */
class Token
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
     * @var string $tokenStr
     *
     * @ORM\Column(name="tokenStr", type="string", length=1000)
     */
    private $tokenStr;

    /**
     * @var datetime $dateCreated
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;


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
     * Set tokenStr
     *
     * @param string $tokenStr
     */
    public function setTokenStr($tokenStr)
    {
        $this->tokenStr = $tokenStr;
    }

    /**
     * Get tokenStr
     *
     * @return string 
     */
    public function getTokenStr()
    {
        return $this->tokenStr;
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
}