<?php

declare(strict_types=1);

use Doctrine\DBAL\Driver\Mysqli\Driver as MysqliConnection;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => MysqliConnection::class,
                'params' => [
                    'host' => DB_HOSTNAME,
                    'port' => '3306',
                    'user' => DB_USERNAME,
                    'password' => DB_PASSWORD,
                    'dbname' => DB_DATABASE,
                    'charset' => 'utf8',
                ],
            ],
        ],
    ],
];