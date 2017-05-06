<?php

namespace AddressBookBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */

class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Person", mappedBy="user")
     */
    private $persons;
    public function __construct()
    {
        parent::__construct();
        $this->persons = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add persons
     *
     * @param \AddressBookBundle\Entity\Person $persons
     * @return User
     */
    public function addPerson(\AddressBookBundle\Entity\Person $persons)
    {
        $this->persons[] = $persons;
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

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
