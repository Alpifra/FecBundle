<?php

namespace A5sys\FecBundle\ValueObject;

/**
 * Représente une écriture comptable française pour les bénéfices agricoles comptabilisant les recettes et dépenses professionnelles
 */
class EcritureBATresorerie extends AbstractEcritureComptable implements EcritureBATresorerieInterface
{
    /**
     * La date de réglement de l'écriture comptable
     * @var \DateTime
     */
    protected $dateRglt;

    /**
     * Le mode de réglement
     * @var string
     */
    protected $modeRglt;

    /**
     * La nature de l'opération
     * @var string
     */
    protected $natOp;

    /**
     * Retourne la date de réglement de l'écriture comptable
     */
    public function getDateRglt(): \DateTime
    {
        return $this->dateRglt;
    }

    /**
     * Retourne le mode de réglement
     */
    public function getModeRglt(): string
    {
        return $this->modeRglt;
    }

    /**
     * Retourne la nature de l'opération
     */
    public function getNatOp(): string
    {
        return $this->natOp;
    }

    /**
     * Affecte la date de réglement de l'écriture comptable
     * @param \DateTime $dateRglt
     */
    public function setDateRglt(\DateTime $dateRglt): self
    {
        $this->dateRglt = $dateRglt;

        return $this;
    }

    /**
     * Affecte le mode de réglement
     * @param string $modeRglt
     */
    public function setModeRglt($modeRglt): self
    {
        $this->modeRglt = $modeRglt;

        return $this;
    }

    /**
     * Affecte la nature de l'opération
     * @param string $natOp
     */
    public function setNatOp($natOp = null): self
    {
        $this->natOp = $natOp;

        return $this;
    }
}
