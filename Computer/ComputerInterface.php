<?php

namespace A5sys\FecBundle\Computer;

use A5sys\FecBundle\ValueObject\EcritureComptableInterface;

/**
 * Interface representing a computer, so that is capable to calculate some values from a EcritureComptableInterface or one of its child
 */
interface ComputerInterface
{
    /**
     * compute data
     * Warning : order matters
     * @param EcritureComptableInterface $ecritureComptableInterface
     */
    public function toArray(EcritureComptableInterface $ecritureComptableInterface): array;

    /**
     * compute data to an ecritureComptableinterface
     * @param EcritureComptableInterface $ecritureComptableInterface
     * @param array $data the FEC entry
     */
    public function toValueObject(EcritureComptableInterface $ecritureComptableInterface, array $data): EcritureComptableInterface;
}
