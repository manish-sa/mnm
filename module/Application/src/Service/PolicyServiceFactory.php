<?php

declare(strict_types=1);

namespace Application\Service;

use Application\Entity\Policy;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PolicyServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return PolicyService
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): PolicyService
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        /** @var ObjectRepository $policyRepository */
        $policyRepository = $entityManager->getRepository(Policy::class);

        return new PolicyService($policyRepository, $entityManager);
    }
}
