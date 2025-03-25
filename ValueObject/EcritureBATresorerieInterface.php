<?php

namespace A5sys\FecBundle\ValueObject;

/**
 * Interface représentant une écriture comptable française pour les bénéfices agricoles comptabilisant les recettes et dépenses professionnelles
 */
interface EcritureBATresorerieInterface extends EcritureComptableInterface
{
    /**
     * Retourne la date de réglement de l'écriture comptable
     */
    public function getDateRglt(): \DateTime;

    /**
     * Retourne le mode de réglement
     */
    public function getModeRglt(): string;

    /**
     * Retourne la nature de l'opération
     */
    public function getNatOp(): string;

    /**
     * Affecte la date de réglement de l'écriture comptable
     * @param \DateTime $dateRglt
     */
    public function setDateRglt(\DateTime $dateRglt): self;

    /**
     * Affecte le mode de réglement
     * @param string $modeRglt
     */
    public function setModeRglt($modeRglt): self;

    /**
     * Affecte la nature de l'opération
     * @param string $natOp
     */
    public function setNatOp($natOp = null): self;
}
