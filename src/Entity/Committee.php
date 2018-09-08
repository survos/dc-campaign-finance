<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Committee
 *
 * @ORM\Table(name="committees")
 * @ORM\Entity
 */
class Committee
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
     * @var string
     *
     * @ORM\Column(name="committee_name", type="string", length=255, nullable=false)
     */
    private $committeeName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="candidate_name", type="string", length=255, nullable=true)
     */
    private $candidateName;

    /**
     * @var int|null
     *
     * @ORM\Column(name="election_year", type="integer", nullable=true)
     */
    private $electionYear;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @var string|null
     *
     * @ORM\Column(name="office", type="string", length=255, nullable=true)
     */
    private $office;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contribution", mappedBy="committee")
     */
    private $contributions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Expenditure", mappedBy="committee", orphanRemoval=true)
     */
    private $expenditures;

    public function __construct()
    {
        $this->contributions = new ArrayCollection();
        $this->expenditures = new ArrayCollection();
    }

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

    public function getCandidateName(): ?string
    {
        return $this->candidateName;
    }

    public function setCandidateName(?string $candidateName): self
    {
        $this->candidateName = $candidateName;

        return $this;
    }

    public function getElectionYear(): ?int
    {
        return $this->electionYear;
    }

    public function setElectionYear(?int $electionYear): self
    {
        $this->electionYear = $electionYear;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getOffice(): ?string
    {
        return $this->office;
    }

    public function setOffice(?string $office): self
    {
        $this->office = $office;

        return $this;
    }

    /**
     * @return Collection|Contribution[]
     */
    public function getContributions(): Collection
    {
        return $this->contributions;
    }

    public function addContribution(Contribution $contribution): self
    {
        if (!$this->contributions->contains($contribution)) {
            $this->contributions[] = $contribution;
            $contribution->setCommittee($this);
        }

        return $this;
    }

    public function removeContribution(Contribution $contribution): self
    {
        if ($this->contributions->contains($contribution)) {
            $this->contributions->removeElement($contribution);
            // set the owning side to null (unless already changed)
            if ($contribution->getCommittee() === $this) {
                $contribution->setCommittee(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getCommitteeName();
    }

    /**
     * @return Collection|Expenditure[]
     */
    public function getExpenditures(): Collection
    {
        return $this->expenditures;
    }

    public function addExpenditure(Expenditure $expenditure): self
    {
        if (!$this->expenditures->contains($expenditure)) {
            $this->expenditures[] = $expenditure;
            $expenditure->setCommittee($this);
        }

        return $this;
    }

    public function removeExpenditure(Expenditure $expenditure): self
    {
        if ($this->expenditures->contains($expenditure)) {
            $this->expenditures->removeElement($expenditure);
            // set the owning side to null (unless already changed)
            if ($expenditure->getCommittee() === $this) {
                $expenditure->setCommittee(null);
            }
        }

        return $this;
    }


}
