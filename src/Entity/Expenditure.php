<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expenditure
 *
 * @ORM\Table(name="expenditures")
 * @ORM\Entity
 */
class Expenditure
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ ORM\Column(name="committee_name", type="string", length=255, nullable=true)
     */
    private $committeeName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="payee_name", type="string", length=255, nullable=true)
     */
    private $payeeName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="payee_address", type="string", length=255, nullable=true)
     */
    private $payeeAddress;

    /**
     * @var int|null
     *
     * @ORM\Column(name="amount", type="integer", nullable=false)
     */
    private $amount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="normalized", type="string", length=255, nullable=true)
     */
    private $normalized;

    /**
     * @var string|null
     *
     * @ORM\Column(name="purpose_of_expenditure", type="string", length=255, nullable=true)
     */
    private $purposeOfExpenditure;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="payment_date", type="date", nullable=true)
     */
    private $paymentDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="number_and_street", type="string", length=255, nullable=true)
     */
    private $numberAndStreet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @var string|null
     *
     * @ORM\Column(name="zip", type="string", length=255, nullable=true)
     */
    private $zip;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Committee", inversedBy="expenditures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $committee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommitteeName(): ?string
    {
        return $this->committeeName;
    }

    public function setCommitteeName(?string $committeeName): self
    {
        $this->committeeName = $committeeName;

        return $this;
    }

    public function getPayeeName(): ?string
    {
        return $this->payeeName;
    }

    public function setPayeeName(?string $payeeName): self
    {
        $this->payeeName = $payeeName;

        return $this;
    }

    public function getPayeeAddress(): ?string
    {
        return $this->payeeAddress;
    }

    public function setPayeeAddress(?string $payeeAddress): self
    {
        $this->payeeAddress = $payeeAddress;

        return $this;
    }

    public function getNormalized(): ?string
    {
        return $this->normalized;
    }

    public function setNormalized(?string $normalized): self
    {
        $this->normalized = $normalized;

        return $this;
    }

    public function getPurposeOfExpenditure(): ?string
    {
        return $this->purposeOfExpenditure;
    }

    public function setPurposeOfExpenditure(?string $purposeOfExpenditure): self
    {
        $this->purposeOfExpenditure = $purposeOfExpenditure;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(?\DateTimeInterface $paymentDate): self
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function getNumberAndStreet(): ?string
    {
        return $this->numberAndStreet;
    }

    public function setNumberAndStreet(?string $numberAndStreet): self
    {
        $this->numberAndStreet = $numberAndStreet;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCommittee(): ?Committee
    {
        return $this->committee;
    }

    public function setCommittee(?Committee $committee): self
    {
        $this->committee = $committee;

        return $this;
    }



}
