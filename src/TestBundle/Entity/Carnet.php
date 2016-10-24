<?php

namespace TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="carnet")
 * @ORM\Entity(repositoryClass="TestBundle\Repository\CarnetRepository")
 */

class Carnet
{

    /**
     * @var \TestBundle\Entity\User
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $User;

    /**
     * @var \TestBundle\Entity\Contact
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Contact")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contacts", referencedColumnName="id")
     * })
     */
    private $contacts;


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
     * Set idUser
     *
     * @param \TestBundle\Entity\User $User
     * @return Carnet
     */
    public function setUser(\TestBundle\Entity\User $User)
    {
        $this->User = $User;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \TestBundle\Entity\User
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * Set contacts
     *
     * @param array $contacts
     * @return Carnet
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;

        return $this;
    }

    /**
     * Get contacts
     *
     * @return array 
     */
    public function getContacts()
    {
        return $this->contacts;
    }
}
