<?php

namespace A5sys\FecBundle\Dumper;

use Symfony\Component\HttpFoundation\File\File;

/**
 * Interface representing a dumper with ablity to generate a FEC file
 */
interface DumperInterface
{
    /**
     * Writes the FEC into the given path
     * @param File  $file
     * @param array $fieldNames array of the field names
     * @param array $data       assoc array of the data to be dumped
     */
    public function dump(File $file, $fieldNames, $data): File;

    /**
     * fileExtension getter
     */
    public function getFileExtension(): string;
}
