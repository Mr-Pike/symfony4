<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="company_list")
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 */
class CompanyList
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $address1;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $address2;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $zip_code;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=100, unique=true, nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="decimal", length=50, precision=10, scale=2, nullable=true)
     */
    private $turnover;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_users;

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
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
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
    public function getTurnover()
    {
        return $this->turnover;
    }

    /**
     * @return mixed
     */
    public function getNbUsers()
    {
        return $this->nb_users;
    }
}
