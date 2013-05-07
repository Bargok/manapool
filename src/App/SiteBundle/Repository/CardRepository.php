<?php


namespace App\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CardRepository extends EntityRepository
{
    public function findOneByName($name)
    {
        $query =  $this->getEntityManager()->createQuery("
            SELECT c, cv FROM AppSiteBundle:Card AS c
            LEFT JOIN c.versions AS cv
            LEFT JOIN cv.set AS s
            WHERE c.name = :name
        ");

        $query->setParameter('name', $name, \PDO::PARAM_STR);

        return $query->getOneOrNullResult();
    }

}