<?php

namespace A5sys\FecBundle\Validator;

use A5sys\FecBundle\ValueObject\EcritureComptableInterface;

/**
 * Interface representing a validator, so that is capable to valid a EcritureComptableInterface
 */
interface ValidatorInterface
{
    /**
     * Validates the EcritureComptableInterface
     * @param EcritureComptableInterface $ecritureComptableInterface
     * @throws FecValidationException
     */
    public function validate(EcritureComptableInterface $ecritureComptableInterface): void;
}
