<?php

namespace App\Repository;

use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Company::class);
    }

    /**
     * Save a company.
     *
     * @param Company $company
     * @return Company
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Company $company)
    {
        $em = $this->getEntityManager();

        if (is_null($company->getID())) {
            $em->persist($company);
        }

        $em->flush();

        return $company;
    }

    /**
     * Delete a company.
     *
     * @param Company $company
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Company $company)
    {
        $em = $this->getEntityManager();
        $em->remove($company);
        $em->flush();
    }
}
