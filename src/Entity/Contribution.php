<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contribution
 *
 * @ORM\Table(name="contributions")
 * @ORM\Entity
 */
class Contribution
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
     * @ORM\Column(name="committee_name", type="string", length=255, nullable=true)
     */
    private $committeeName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contributor_name", type="string", length=255, nullable=true)
     */
    private $contributorName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contributor_address", type="string", length=255, nullable=true)
     */
    private $contributorAddress;

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
     * @var string|null
     *
     * @ORM\Column(name="normalized", type="string", length=255, nullable=true)
     */
    private $normalized;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contributor_state", type="string", length=255, nullable=true)
     */
    private $contributorState;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contributor_type", type="string", length=255, nullable=true)
     */
    private $contributorType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contribution_type", type="string", length=255, nullable=true)
     */
    private $contributionType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="employer_name", type="string", length=255, nullable=true)
     */
    private $employerName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="employer_address", type="string", length=255, nullable=true)
     */
    private $employerAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="occupation", type="string", length=255, nullable=true)
     */
    private $occupation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="receipt_date", type="date", nullable=true)
     */
    private $receiptDate;

    /**
     * @var float|null
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=0, nullable=true)
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity="Committee", inversedBy="contributions")
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

    public function getContributorName(): ?string
    {
        return $this->contributorName;
    }

    public function setContributorName(?string $contributorName): self
    {
        $this->contributorName = $contributorName;

        return $this;
    }

    public function getContributorAddress(): ?string
    {
        return $this->contributorAddress;
    }

    public function setContributorAddress(?string $contributorAddress): self
    {
        $this->contributorAddress = $contributorAddress;

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

    public function getNormalized(): ?string
    {
        return $this->normalized;
    }

    public function setNormalized(?string $normalized): self
    {
        $this->normalized = $normalized;

        return $this;
    }

    public function getContributorState(): ?string
    {
        return $this->contributorState;
    }

    public function setContributorState(?string $contributorState): self
    {
        $this->contributorState = $contributorState;

        return $this;
    }

    public function getContributorType(): ?string
    {
        return $this->contributorType;
    }

    public function setContributorType(?string $contributorType): self
    {
        $this->contributorType = $contributorType;

        return $this;
    }

    public function getContributionType(): ?string
    {
        return $this->contributionType;
    }

    public function setContributionType(?string $contributionType): self
    {
        $this->contributionType = $contributionType;

        return $this;
    }

    public function getEmployerName(): ?string
    {
        return $this->employerName;
    }

    public function setEmployerName(?string $employerName): self
    {
        $this->employerName = $employerName;

        return $this;
    }

    public function getEmployerAddress(): ?string
    {
        return $this->employerAddress;
    }

    public function setEmployerAddress(?string $employerAddress): self
    {
        $this->employerAddress = $employerAddress;

        return $this;
    }

    public function getOccupation(): ?string
    {
        return $this->occupation;
    }

    public function setOccupation(?string $occupation): self
    {
        $this->occupation = $occupation;

        return $this;
    }

    public function getReceiptDate(): ?\DateTimeInterface
    {
        return $this->receiptDate;
    }

    public function setReceiptDate(?\DateTimeInterface $receiptDate): self
    {
        $this->receiptDate = $receiptDate;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCommittee(): Committee
    {
        return $this->committee;
    }

    public function setCommittee(Committee $committee): self
    {
        $this->committee = $committee;

        return $this;
    }


}
