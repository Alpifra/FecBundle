<?php

namespace A5sys\FecBundle\ValueObject;

/**
 * Représente une écriture comptable française pour les bénéfices non commerciaux comptabilisant les recettes et dépenses professionnelles
 */
class EcritureBNCTresorerie extends EcritureBATresorerie implements EcritureBNCTresorerieInterface
{
    /**
     * L'identification du client
     * @var string
     */
    protected $idClient;

    /**
     * Retourne l'identification du client
     */
    public function getIdClient(): string
    {
        return $this->idClient;
    }

    /**
     * Affecte le mode de réglement
     * @param string $idClient
     */
    public function setIdClient($idClient = null): self
    {
        $this->idClient = $idClient;

        return $this;
    }
}
