<?php

namespace Hackzilla\Bundle\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Message
 *
 * @ORM\Table(name="ticket_message")
 * @ORM\Entity(repositoryClass="Hackzilla\Bundle\TicketBundle\Entity\TicketMessageRepository")
 * @Vich\Uploadable
 */
class TicketMessage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ticket", inversedBy="messages")
     * @ORM\JoinColumn(name="ticket_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $ticket;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="guid")
     */
    protected $user;
    protected $userObject;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     * @Assert\NotBlank()
     */
    protected $message;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    protected $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="smallint")
     */
    protected $priority;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * NOTE: This field is not persisted to database!
     *
     * @var File $file
     *
     * @Vich\UploadableField(mapping="ticket_attachment", fileNameProperty="filename")
     */
    protected $file;

    /**
     * @var string $filename
     *
     * @ORM\Column(name="filename", type="string", length=255, nullable=true)
     */
    protected $filename;

    const STATUS_INVALID = 0;
    const STATUS_OPEN = 10;
    const STATUS_IN_PROGRESS = 11;
    const STATUS_INFORMATION_REQUESTED = 12;
    const STATUS_ON_HOLD = 13;
    const STATUS_RESOLVED = 14;
    const STATUS_CLOSED = 15;

    static public $statuses = array(
        self::STATUS_INVALID => 'STATUS_INVALID',
        self::STATUS_OPEN => 'STATUS_OPEN',
        self::STATUS_IN_PROGRESS => 'STATUS_IN_PROGRESS',
        self::STATUS_INFORMATION_REQUESTED => 'STATUS_INFORMATION_REQUESTED',
        self::STATUS_ON_HOLD => 'STATUS_ON_HOLD',
        self::STATUS_RESOLVED => 'STATUS_RESOLVED',
        self::STATUS_CLOSED => 'STATUS_CLOSED',
    );

    const PRIORITY_INVALID = 0;
    const PRIORITY_LOW = 20;
    const PRIORITY_MEDIUM = 21;
    const PRIORITY_HIGH = 22;

    static public $priorities = array(
        self::PRIORITY_INVALID => 'PRIORITY_INVALID',
        self::PRIORITY_LOW => 'PRIORITY_LOW',
        self::PRIORITY_MEDIUM => 'PRIORITY_MEDIUM',
        self::PRIORITY_HIGH => 'PRIORITY_HIGH',
    );

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
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
     * Set status
     *
     * @param integer $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Set status string
     *
     * @param string $status
     *
     * @return $this
     */
    public function setStatusString($status)
    {
        $status = \array_search(\strtolower($status), self::$statuses);

        if ($status > 0) {
            $this->setStatus($status);
        }

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get status string
     *
     * @return string
     */
    public function getStatusString()
    {
        if (isset(self::$statuses[$this->status])) {
            return self::$statuses[$this->status];
        }

        return self::$statuses[0];
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Set priority string
     *
     * @param string $priority
     *
     * @return $this
     */
    public function setPriorityString($priority)
    {
        $priority = \array_search(\strtolower($priority), self::$priorities);

        if ($priority > 0) {
            $this->setPriority($priority);
        }

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Get priority string
     *
     * @return string
     */
    public function getPriorityString()
    {
        if (isset(self::$priorities[$this->priority])) {
            return self::$priorities[$this->priority];
        }

        return self::$priorities[0];
    }

    /**
     * Set user
     *
     * @param integer|object $user
     *
     * @return $this
     */
    public function setUser($user)
    {
        if (\is_object($user)) {
            $this->userObject = $user;
            $this->user = $user->getId();
        } else {
            $this->userObject = null;
            $this->user = $user;
        }

        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get user object
     *
     * @return object
     */
    public function getUserObject()
    {
        return $this->userObject;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set ticket
     *
     * @param \Hackzilla\Bundle\TicketBundle\Entity\Ticket $ticket
     *
     * @return $this
     */
    public function setTicket(Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        if (\is_null($this->getUserObject())) {
            $user = $this->getUser();
        } else {
            $user = $this->getUserObject();
        }

        // if null, then new ticket
        if (\is_null($ticket->getUserCreated())) {
            $ticket->setUserCreated($user);
        }

        $ticket->setLastUser($user);
        $ticket->setLastMessage($this->getCreatedAt());
        $ticket->setPriority($this->getPriority());

        // if ticket not closed, then it'll be set to null
        if (\is_null($this->getStatus())) {
            $this->setStatus($ticket->getStatus());
        } else {
            $ticket->setStatus($this->getStatus());
        }

        return $this;
    }

    /**
     * Get ticket
     *
     * @return Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File|UploadedFile $file
     */
    public function setFile(File $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return Ticket
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }
}
