<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Form;
use Laminas\Form\Element;
use Laminas\InputFilter\InputFilter;

class PolicyForm extends Form
{
    public function __construct()
    {
        // Define form name
        parent::__construct('policy-form');

        $this->setAttribute('method', 'post');

        $this->addElements();
        $this->addInputFilter();
    }

    /**
     * @return void
     */
    protected function addElements(): void
    {
        $this->add([
            'type'  => 'hidden',
            'name' => 'id',
            'attributes' => [
                'id' => 'id'
            ],
            'options' => [
                'label' => 'id',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'first_name',
            'attributes' => [
                'id' => 'first_name'
            ],
            'options' => [
                'label' => 'First Name',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'last_name',
            'attributes' => [
                'id' => 'last_name'
            ],
            'options' => [
                'label' => 'Last Name',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'policy_number',
            'attributes' => [
                'id' => 'policy_number'
            ],
            'options' => [
                'label' => 'Policy Number',
            ],
        ]);

        $this->add([
            'type' => 'Laminas\Form\Element\Date',
            'name' => 'start_date',
            'attributes' => [
                'id' => 'start_date',
            ],
            'options' => [
                'label' => 'Start Date',
            ],
        ]);

        $this->add([
            'type' => 'Laminas\Form\Element\Date',
            'name' => 'end_date',
            'attributes' => [
                'id' => 'end_date',
            ],
            'options' => [
                'label' => 'End Date',
            ],
        ]);

        $this->add([
            'type'  => 'Laminas\Form\Element\Number',
            'name' => 'premium',
            'attributes' => [
                'id' => 'premium'
            ],
            'options' => [
                'label' => 'Premium',
            ],
        ]);

        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Save',
                'id' => 'submitbutton',
            ],
        ]);
    }

    /**
     * @return void
     */
    private function addInputFilter(): void
    {
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'     => 'id',
            'required' => true,
            'filters'  => [
                ['name' => 'ToInt'],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'last_name',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 50
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'policy_number',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 50
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'start_date',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'Callback',
                    'options' => array(
                        'messages' => array(
                            \Laminas\Validator\Callback::INVALID_VALUE => 'The start date should be lesser than end date',
                        ),
                        'callback' => function($value, $context = array()) {
                            return $value < $context['end_date'];
                        },
                    ),
                ),
            ),            
        ]);
        $inputFilter->add([
            'name'     => 'end_date',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'Callback',
                    'options' => array(
                        'messages' => array(
                            \Laminas\Validator\Callback::INVALID_VALUE => 'The end date should be greater than start date',
                        ),
                        'callback' => function($value, $context = array()) {
                            return $value >= $context['start_date'];
                        },
                    ),
                ),
            ),
        ]);
    }
}
