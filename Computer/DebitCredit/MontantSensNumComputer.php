<?php

namespace A5sys\FecBundle\Computer\DebitCredit;

use A5sys\FecBundle\Exception\FecException;
use A5sys\FecBundle\ValueObject\EcritureComptableInterface;

/**
 * Compute Montant and Sens in numeric fields according to input into an assoc array
 */
class MontantSensNumComputer implements DebitCreditComputerInterface
{
    const DEBIT = '+1';
    const CREDIT = '-1';

    /**
     * Returns the names of the fields
     * Warning : order matters
     * @return array<string>
     */
    public function getFieldNames(): array
    {
        return [
            'Montant',
            'Sens',
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

        if (!empty($ecritureComptable->getDebit())) {
            $data['Montant'] = $ecritureComptable->getDebit();
            $data['Sens'] = static::DEBIT;
        }

        if (!empty($ecritureComptable->getCredit())) {
            $data['Montant'] = $ecritureComptable->getCredit();
            $data['Sens'] = static::CREDIT;
        }

        return $data;
    }

    /**
     * Compute Debit and Credit Fields
     * @param EcritureComptableInterface $ecritureComptable
     * @param array                      $data the FEC entry
     *
     * @throws FecException
     */
    public function toValueObject(EcritureComptableInterface $ecritureComptable, array $data): EcritureComptableInterface
    {
        if (!isset($data['Sens']) || !isset($data['Montant'])) {
            throw new FecException('Fields "Sens" and "Montant" are mandatory when using the computer '.get_class($this));
        }

        if ($data['Sens'] !== static::DEBIT || $data['Sens'] !== static::CREDIT) {
            throw new FecException('Field "Sens" must be one of "'.static::DEBIT.'" or "'.static::CREDIT.'" when using the computer '.get_class($this));
        }

        if ($data['Sens'] === static::DEBIT) {
            $ecritureComptable->setDebit($data['Montant']);
        } else {
            $ecritureComptable->setCredit($data['Montant']);
        }

        return $ecritureComptable;
    }
}
