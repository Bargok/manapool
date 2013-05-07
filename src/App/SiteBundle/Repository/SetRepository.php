<?php


namespace App\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SetRepository extends EntityRepository
{
    public function findOneNotSynchronized()
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT s FROM AppSiteBundle:Set AS s
            WHERE s.synchronized IS NULL
        ');

        $query->setMaxResults(1);

        return $query->getOneOrNullResult();
    }
}