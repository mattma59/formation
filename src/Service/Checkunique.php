<?php
/**
 * Created by PhpStorm.
 * User: Admin Stagiaire
 * Date: 31/05/2018
 * Time: 15:12
 */

namespace App\Service;


use App\Document\User;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;

class Checkunique
{

    /**
     * @var ManagerRegistry
     */
    private $_db;


    /**
     * Checkunique constructor.
     * @param ManagerRegistry $db
     */
    public function __construct(ManagerRegistry $db)
    {
        $this->_db = $db;
    }

    public function getMessageErreur()
    {
        return 'La valeur n\'est pas unique';
    }

    public function isUniqueValue($repository, string $fieldName, $value)
    {
        //return empty($repository->findOneBy(array($fieldName => $value)));
        return empty($this->_db->getRepository($repository)->findOneBy(array($fieldName => $value)));
    }
}