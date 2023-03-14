<?php

declare(strict_types=1);

namespace App\Queues\MessageHandler;

use App\Action\AddEmployeesToDatabaseAction;
use App\Queues\Message\UpsertCsvIntoDatabase;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class UpsertCsvToDatabaseHandler
{

    public function __construct(
        private readonly AddEmployeesToDatabaseAction $addEmployeesToDatabaseAction,
    ) {
    }

    public function __invoke(UpsertCsvIntoDatabase $csvIntoDatabase): void
    {
        ($this->addEmployeesToDatabaseAction)();
    }

}