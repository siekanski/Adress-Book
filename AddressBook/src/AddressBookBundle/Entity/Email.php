<?php

namespace AddressBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Email
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AddressBookBundle\Entity\EmailRepository")
 */
class Email
{
    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="email")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $person;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     * 
     * @ORM\Column(name="email_address", type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @Assert\NotBlank()
     */
    private $emailAddress;
    /**
     * @var string
     *
     * @ORM\Column(name="email_type", type="string", length=20)
     */
    private $emailType;
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
     * @return Email
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
        return $this;
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
     * Set emailType
     *
     * @param string $emailType
     * @return Email
     */
    public function setEmailType($emailType)
    {
        $this->emailType = $emailType;
        return $this;
    }
    /**
     * Get emailType
     *
     * @return string 
     */
    public function getEmailType()
    {
        return $this->emailType;
    }
    /**
     * Set person
     *
     * @param \AddressBookBundle\Entity\Person $person
     * @return Email
     */
    public function setPerson(\AddressBookBundle\Entity\Person $person = null)
    {
        $this->person = $person;
        return $this;
    }
    /**
     * Get person
     *
     * @return \AddressBookBundle\Entity\Person 
     */
    public function getPerson()
    {
        return $this->person;
    }
}
