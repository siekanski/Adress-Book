<?php

namespace AddressBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groups
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AddressBookBundle\Entity\GroupsRepository")
 */
class Groups
{
    
    /**
     * @ORM\ManyToMany(targetEntity="Person", mappedBy="groups")
     */
    private $persons;
    
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
     * @ORM\Column(name="group_name", type="string", length=50)
     */
    private $groupName;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
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
     * Set groupName
     *
     * @param string $groupName
     * @return Groups
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
        return $this;
    }
    /**
     * Get groupName
     *
     * @return string 
     */
    public function getGroupName()
    {
        return $this->groupName;
    }
    /**
     * Set description
     *
     * @param string $description
     * @return Groups
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
     * Constructor
     */
    public function __construct()
    {
        $this->persons = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add persons
     *
     * @param \AddressBookBundle\Entity\Person $persons
     * @return Groups
     */
    public function addPerson(\AddressBookBundle\Entity\Person $persons)
    {
        $persons->addGroup($this);
        return $this;
    }
    /**
     * Remove persons
     *
     * @param \AddressBookBundle\Entity\Person $persons
     */
    public function removePerson(\AddressBookBundle\Entity\Person $persons)
    {
        $this->persons->removeElement($persons);
    }
    /**
     * Get persons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersons()
    {
        return $this->persons;
    }
}
