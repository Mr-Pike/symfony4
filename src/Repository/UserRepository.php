<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Save an user.
     *
     * @param User $user
     * @return User
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(User $user)
    {
        $em = $this->getEntityManager();

        if (is_null($user->getID())) {
            $em->persist($user);
        }

        $em->flush();

        return $user;
    }

    /**
     * Delete an user.
     *
     * @param User $user
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(User $user)
    {
        $em = $this->getEntityManager();
        $em->remove($user);
        $em->flush();
    }
}
