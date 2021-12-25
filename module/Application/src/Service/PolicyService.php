<?php

declare(strict_types=1);

namespace Application\Service;

use Application\Entity\Policy;
use Application\Repository\PolicyRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;

class PolicyService
{
    /** @var PolicyRepository */
    private $policyRepository;

    /** @var EntityManager */
    private $entityManager;

    /**
     * @param PolicyRepository $policyRepository
     * @param EntityManager $entityManager
     */
    public function __construct(PolicyRepository $policyRepository, EntityManager $entityManager)
    {
        $this->policyRepository = $policyRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @return Policy[]
     */
    public function findAll(): array
    {
        return $this->policyRepository->findAll();
    }

    /**
     * @return Query
     */
    public function getPaginationQuery(): Query
    {
        return $this->policyRepository->getPaginationQuery();
    }

    /**
     * @param int $id
     * @return Policy|null
     */
    public function findOneById(int $id): ?Policy
    {
        return $this->policyRepository->find($id);
    }

    /**
     * @param Policy $Policy
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function savePolicy(Policy $policy): void
    {
        $this->entityManager->persist($policy);
        $this->entityManager->flush();
    }

    /**
     * @param Policy $policy
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deletePolicy(Policy $policy): void
    {
        $this->entityManager->remove($policy);
        $this->entityManager->flush();
    }
}
