<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min=5)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=120)
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $address1;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $address2;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\Length(min=5)
     */
    private $zip_code;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(min=5)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=100, unique=true, nullable=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="decimal", length=50, precision=10, scale=2, nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 999999999999.99,
     *      minMessage = "The turnover is a number between 0 and 999999999999.99",
     *      maxMessage = "The turnover is a number between 0 and 999999999999.99r"
     * )
     */
    private $turnover;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="company")
     */
    private $users;


    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param mixed $address1
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param mixed $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * @param mixed $zip_code
     */
    public function setZipCode($zip_code)
    {
        $this->zip_code = $zip_code;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
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
     * @return mixed
     */
    public function getTurnover()
    {
        return $this->turnover;
    }

    /**
     * @param mixed $turnover
     */
    public function setTurnover($turnover)
    {
        $this->turnover = $turnover;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers()
    {
        return $this->users;
    }
}
