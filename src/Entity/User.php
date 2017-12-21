<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
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
     * @ORM\Column(type="string", length=120, unique=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $isManager;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="users", cascade={"persist"})
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=true)
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="manager_id", referencedColumnName="id", nullable=true)
     */
    private $manager;


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
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return Company
     */
    public function getCompany()//: Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getIsManager()
    {
        return $this->isManager;
    }

    /**
     * @param bool $isManager
     */
    public function setIsManager($isManager)
    {
        $this->isManager = $isManager;
    }

    /**
     * @return User
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @param User $manager
     */
    public function setManager(User $manager)
    {
        $this->manager = $manager;
    }
}
