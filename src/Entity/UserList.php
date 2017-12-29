<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="user_list")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class UserList
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $company_name;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $manager_first_name;

   /**
    * @ORM\Column(type="string", length=60)
    */
    private $manager_last_name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->company_name;
    }

    /**
     * @return mixed
     */
    public function getManagerFirstName()
    {
        return $this->manager_first_name;
    }

    /**
     * @return mixed
     */
    public function getManagerLastName()
    {
        return $this->manager_last_name;
    }
}
