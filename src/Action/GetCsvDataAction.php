<?php

declare(strict_types=1);

namespace App\Action;

use SplFileObject;

final class GetCsvDataAction
{
    public function __construct(
        private readonly string $resourcesPath,
    ) {
    }
    public function __invoke(): SplFileObject
    {
        $csvFile = new SplFileObject($this->resourcesPath . 'employee.csv');

        $csvFile->setFlags(SplFileObject::READ_CSV |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE);

        $csvFile->setCsvControl(",");

        $csvFile->current();
        return $csvFile;
    }

}