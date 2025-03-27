<?php

namespace A5sys\FecBundle\ValueObject;

/**
 * Interface représentant une écriture comptable française
 */
interface EcritureComptableInterface
{
    /**
     * Retourne le code journal de l'écriture comptable
     */
    public function getJournalCode(): string;

    /**
     * Retourne le libellé journal de l'écriture comptable
     */
    public function getJournalLib(): string;

    /**
     * Retourne le numéro sur une séquence continue de l'écriture comptable
     */
    public function getEcritureNum(): string;

    /**
     * Retourne la date de comptabilisation de l'écriture comptable
     */
    public function getEcritureDate(): \DateTime;

    /**
     * Retourne le numéro de compte, dont les trois premiers caractères doivent correspondre à des chiffres respectant les normes du plan comptable français
     */
    public function getCompteNum(): string;

    /**
     * Retourne le libellé de compte, conformément à la nomenclature du plan comptable français
     */
    public function getCompteLib(): string;

    /**
     * Retourne le numéro de compte auxiliaire (à blanc si non utilisé)
     */
    public function getCompAuxNum(): string;

    /**
     * Retourne le libellé de compte auxiliaire (à blanc si non utilisé)
     */
    public function getCompAuxLib(): string;

    /**
     * Retourne la référence de la pièce justificative
     */
    public function getPieceRef(): string;

    /**
     * Retourne la date de la pièce justificative
     */
    public function getPieceDate(): \DateTime;

    /**
     * Retourne le libellé de l'écriture comptable
     */
    public function getEcritureLib(): string;

    /**
     * Retourne le montant au débit
     */
    public function getDebit(): ?float;

    /**
     * Retourne le montant au crédit
     */
    public function getCredit(): ?float;

    /**
     * Retourne le lettrage de l'écriture comptable (à blanc si non utilisé)
     */
    public function getEcritureLet(): string;

    /**
     * Retourne la date de lettrage (à blanc si non utilisé)
     */
    public function getDateLet(): \DateTime;

    /**
     * Retourne la date de validation de l'écriture comptable
     */
    public function getValidDate(): \DateTime;

    /**
     * Retourne le montant en devise (à blanc si non utilisé)
     */
    public function getMontantdevise(): float;

    /**
     * Retourne l'identifiant de la devise (à blanc si non utilisé)
     */
    public function getIdevise(): string;

    /**
     * Affecte le code journal de l'écriture comptable
     * @param string $journalCode
     */
    public function setJournalCode($journalCode): self;

    /**
     * Affecte le libellé journal de l'écriture comptable
     * @param string $journalLib
     */
    public function setJournalLib($journalLib): self;

    /**
     * Affecte le numéro sur une séquence continue de l'écriture comptable
     * @param string $ecritureNum
     */
    public function setEcritureNum($ecritureNum): self;

    /**
     * Affecte la date de comptabilisation de l'écriture comptable
     * @param \DateTime $ecritureDate
     */
    public function setEcritureDate(\DateTime $ecritureDate): self;

    /**
     * Affecte le numéro de compte, dont les trois premiers caractères doivent correspondre à des chiffres respectant les normes du plan comptable français
     * @param string $compteNum
     */
    public function setCompteNum($compteNum): self;

    /**
     * Affecte le libellé de compte, conformément à la nomenclature du plan comptable français
     * @param string $compteLib
     */
    public function setCompteLib($compteLib): self;

    /**
     * Optionnel - Affecte le numéro de compte auxiliaire (à blanc si non utilisé)
     * @param string $compAuxNum
     */
    public function setCompAuxNum($compAuxNum = null): self;

    /**
     * Optionnel - Affecte le libellé de compte auxiliaire (à blanc si non utilisé)
     * @param string $compAuxLib
     */
    public function setCompAuxLib($compAuxLib = null): self;

    /**
     * Affecte la référence de la pièce justificative
     * @param string $pieceRef
     */
    public function setPieceRef($pieceRef): self;

    /**
     * Affecte la date de la pièce justificative
     * @param \DateTime $pieceDate
     */
    public function setPieceDate(\DateTime $pieceDate): self;

    /**
     * Affecte le libellé de l'écriture comptable
     * @param string $ecritureLib
     */
    public function setEcritureLib($ecritureLib): self;

    /**
     * Affecte le montant au débit
     * @param float $debit
     */
    public function setDebit($debit): self;

    /**
     * Affecte le montant au crédit
     * @param float $credit
     */
    public function setCredit($credit): self;

    /**
     * Optionnel - Affecte le lettrage de l'écriture comptable (à blanc si non utilisé)
     * @param string $ecritureLet
     */
    public function setEcritureLet($ecritureLet = null): self;

    /**
     * Optionnel - Affecte la date de lettrage (à blanc si non utilisé)
     * @param \DateTime $dateLet
     */
    public function setDateLet(\DateTime $dateLet = null): self;

    /**
     * Affecte la date de validation de l'écriture comptable
     * @param \DateTime $validDate
     */
    public function setValidDate(\DateTime $validDate): self;

    /**
     * Optionnel - Affecte le montant en devise (à blanc si non utilisé)
     * @param float $montantDevise
     */
    public function setMontantdevise($montantDevise = null): self;

    /**
     * Optionnel - Affecte l'identifiant de la devise (à blanc si non utilisé)
     * @param string $idDevise
     */
    public function setIdevise($idDevise = null): self;
}
