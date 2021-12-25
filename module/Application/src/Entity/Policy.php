<?php

declare(strict_types=1);

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="policy")
 * @ORM\Entity(repositoryClass="Application\Repository\PolicyRepository")
 */
class Policy
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var integer $id
     */
    private $id;

    /**
     * @ORM\Column(name="first_name", type="string", nullable=true)
     * @var string $first_name
     */
    private $first_name;

    /**
     * @ORM\Column(name="last_name", type="string", nullable=false)
     * @var string $last_name
     */
    private $last_name;

    /**
     * @ORM\Column(name="policy_number", type="string", nullable=false)
     * @var string $policy_number
     */
    private $policy_number;

    /**
     * @ORM\Column(name="start_date", type="string", nullable=false)
     * @var string $start_date
     */
    private $start_date;

    /**
     * @ORM\Column(name="end_date", type="string", nullable=false)
     * @var string $end_date
     */
    private $end_date;

    /**
     * @ORM\Column(name="premium", type="float", nullable=true)
     * @var float $premium
     */
    private $premium;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getPolicyNumber(): string
    {
        return $this->policy_number;
    }

    /**
     * @param string $policy_number
     */
    public function setPolicyNumber(string $policy_number): void
    {
        $this->policy_number = $policy_number;
    }

    /**
     * @return date
     */
    public function getStartDate(): string
    {
        return $this->start_date;
    }

    /**
     * @param string $start_date
     */
    public function setStartDate(string $start_date): void
    {
        $this->start_date = $start_date;
    }

    /**
     * @return date
     */
    public function getEndDate(): string
    {
        return $this->end_date;
    }

    /**
     * @param string $end_date
     */
    public function setEndDate(string $end_date): void
    {
        $this->end_date = $end_date;
    }

    /**
     * @return float
     */
    public function getPremium(): float
    {
        return $this->premium;
    }

    /**
     * @param string $premium
     */
    public function setPremium(string $premium): void
    {
        $this->premium = $premium;
    }
}