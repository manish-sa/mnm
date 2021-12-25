<?php

namespace Application;
use Application\Hydrator\PolicyHydrator;
use Application\Service\PolicyService;
use Application\Service\PolicyServiceFactory;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'policy' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/policy[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\PolicyController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'doctrine' => [
        'driver' => [
            'application-driver' => [
                'class' => AnnotationDriver::class,
                'paths' => [
                    __DIR__ . '/../src/Entity'
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Application\Entity' => 'application-driver',
                ],
            ],
        ],
    ],
    'service_manager' => [
        'invokables' => [
            PolicyHydrator::class => PolicyHydrator::class
        ],
        'factories' => [
            PolicyService::class => PolicyServiceFactory::class
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\PolicyController::class => Controller\PolicyControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
