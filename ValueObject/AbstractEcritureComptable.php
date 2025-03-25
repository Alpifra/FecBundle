<?php

namespace A5sys\FecBundle\ValueObject;

/**
 * Représente une écriture comptable française
 * Note le champ montantdevis et idevise portent bien le nom indiqué par l'administration française, malgré que leur format n'est pas le même que les autres champs.
 */
abstract class AbstractEcritureComptable implements EcritureComptableInterface
{
    /**
     * Le code journal de l'écriture comptable
     * @var string
     */
    protected $journalCode;

    /**
     * Le libellé journal de l'écriture comptable
     * @var string
     */
    protected $journalLib;

    /**
     * Le numéro sur une séquence continue de l'écriture comptable
     * @var string
     */
    protected $ecritureNum;

    /**
     * La date de comptabilisation de l'écriture comptable
     * @var \DateTime
     */
    protected $ecritureDate;

    /**
     * Le numéro de compte, dont les trois premiers caractères doivent correspondre à des chiffres respectant les normes du plan comptable français
     * @var string
     */
    protected $compteNum;

    /**
     * Le libellé de compte, conformément à la nomenclature du plan comptable français
     * @var string
     */
    protected $compteLib;

    /**
     * Le numéro de compte auxiliaire (à blanc si non utilisé)
     * @var string
     */
    protected $compAuxNum;

    /**
     * Le libellé de compte auxiliaire (à blanc si non utilisé)
     * @var string
     */
    protected $compAuxLib;

    /**
     * La référence de la pièce justificative
     * @var string
     */
    protected $pieceRef;

    /**
     * La date de la pièce justificative
     * @var \DateTime
     */
    protected $pieceDate;

    /**
     * Le libellé de l'écriture comptable
     * @var string
     */
    protected $ecritureLib;

    /**
     * Le montant au débit
     * @var float
     */
    protected $debit;

    /**
     * Le montant au crédit
     * @var float
     */
    protected $credit;

    /**
     * Le lettrage de l'écriture comptable (à blanc si non utilisé)
     * @var string
     */
    protected $ecritureLet;

    /**
     * La date de lettrage (à blanc si non utilisé)
     * @var \DateTime
     */
    protected $dateLet;

    /**
     * La date de validation de l'écriture comptable
     * @var \DateTime
     */
    protected $validDate;

    /**
     * Le montant en devise (à blanc si non utilisé)
     * @var float
     */
    protected $montantdevise;

    /**
     * L'identifiant de la devise (à blanc si non utilisé)
     * @var string
     */
    protected $idevise;

    /**
     * Retourne le code journal de l'écriture comptable
     */
    public function getJournalCode(): string
    {
        return $this->journalCode;
    }

    /**
     * Retourne le libellé journal de l'écriture comptable
     */
    public function getJournalLib(): string
    {
        return $this->journalLib;
    }

    /**
     * Retourne le numéro sur une séquence continue de l'écriture comptable
     */
    public function getEcritureNum(): string
    {
        return $this->ecritureNum;
    }

    /**
     * Retourne la date de comptabilisation de l'écriture comptable
     */
    public function getEcritureDate(): \DateTime
    {
        return $this->ecritureDate;
    }

    /**
     * Retourne le numéro de compte, dont les trois premiers caractères doivent correspondre à des chiffres respectant les normes du plan comptable français
     */
    public function getCompteNum(): string
    {
        return $this->compteNum;
    }

    /**
     * Retourne le libellé de compte, conformément à la nomenclature du plan comptable français
     */
    public function getCompteLib(): string
    {
        return $this->compteLib;
    }

    /**
     * Retourne le numéro de compte auxiliaire (à blanc si non utilisé)
     */
    public function getCompAuxNum(): string
    {
        return $this->compAuxNum;
    }

    /**
     * Retourne le libellé de compte auxiliaire (à blanc si non utilisé)
     */
    public function getCompAuxLib(): string
    {
        return $this->compAuxLib;
    }

    /**
     * Retourne la référence de la pièce justificative
     */
    public function getPieceRef(): string
    {
        return $this->pieceRef;
    }

    /**
     * Retourne la date de la pièce justificative
     */
    public function getPieceDate(): \DateTime
    {
        return $this->pieceDate;
    }

    /**
     * Retourne le libellé de l'écriture comptable
     */
    public function getEcritureLib(): string
    {
        return $this->ecritureLib;
    }

    /**
     * Retourne le montant au débit
     */
    public function getDebit(): float
    {
        return $this->debit;
    }

    /**
     * Retourne le montant au crédit
     */
    public function getCredit(): float
    {
        return $this->credit;
    }

    /**
     * Retourne le lettrage de l'écriture comptable (à blanc si non utilisé)
     */
    public function getEcritureLet(): string
    {
        return $this->ecritureLet;
    }

    /**
     * Retourne la date de lettrage (à blanc si non utilisé)
     */
    public function getDateLet(): \DateTime
    {
        return $this->dateLet;
    }

    /**
     * Retourne la date de validation de l'écriture comptable
     */
    public function getValidDate(): \DateTime
    {
        return $this->validDate;
    }

    /**
     * Retourne le montant en devise (à blanc si non utilisé)
     */
    public function getMontantdevise(): float
    {
        return $this->montantdevise;
    }

    /**
     * Retourne l'identifiant de la devise (à blanc si non utilisé)
     */
    public function getIdevise(): string
    {
        return $this->idevise;
    }

    /**
     * Affecte le code journal de l'écriture comptable
     * @param string $journalCode
     */
    public function setJournalCode($journalCode): self
    {
        $this->journalCode = $journalCode;

        return $this;
    }

    /**
     * Affecte le libellé journal de l'écriture comptable
     * @param string $journalLib
     */
    public function setJournalLib($journalLib): self
    {
        $this->journalLib = $journalLib;

        return $this;
    }

    /**
     * Affecte le numéro sur une séquence continue de l'écriture comptable
     * @param string $ecritureNum
     */
    public function setEcritureNum($ecritureNum): self
    {
        $this->ecritureNum = $ecritureNum;

        return $this;
    }

    /**
     * Affecte la date de comptabilisation de l'écriture comptable
     * @param \DateTime $ecritureDate
     */
    public function setEcritureDate(\DateTime $ecritureDate): self
    {
        $this->ecritureDate = $ecritureDate;

        return $this;
    }

    /**
     * Affecte le numéro de compte, dont les trois premiers caractères doivent correspondre à des chiffres respectant les normes du plan comptable français
     * @param string $compteNum
     */
    public function setCompteNum($compteNum): self
    {
        $this->compteNum = $compteNum;

        return $this;
    }

    /**
     * Affecte le libellé de compte, conformément à la nomenclature du plan comptable français
     * @param string $compteLib
     */
    public function setCompteLib($compteLib): self
    {
        $this->compteLib = $compteLib;

        return $this;
    }

    /**
     * Optionnel - Affecte le numéro de compte auxiliaire (à blanc si non utilisé)
     * @param string $compAuxNum
     */
    public function setCompAuxNum($compAuxNum = null): self
    {
        $this->compAuxNum = $compAuxNum;

        return $this;
    }

    /**
     * Optionnel - Affecte le libellé de compte auxiliaire (à blanc si non utilisé)
     * @param string $compAuxLib
     */
    public function setCompAuxLib($compAuxLib = null): self
    {
        $this->compAuxLib = $compAuxLib;

        return $this;
    }

    /**
     * Affecte la référence de la pièce justificative
     * @param string $pieceRef
     */
    public function setPieceRef($pieceRef): self
    {
        $this->pieceRef = $pieceRef;

        return $this;
    }

    /**
     * Affecte la date de la pièce justificative
     * @param \DateTime $pieceDate
     */
    public function setPieceDate(\DateTime $pieceDate): self
    {
        $this->pieceDate = $pieceDate;

        return $this;
    }

    /**
     * Affecte le libellé de l'écriture comptable
     * @param string $ecritureLib
     */
    public function setEcritureLib($ecritureLib): self
    {
        $this->ecritureLib = $ecritureLib;

        return $this;
    }

    /**
     * Affecte le montant au débit
     * @param float $debit
     * @throws \LogicException
     */
    public function setDebit($debit): self
    {
        if ($debit !== null && !is_numeric($debit)) {
            throw new \LogicException('setDebit : "'.$debit.'" is not a numeric value');
        }

        $this->debit = floatval($debit);

        return $this;
    }

    /**
     * Affecte le montant au crédit
     * @param float $credit
     * @throws \LogicException
     */
    public function setCredit($credit): self
    {
        if ($credit !== null && !is_numeric($credit)) {
            throw new \LogicException('setCredit : "'.$credit.'" is not a numeric value');
        }

        $this->credit = floatval($credit);

        return $this;
    }

    /**
     * Optionnel - Affecte le lettrage de l'écriture comptable (à blanc si non utilisé)
     * @param string $ecritureLet
     */
    public function setEcritureLet($ecritureLet = null): self
    {
        $this->ecritureLet = $ecritureLet;

        return $this;
    }

    /**
     * Optionnel - Affecte la date de lettrage (à blanc si non utilisé)
     * @param \DateTime $dateLet
     */
    public function setDateLet(\DateTime $dateLet = null): self
    {
        $this->dateLet = $dateLet;

        return $this;
    }

    /**
     * Affecte la date de validation de l'écriture comptable
     * @param \DateTime $validDate
     */
    public function setValidDate(\DateTime $validDate): self
    {
        $this->validDate = $validDate;

        return $this;
    }

    /**
     * Optionnel - Affecte le montant en devise (à blanc si non utilisé)
     * @param float $montantDevise
     * @throws \LogicException
     */
    public function setMontantdevise($montantDevise = null): self
    {
        if ($montantDevise !== null && !is_numeric($montantDevise)) {
            throw new \LogicException('setMontantdevise : "'.$montantDevise.'" is not a numeric value');
        }

        $this->montantdevise = $montantDevise !== null ? floatval($montantDevise) : null;

        return $this;
    }

    /**
     * Optionnel - Affecte l'identifiant de la devise (à blanc si non utilisé)
     * @param string $idDevise
     */
    public function setIdevise($idDevise = null): self
    {
        $this->idevise = $idDevise;

        return $this;
    }
}
