<?php
// src/AppBundle/Entity/User.php

namespace TestBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="TestBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;



    public function __construct()
    {
        parent::__construct();

    }

    /**
     * @return \TestBundle\Entity\Carnet
     */
    public function getCarnet()
    {
        return $this->carnet;
    }

    /**
     * @param \TestBundle\Entity\Carnet $carnet
     */
    public function setCarnet(\TestBundle\Entity\Carnet $carnet)
    {
        $this->carnet = $carnet;
    }

}