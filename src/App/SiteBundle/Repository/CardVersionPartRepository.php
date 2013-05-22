<?php


namespace App\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CardVersionPartRepository extends EntityRepository
{
    public function findBySearchTerm($searchTerm)
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT cvp FROM AppSiteBundle:CardVersionPart AS cvp
            WHERE cvp.name LIKE :name
        ');

        $query->setMaxResults(10);

        return $query->execute(array(':name' => '%'.$searchTerm.'%'));
    }

}