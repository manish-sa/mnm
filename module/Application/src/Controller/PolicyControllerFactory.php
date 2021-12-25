<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Hydrator\PolicyHydrator;
use Application\Service\PolicyService;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PolicyControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return PolicyController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): PolicyController
    {
        return new PolicyController(
                $container->get(PolicyService::class),
                $container->get(PolicyHydrator::class)
            );
    }
}
