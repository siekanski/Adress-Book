<?php

namespace AddressBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Address
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AddressBookBundle\Entity\AddressRepository")
 */
class Address
{
    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="addresses")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", onDelete="CASCADE") 
     */
    public $person;
    
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
     * @ORM\Column(name="city", type="string", length=100)
     * @Assert\NotBlank()
     * 
     */
    private $city;
    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=100, nullable=true)
     * 
     */
    private $street;
    /**
     * @var string
     *
     * @ORM\Column(name="street_number", type="string", length=10, nullable=true)
     */
    private $streetNumber;
    /**
     * @var string
     *
     * @ORM\Column(name="street_number2", type="string", length=10, nullable=true)
     */
    private $streetNumber2;
    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=6)
     * @Assert\Regex(
     *      pattern="/\d\d-\d\d\d/",
     *      message="Nieprawidłowy format"
     * )
     * @Assert\NotBlank()
     */
    private $postcode;
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
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }
    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }
    /**
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }
    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }
    /**
     * Set streetNumber
     *
     * @param integer $streetNumber
     * @return Address
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;
        return $this;
    }
    /**
     * Get streetNumber
     *
     * @return integer 
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }
    /**
     * Set streetNumber2
     *
     * @param integer $streetNumber2
     * @return Address
     */
    public function setStreetNumber2($streetNumber2)
    {
        $this->streetNumber2 = $streetNumber2;
        return $this;
    }
    /**
     * Get streetNumber2
     *
     * @return integer 
     */
    public function getStreetNumber2()
    {
        return $this->streetNumber2;
    }
    /**
     * Set postcode
     *
     * @param integer $postcode
     * @return Address
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }
    /**
     * Get postcode
     *
     * @return integer 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }
    /**
     * Set person
     *
     * @param \AddressBookBundle\Entity\Person $person
     * @return Address
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
