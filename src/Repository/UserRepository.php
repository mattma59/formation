<?php
/**
 * Created by PhpStorm.
 * User: Admin Stagiaire
 * Date: 29/05/2018
 * Time: 16:56
 */

namespace App\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;


class UserRepository extends DocumentRepository
{
    public function findAllOrderedByName()
    {
        return $this->createQueryBuilder()
            ->sort('lastname', 'ASC')
            ->getQuery()
            ->execute();
    }
}