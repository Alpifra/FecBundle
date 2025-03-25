<?php

namespace A5sys\FecBundle\Normalizer;

use A5sys\FecBundle\ValueObject\EcritureComptableInterface;

/**
 * Interface representing a normalizer, so that is capable to retreive values from a EcritureComptableInterface or one of its child
 */
interface NormalizerInterface
{
    /**
     * Returns the names of the fields
     * Warning : order matters
     * @return array<string>
     */
    public function getFieldNames(): array;

    /**
     * compute data
     * Warning : order matters
     * @param EcritureComptableInterface $ecritureComptableInterface
     */
    public function toArray(EcritureComptableInterface $ecritureComptableInterface): array;

     /**
     * Normalize one array to an EcritureComptableInterface
     * @param array $data
     */
    public function toValueObject(array $data): EcritureComptableInterface;

    /**
     * Validate the object
     * @param EcritureComptableInterface $ecritureComptable
     *
     * @throws FecValidationException
     */
    public function validateValueObject(EcritureComptableInterface $ecritureComptable);
}
