<?php

namespace App\Repository;

use App\Entity\Company;
use App\Entity\CompanyList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Company::class);
    }

    /**
     * Get list of companies.
     */
    public function list($firstResult, $maxResult = 20)
    {
        if (!is_numeric($firstResult) || $firstResult < 0) {
            throw new InvalidArgumentException('The current page does not exists.');
        }

        $query = $this->getEntityManager()
              ->createQuery('
                SELECT C
                FROM App\Entity\CompanyList C
                ORDER BY C.name DESC
              ')
              ->setFirstResult($firstResult)
              ->setMaxResults($maxResult);

        $paginator = new Paginator($query);

        if ($firstResult != 1 && $paginator->count() == 0) {
            throw new NotFoundHttpException('The current page does not exists.');
        }

        return new Paginator($query);
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
