<?php

declare(strict_types=1);

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class PolicyRepository extends EntityRepository
{
    /**
     * @return Query
     */
    public function getPaginationQuery(): Query
    {
        $queryBuilder = $this->createQueryBuilder('r');
        $queryBuilder->select()->orderBy('r.id', 'DESC');
        return $queryBuilder->getQuery();
    }
}
