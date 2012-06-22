<?php

namespace ProjectHello\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectHello\CoreBundle\Entity\Message
 *
 * @ORM\Table(name="messages")
 * @ORM\Entity(repositoryClass="ProjectHello\CoreBundle\Entity\MessageRepository")
 */
class Message
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
     * @var text $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var datetime $dateCreated
     *
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $dateCreated;

    /**
     * @var Card $card
     *
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(name="card_id", referencedColumnName="id", nullable=false)
     */
    private $card;

    /**
     * @var MessageAuthor $author
     *
     * @ORM\ManyToOne(targetEntity="MessageAuthor")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     */
    private $author;

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
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
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
     * Set author
     *
     * param MessageAuthor $author
     */
    public function setAuthor(MessageAuthor $author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return MessageAuthor
     */
    public function getAuthor()
    {
        return $this->author;
    }
}