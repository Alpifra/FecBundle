<?php

namespace A5sys\FecBundle\Service;

use A5sys\FecBundle\Computer\ComputerInterface;
use A5sys\FecBundle\Computer\DebitCredit\DebitCreditComputer;
use A5sys\FecBundle\Dumper\DumperInterface;
use A5sys\FecBundle\Normalizer\NormalizerInterface;
use A5sys\FecBundle\ValueObject\EcritureComptableInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Fec Manager is the entry point for generating FEC file
 */
class FecManager
{
    /**
     * Directory where to write FEC files
     * @var string
     */
    protected $directory;

    /**
     * The dumper service (csv, ...)
     * @var DumperInterface
     */
    protected $dumper;

    /**
     * Normalizer service, to get base informations
     * @var NormalizerInterface
     */
    protected $normalizer;

    /**
     * debitCredit instance to compute Debit and Credit fields (D/C or M/S)
     * @var DebitCreditComputer
     */
    protected $debitCreditComputer;

    /**
     * Constructor
     * @param string              $directory
     * @param DumperInterface     $dumper
     * @param NormalizerInterface $normalizer
     * @param ComputerInterface   $debitCreditComputer
     */
    public function __construct($directory, DumperInterface $dumper, NormalizerInterface $normalizer, DebitCreditComputer $debitCreditComputer)
    {
        $this->directory = $directory;
        $this->dumper = $dumper;
        $this->normalizer = $normalizer;
        $this->debitCreditComputer = $debitCreditComputer;
    }

    /**
     * generate the FEC file
     * @param string                            $siren                 Siren number
     * @param \DateTime                         $dateClotureExercice   Closing date
     * @param array<EcritureComptableInterface> $ecritureComptableList List of conventionned input objects
     *
     * @throws \A5sys\FecBundle\Exception\FecException
     */
    public function generateFile($siren, \DateTime $dateClotureExercice, $ecritureComptableList): File
    {
        $file = $this->getFile($siren, $dateClotureExercice);

        $data = [];
        // loop over each EcritureComptableinterface to get correct FEC entry
        foreach ($ecritureComptableList as $ecritureComptable) {
            $baseData = $this->normalizer->toArray($ecritureComptable);
            $computedData = $this->debitCreditComputer->toArray($ecritureComptable);
            $completeData = $this->insertDebitCreditInBaseData($baseData, $computedData);

            $data[] = $completeData;
        }

        // compose field names according to base and computed process
        $normalizedFieldNames = $this->normalizer->getFieldNames();
        $computedFieldNames = $this->debitCreditComputer->getFieldNames();
        $completeFieldNames = $this->insertDebitCreditInBaseFields($normalizedFieldNames, $computedFieldNames);

        return $this->dumper->dump($file, $completeFieldNames, $data);
    }

    /**
     * Get the File object
     * @param string    $siren                 Siren number
     * @param \DateTime $dateClotureExercice   Closing date
     */
    protected function getFile($siren, \DateTime $dateClotureExercice): File
    {
        $extension = $this->dumper->getFileExtension();
        $filename = $this->getFileName($siren, $dateClotureExercice);
        $fileUri = rtrim($this->directory, '/').'/'.$filename.'.'.$extension;

        return new File($fileUri, false);
    }

    /**
     * Get the file name of the FEC for the siren and the closing date
     * @param string    $siren
     * @param \DateTime $dateClotureExercice
     * @return string <Siren>FEC<AAAAMMJJ>
     */
    protected function getFileName($siren, \DateTime $dateClotureExercice): string
    {
        return $siren.'FEC'.$dateClotureExercice->format('Ymd');
    }

    /**
     * Inserts debit and credit informations at the right place
     * @param array $baseData
     * @param array $computedData
     */
    protected function insertDebitCreditInBaseData(array $baseData, array $computedData)
    {
        // place the debit and credit fields immediatly after the EcritureLib field
        $pos = array_search('EcritureLib', array_keys($baseData));

        return array_merge(
            array_slice($baseData, 0, $pos+1),
            $computedData,
            array_slice($baseData, $pos+1)
        );
    }

    /**
     * Inserts debit and credit field names at the right place
     * @param array $baseData
     * @param array $computedData
     */
    protected function insertDebitCreditInBaseFields(array $baseData, array $computedData)
    {
        // place the debit and credit fields immediatly after the EcritureLib field
        $pos = array_search('EcritureLib', $baseData);

        return array_merge(
            array_slice($baseData, 0, $pos+1),
            $computedData,
            array_slice($baseData, $pos+1)
        );
    }
}
