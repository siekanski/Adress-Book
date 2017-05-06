<?php


namespace AddressBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Phone
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AddressBookBundle\Entity\PhoneRepository")
 */
class Phone
{
    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="phoneNumbers")
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
     * @ORM\Column(name="number", type="string", length=50)
     * @Assert\NotBlank(message="Pole nie może być puste")
     */
    private $number;
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
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
     * Set number
     *
     * @param integer $number
     * @return Phone
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }
    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }
    /**
     * Set type
     *
     * @param string $type
     * @return Phone
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Set person
     *
     * @param \AddressBookBundle\Entity\Person $person
     * @return Phone
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
