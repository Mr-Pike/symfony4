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

    /**
    * Get tree of users by company.
    *
    * @param $company_id
    */
    public function getTree($company_id)
    {
        // Prepare sql query.
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT id, manager_id, CONCAT(UPPER(first_name), " ", last_name) AS name
            FROM user u
            WHERE u.company_id = :company_id
            ORDER BY manager_id
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(compact('company_id'));

        // Get users of company.
        $users = $stmt->fetchAll();
        $totalUsers = count($users);

        // Get users first level.
        $usersTree = [];
        foreach ($users as $key => $user) {
            if (is_null($user['manager_id'])) {
                $usersTree[$user['id']] =
                [
                  'id' => $user['id'],
                  'manager_id' => $user['manager_id'],
                  'manager_list_id' => $user['id'],
                  'tree' => '',
                  'name' => $user['name']
                ];
                unset($users[$key]);
            }
        }

        // Check if there are users of first level.
        if (count($usersTree) == 0) {
            return [];
        }

        // Get users level > 0.
        $totalIterations = 0;
        while (count($users) > 0 && $totalIterations < $totalUsers * 2) {
            $user = array_shift($users);

            if (isset($usersTree[$user['manager_id']])) {
                $usersTree[$user['id']] =
                [
                  'id' => $user['id'],
                  'manager_id' => $user['manager_id'],
                  'manager_list_id' => $usersTree[$user['manager_id']]['manager_list_id'].'-'.$user['id'],
                  'tree' => $usersTree[$user['manager_id']]['tree'].'|--',
                  'name' => $user['name']
                ];
                continue;
            }

            $totalIterations++;
            $users[] = $user;
        }

        // Sort users by value.
        usort($usersTree, function($a, $b) {
            return $a['manager_list_id'] <=> $b['manager_list_id'];
        });

        return $usersTree;
    }
}
