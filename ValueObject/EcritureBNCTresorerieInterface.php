<?php

namespace A5sys\FecBundle\ValueObject;

/**
 * Interface représentant une écriture comptable française pour les bénéfices non commerciaux comptabilisant les recettes et dépenses professionnelles
 */
interface EcritureBNCTresorerieInterface extends EcritureBATresorerieInterface
{
    /**
     * Retourne l'identification du client
     */
    public function getIdClient(): string;

    /**
     * Affecte l'identification du client
     * @param string $idClient
     */
    public function setIdClient($idClient = null): self;
}
