<?php

declare(strict_types=1);

namespace Application\Hydrator;

use Laminas\Hydrator\ClassMethodsHydrator;

class PolicyHydrator extends ClassMethodsHydrator
{
    /**
     * @param array $data
     * @param object $object
     * @return object|void
     */
    public function hydrate(array $data, object $object)
    {
        return parent::hydrate($data, $object);
    }

    /**
     * @param object $object
     * @return array
     */
    public function extract(object $object) : array
    {
        return [
            'id' => $object->getId(),
            'first_name' => $object->getFirstName(),
            'last_name' => $object->getLastName(),
            'policy_number' => $object->getPolicyNumber(),
            'start_date' => $object->getStartDate(),
            'end_date' => $object->getEndDate(),
            'premium' => $object->getPremium(),
        ];
    }
}