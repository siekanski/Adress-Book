<?php

namespace AddressBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Person
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AddressBookBundle\Entity\PersonRepository")
 */
class Person
{
    /**
     *@ORM\OneToMany(targetEntity="Address", mappedBy="person")
     */
    public $addresses;
    /**
     * @ORM\OneToMany(targetEntity="Phone", mappedBy="person")
     */
    public $phoneNumbers;
    /**
     * @ORM\OneToMany(targetEntity="Email", mappedBy="person")
     * @Assert\NotBlank()
     */
    public $email;
    
    /**
     * @ORM\ManyToMany(targetEntity="Groups", inversedBy="users")
     * @ORM\JoinTable(name="users_groups")
     */
    private $groups;
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
     * @ORM\Column(name="name", type="string", length=50)
     * @Assert\NotBlank(message="Musisz podać Imię")
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=50)
     * @Assert\NotBlank(message="Musisz podać nazwisko")
     */
    private $surname;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank(message="Musisz podać opis")
     */
    private $description;
    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     * @Assert\File(
     *     maxSize = "1M",
     *     mimeTypes = {"image/jpeg", "image/png", "image/gif"},
     *     maxSizeMessage = "Max size is 1M",
     *     mimeTypesMessage = "Please upload a valid image"
     * )
     */
    private $photo;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="persons")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
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
     * Set name
     *
     * @param string $name
     * @return Person
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Set surname
     *
     * @param string $surname
     * @return Person
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }
    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }
    /**
     * Set description
     *
     * @param string $description
     * @return Person
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Set photo
     *
     * @param string $photo
     * @return Person
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }
    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->phoneNumbers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->email = new \Doctrine\Common\Collections\ArrayCollection();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add addresses
     *
     * @param \AddressBookBundle\Entity\Address $addresses
     * @return Person
     */
    public function addAddress(\AddressBookBundle\Entity\Address $addresses)
    {
        $this->addresses[] = $addresses;
        return $this;
    }
    /**
     * Remove addresses
     *
     * @param \AddressBookBundle\Entity\Address $addresses
     */
    public function removeAddress(\AddressBookBundle\Entity\Address $addresses)
    {
        $this->addresses->removeElement($addresses);
    }
    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
    /**
     * Set phoneNumbers
     *
     * @param \AddressBookBundle\Entity\Phone $phoneNumbers
     * @return Person
     */
    public function setPhoneNumbers(\AddressBookBundle\Entity\Phone $phoneNumbers = null)
    {
        $this->phoneNumbers = $phoneNumbers;
        return $this;
    }
    /**
     * Get phoneNumbers
     *
     * @return \AddressBookBundle\Entity\Phone 
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }
    /**
     * Add phoneNumbers
     *
     * @param \AddressBookBundle\Entity\Phone $phoneNumbers
     * @return Person
     */
    public function addPhoneNumber(\AddressBookBundle\Entity\Phone $phoneNumbers)
    {
        $this->phoneNumbers[] = $phoneNumbers;
        return $this;
    }
    /**
     * Remove phoneNumbers
     *
     * @param \AddressBookBundle\Entity\Phone $phoneNumbers
     */
    public function removePhoneNumber(\AddressBookBundle\Entity\Phone $phoneNumbers)
    {
        $this->phoneNumbers->removeElement($phoneNumbers);
    }
    /**
     * Add email
     *
     * @param \AddressBookBundle\Entity\Email $email
     * @return Person
     */
    public function addEmail(\AddressBookBundle\Entity\Email $email)
    {
        $this->email[] = $email;
        return $this;
    }
    /**
     * Remove email
     *
     * @param \AddressBookBundle\Entity\Email $email
     */
    public function removeEmail(\AddressBookBundle\Entity\Email $email)
    {
        $this->email->removeElement($email);
    }
    /**
     * Get email
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Add groups
     *
     * @param \AddressBookBundle\Entity\Groups $groups
     * @return Person
     */
    public function addGroup(\AddressBookBundle\Entity\Groups $groups)
    {
        $this->groups[] = $groups;
        return $this;
    }
    /**
     * Remove groups
     *
     * @param \AddressBookBundle\Entity\Groups $groups
     */
    public function removeGroup(\AddressBookBundle\Entity\Groups $groups)
    {
        $this->groups->removeElement($groups);
    }
    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }
    /**
     * Set user
     *
     * @param \AddressBookBundle\Entity\User $user
     * @return Person
     */
    public function setUser(\AddressBookBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }
    /**
     * Get user
     *
     * @return \AddressBookBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
