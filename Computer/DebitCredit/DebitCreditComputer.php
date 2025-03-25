<?php

namespace A5sys\FecBundle\Computer\DebitCredit;

use A5sys\FecBundle\ValueObject\EcritureComptableInterface;

/**
 * Compute Debit and Credit fields according to input into an assoc array
 */
class DebitCreditComputer implements DebitCreditComputerInterface
{
    /**
     * Returns the names of the fields
     * Warning : order matters
     * @return array<string>
     */
    public function getFieldNames(): array
    {
        return [
            'Debit',
            'Credit',
        ];
    }

    /**
     * Compute Debit and Credit Fields
     * Warning : order matters
     * @param EcritureComptableInterface $ecritureComptable
     */
    public function toArray(EcritureComptableInterface $ecritureComptable): array
    {
        $data = [];

        $data['Debit'] = $ecritureComptable->getDebit();
        $data['Credit'] = $ecritureComptable->getCredit();

        return $data;
    }

    /**
     * Compute Debit and Credit Fields
     * @param EcritureComptableInterface $ecritureComptable
     * @param array                      $data the FEC entry
     */
    public function toValueObject(EcritureComptableInterface $ecritureComptable, array $data): EcritureComptableInterface
    {
        $ecritureComptable->setDebit($data['Debit']);
        $ecritureComptable->setCredit($data['Credit']);

        return $ecritureComptable;
    }
}
